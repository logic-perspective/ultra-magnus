<?php

namespace App\Http\Traits;

use App\Referrer;
use Illuminate\Support\Facades\URL;

trait GetsReferrer
{
    /**
     * @return Referrer | null
     */
    public function getReferrer(): ?Referrer
    {
        $referrer = str_replace('www.','', parse_url(URL::previous(), PHP_URL_HOST));
        return Referrer::whereRaw('instr(name, ?) > 0', $referrer)->first();
    }
}
