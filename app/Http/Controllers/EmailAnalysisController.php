<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailAnalysisRequest;
use Illuminate\Http\JsonResponse;
use Sendmarc\EmailAnalysis\EmailParser;

class EmailAnalysisController extends Controller
{
    /**
     * @var EmailParser
     */
    private $parser;

    /**
     * EmailAnalysisController constructor.
     * @param EmailParser $parser
     */
    public function __construct(EmailParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param EmailAnalysisRequest $request
     * @return JsonResponse
     */
    public function getHeaders(EmailAnalysisRequest $request): JsonResponse
    {
        return response()->json($this->parser->getHeaders($request->get('mime')));
    }
}
