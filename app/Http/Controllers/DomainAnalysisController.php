<?php

namespace App\Http\Controllers;

use App\DomainAnalysis;
use App\Http\Helpers\LookupResponse;
use App\Http\Requests\DomainAnalysisRequest;
use App\Http\Requests\EmailAddressAnalysisRequest;
use App\Http\Traits\GetsReferrer;
use App\Mail\DomainAnalysisMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Sendmarc\DnsLookup\Exceptions\HostNotFoundException;
use Sendmarc\DnsLookup\Exceptions\LookupException;
use Sendmarc\DnsLookup\Exceptions\RecordNotFoundException;
use Sendmarc\DnsLookup\Lookups\CnameLookup;
use Sendmarc\DomainAnalysis\Analysers\DmarcAnalyser;
use Sendmarc\DomainAnalysis\Analysers\SpfAnalyser;
use Sendmarc\DomainAnalysis\AnalysisCompiler;

class DomainAnalysisController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GetsReferrer;

    /**
     * @var AnalysisCompiler
     */
    private $analysisCompiler;

    /**
     * @var DmarcAnalyser
     */
    private $dmarcAnalyser;

    /**
     * @var SpfAnalyser
     */
    private $spfAnalyser;

    /**
     * @var CnameLookup
     */
    private $cnameLookup;

    /**
     * DomainLookupController constructor.
     * @param AnalysisCompiler $analysisCompiler
     * @param DmarcAnalyser $dmarcAnalyser
     * @param SpfAnalyser $spfAnalyser
     * @param CnameLookup $cnameLookup
     */
    public function __construct(AnalysisCompiler $analysisCompiler,
                                DmarcAnalyser $dmarcAnalyser,
                                SpfAnalyser $spfAnalyser,
                                CnameLookup $cnameLookup)
    {
        $this->analysisCompiler = $analysisCompiler;
        $this->dmarcAnalyser = $dmarcAnalyser;
        $this->spfAnalyser = $spfAnalyser;
        $this->cnameLookup = $cnameLookup;
    }


    /**
     * @param EmailAddressAnalysisRequest $request
     * @return JsonResponse
     */
    public function getAnalysis(EmailAddressAnalysisRequest $request): JsonResponse
    {
       try {
           $domain = $this->extractDomain($request->get('email'));
           $domainScore = $this->compileScore($domain);
           $spfAnalysis = $this->getSpfMessages($domain);
           $dmarcAnalysis = $this->getDmarcMessages($domain);

           if (!$this->runningTest($request->get('email'))) {
               $this->saveAnalysis([
                   'referrer_id' => $this->getReferrer()->id,
                   'email_address' => $request->get('email'),
                   'domain_score' => $domainScore,
                   'dmarc_messages' => $dmarcAnalysis,
                   'spf_messages' => $spfAnalysis,
               ]);

               $this->sendEmail($domainScore, $request->get('email'), $this->getReferrer()->email);
           }
       } catch (LookupException $e) {
           abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
       }

        return response()->json(compact('domainScore', 'spfAnalysis', 'dmarcAnalysis'));
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getCname(DomainAnalysisRequest $request): JsonResponse
    {
        try {
            $lookup = $this->cnameLookup->lookup($request->get('domain'));
        } catch (HostNotFoundException $e) {
            abort(400, $e->getMessage());
        } catch (RecordNotFoundException $e) {
            abort(400, $e->getMessage());
        }

        return response()->json([
            'cname' => $lookup->getCnameRecord()
        ]);
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getScore(DomainAnalysisRequest $request): JsonResponse
    {
        return response()
            ->json(['score' => $this->compileScore($request->get('domain'))]);
    }

    /**
     * @param string $domain
     * @return int
     */
    private function compileScore(string $domain): int
    {
        $this->analysisCompiler->compile($domain);
        return $this->analysisCompiler->getScore();
    }

    /**
     * @param string $email
     * @return string
     */
    private function extractDomain(string $email): string
    {
        return explode("@", $email)[1];
    }

    /**
     * @param string $domain
     * @return array
     * @throws LookupException
     */
    private function getDmarcMessages(string $domain): array
    {
        $this->dmarcAnalyser->run($domain);
        return $this->dmarcAnalyser->getAnalysis()->getMessages()->all();
    }

    /**
     * @param string $domain
     * @return array | string
     * @throws LookupException
     */
    private function getSpfMessages(string $domain)
    {
        $this->spfAnalyser->run($domain);
        return $this->spfAnalyser->getAnalysis()->getMessages()->all();
    }

    /**
     * @param string $email
     * @return bool
     */
    private function runningTest(string $email)
    {
        $testUsers = ['test', 'info'];
        $publicDomains = [
            'fastmail.com',
            'gmail.com',
            'hotmail.co.uk',
            'hotmail.com',
            'icloud.com',
            'live.com',
            'mail.com',
            'mail.ru',
            'me.com',
            'msn.com',
            'outlook.com',
            'protonmail.ch',
            'protonmail.com',
            'yahoo.co.uk',
            'yahoo.com',
            'ymail.com',
        ];
        $emailParts = explode('@', $email);

        return in_array($emailParts[0], $testUsers) || in_array($emailParts[1], $publicDomains);
    }

    /**
     * @param array $analysis
     */
    private function saveAnalysis(array $analysis)
    {
        (new DomainAnalysis($analysis))->save();
    }

    /**
     * @param int $domainScore
     * @param string $analysedEmail
     * @param string $referrerEmail
     */
    private function sendEmail(int $domainScore, string $analysedEmail, string $referrerEmail)
    {
        Mail::to($referrerEmail)->queue(new DomainAnalysisMail($domainScore, $analysedEmail));
    }
}