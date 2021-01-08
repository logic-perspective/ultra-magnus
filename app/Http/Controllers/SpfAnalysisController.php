<?php

namespace App\Http\Controllers;

use App\Http\Helpers\LookupResponse;
use App\Http\Requests\DomainAnalysisRequest;
use Illuminate\Http\JsonResponse;
use Sendmarc\DnsLookup\Exceptions\HostNotFoundException;
use Sendmarc\DnsLookup\Exceptions\RecordNotFoundException;
use Sendmarc\DnsLookup\Exceptions\RecordParseException;
use Sendmarc\DnsLookup\Exceptions\RecordStructureException;
use Sendmarc\DnsLookup\Exceptions\RecursiveIncludeException;
use Sendmarc\DnsLookup\Exceptions\TooManyRecordsException;
use Sendmarc\DomainAnalysis\Analysers\SpfAnalyser;
use Sendmarc\SenderAnalysis\SpfHelper;

class SpfAnalysisController extends Controller
{
    /**
     * @var SpfHelper
     */
    private $helper;

    /**
     * @var SpfAnalyser
     */
    private $analyser;

    /**
     * SpfAnalysisController constructor.
     * @param SpfHelper $helper
     * @param SpfAnalyser $analyser
     */
    public function __construct(SpfHelper $helper, SpfAnalyser $analyser)
    {
        $this->helper = $helper;
        $this->analyser = $analyser;
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getTree(DomainAnalysisRequest $request): JsonResponse
    {
        try {
            $this->helper->checkLookupRecord($request->get('domain'));
        } catch (HostNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (RecordNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (TooManyRecordsException $e) {
            abort(LookupResponse::error(409, $e->getMessage(), $request->get('domain'), $e->getRecords()));
        } catch (RecursiveIncludeException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        }

        try {
            $record = $this->helper->getLookupRecord($request->get('domain'));
        } catch (RecordStructureException $e) {
            abort(LookupResponse::error(418, $e->getMessage(), $request->get('domain'), $e->getLookupResult()->getTxtRecord()));
        } catch (RecordParseException $e) {
            abort(LookupResponse::error(419, $e->getMessage(), $request->get('domain'), $e->getLookupResult()->getTxtRecord()));
        }

        return LookupResponse::success($record);
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getRecord(DomainAnalysisRequest $request): JsonResponse
    {
        $record = null;
        try{
            $record = $this->helper->checkLookupRecord($request->get('domain'))->getTxtRecord();
        } catch (HostNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (RecordNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (TooManyRecordsException $e) {
            abort(LookupResponse::error(409, $e->getMessage(), $request->get('domain'), $e->getRecords()));
        } catch (RecursiveIncludeException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        }

        return LookupResponse::success($record);
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getAnalysis(DomainAnalysisRequest $request): JsonResponse
    {
        try {
            $this->analyser->run($request->get('domain'));
        } catch (HostNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (RecordNotFoundException $e) {
            abort(LookupResponse::error(400, $e->getMessage(), $request->get('domain')));
        } catch (TooManyRecordsException $e) {
            abort(LookupResponse::error(409, $e->getMessage(), $request->get('domain')));
        }

        $messages = $this->analyser->getAnalysis()->getMessages()->all();

        return LookupResponse::success($messages);
    }
}
