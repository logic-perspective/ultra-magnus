<?php

namespace App\Http\Requests;

use App\Rules\DomainNameRule;
use Illuminate\Foundation\Http\FormRequest;

class DkimAnalysisRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'selector' => ['required'],
            'domain' => ['required', new DomainNameRule()]
        ];
    }

    /**
     * @return string
     */
    public function getLookupDomain(): string
    {
        return $this->get('selector') . '._domainkey.' . $this->get('domain');
    }


}
