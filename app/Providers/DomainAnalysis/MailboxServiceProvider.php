<?php

namespace App\Providers\DomainAnalysis;

use Illuminate\Support\ServiceProvider;
use Sendmarc\DnsLookup\Lookups\MxLookup;
use Sendmarc\SenderAnalysis\MailboxHelper;

class MailboxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(MailboxHelper::class, function () {
            return new MailboxHelper($this->app->make(MxLookup::class));
        });
    }
}