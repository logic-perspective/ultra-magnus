<?php

namespace App\Http\Controllers;


use App\Http\Helpers\LookupResponse;
use App\Http\Requests\DkimAnalysisRequest;
use App\Http\Requests\DomainAnalysisRequest;
use Illuminate\Http\JsonResponse;
use Sendmarc\DnsLookup\Exceptions\HostNotFoundException;
use Sendmarc\DnsLookup\Exceptions\RecordNotFoundException;
use Sendmarc\DnsLookup\Lookups\DomainKeyLookup;
use Sendmarc\DnsLookup\Lookups\DomainKeyNameServerLookup;
use Sendmarc\DnsLookup\Lookups\NameServerLookup;

class DkimAnalysisController extends Controller
{
    /**
     * @var NameServerLookup
     */
    private $nameServerLookup;

    /**
     * @var DomainKeyNameServerLookup
     */
    private $keyNameServerLookup;

    /**
     * @var DomainKeyLookup
     */
    private $domainKeyLookup;

    /**
     * DkimAnalysisController constructor.
     * @param NameServerLookup $nameServerLookup
     * @param DomainKeyNameServerLookup $keyNameServerLookup
     * @param DomainKeyLookup $domainKeyLookup
     */
    public function __construct(NameServerLookup $nameServerLookup,
                                DomainKeyNameServerLookup $keyNameServerLookup, DomainKeyLookup $domainKeyLookup)
    {
        $this->nameServerLookup = $nameServerLookup;
        $this->keyNameServerLookup = $keyNameServerLookup;
        $this->domainKeyLookup = $domainKeyLookup;
    }

    /**
     * @param DkimAnalysisRequest $request
     * @return JsonResponse
     */
    public function getKey(DkimAnalysisRequest $request): JsonResponse
    {
        try {
            $lookup = $this->domainKeyLookup->lookup($request->getLookupDomain());
        } catch (HostNotFoundException $e) {
            abort(400, $e->getMessage());
        } catch (RecordNotFoundException $e) {
            abort(400, $e->getMessage());
        }

        return response()->json([
            'txtRecord' => $lookup->getTxtRecord(),
            'cnameRecord' => $lookup->getCnameRecord()
        ]);
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getNameServerRecords(DomainAnalysisRequest $request): JsonResponse
    {
        [$recordsFound, $response] = $this->tryGetNameServerRecords(
            'runKeyNameServerLookup',
            $request->get('domain')
        );

        if ($recordsFound) {
            return $response;
        }

        return $this->tryGetNameServerRecords('runNameServerLookup', $request->get('domain'))[1];
    }

    /**
     * @param string $domain
     * @return JsonResponse
     * @throws HostNotFoundException
     * @throws RecordNotFoundException
     */
    private function runKeyNameServerLookup(string $domain)
    {
        return response()
            ->json($this->keyNameServerLookup->lookup($domain)->getNameServerRecords());
    }

    /**
     * @param string $domain
     * @return JsonResponse
     * @throws HostNotFoundException
     * @throws RecordNotFoundException
     */
    private function runNameServerLookup(string $domain)
    {
        return response()
            ->json($this->nameServerLookup->lookup($domain)->getNameServerRecords());
    }

    /**
     * @param string $function
     * @param string $domain
     * @return array
     */
    private function tryGetNameServerRecords(string $function, string $domain): array
    {
        $recordsFound = false;

        try {
            $response = $this->{$function}($domain);
            $recordsFound = true;
        } catch (HostNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage()));
        } catch (RecordNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage()));
        }

        return [$recordsFound, $response];
    }


}
