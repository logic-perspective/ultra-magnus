<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainAnalysisRequest;
use Illuminate\Http\JsonResponse;
use Sendmarc\DnsLookup\Exceptions\LookupException;
use Sendmarc\SenderAnalysis\MailboxHelper;

class MxAnalysisController extends Controller
{
    /**
     * @var MailboxHelper
     */
    private $helper;

    /**
     * MxAnalysisController constructor.
     * @param MailboxHelper $helper
     */
    public function __construct(MailboxHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @param DomainAnalysisRequest $request
     * @return JsonResponse
     */
    public function getRecords(DomainAnalysisRequest $request): JsonResponse
    {
        $response = null;

        try {
            return response()
                ->json($this->helper->get($request->get('domain')));
        } catch (LookupException $e) {
            abort(400, 'Failed to run lookup for: ' . $request->get('domain'));
        }
    }
}
