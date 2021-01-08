<?php

namespace App\Http\Requests;

use App\Rules\DomainNameRule;
use Illuminate\Foundation\Http\FormRequest;

class DomainAnalysisRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return ['domain' => [new DomainNameRule()]];
    }
}
