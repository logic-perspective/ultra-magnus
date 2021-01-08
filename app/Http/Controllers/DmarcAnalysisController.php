<?php

namespace App\Http\Controllers;

use App\Http\Helpers\LookupResponse;
use App\Http\Requests\DomainAnalysisRequest;
use Illuminate\Http\JsonResponse;
use Sendmarc\DnsLookup\Exceptions\HostNotFoundException;
use Sendmarc\DnsLookup\Exceptions\LookupException;
use Sendmarc\DnsLookup\Exceptions\RecordNotFoundException;
use Sendmarc\DnsLookup\Lookups\DmarcLookup;
use Sendmarc\DomainAnalysis\Analysers\DmarcAnalyser;

class DmarcAnalysisController extends Controller
{
    /**
     * @var DmarcLookup
     */
    private $dmarcLookup;

    /**
     * @var DmarcAnalyser
     */
    private $analyser;

    /**
     * DmarcAnalysisController constructor.
     * @param DmarcLookup $dmarcLookup
     * @param DmarcAnalyser $analyser
     */
    public function __construct(DmarcLookup $dmarcLookup, DmarcAnalyser $analyser)
    {
        $this->dmarcLookup = $dmarcLookup;
        $this->analyser = $analyser;
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getRecord(DomainAnalysisRequest $request): JsonResponse
    {
        try {
            $result = $this->dmarcLookup->lookup($request->get('domain'));
        } catch (RecordNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (HostNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        }

        return response()->json($result->getTxtRecord());
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getAnalysis(DomainAnalysisRequest $request): JsonResponse
    {
        try {
            $this->analyser->run($request->get('domain'));
        } catch (LookupException $e) {
            abort(400);
        }

        $messages = $this->analyser->getAnalysis()->getMessages()->all();

        return response()->json($messages);
    }
}
