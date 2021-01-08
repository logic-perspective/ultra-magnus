<?php

namespace App\Http\Requests;

use App\Rules\DomainNameRule;
use Illuminate\Foundation\Http\FormRequest;

class ReferrerTokenRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'domain' => [new DomainNameRule(), 'required'],
            'email' => 'email|required',
        ];
    }
}
