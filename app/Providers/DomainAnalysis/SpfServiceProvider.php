<?php


namespace App\Providers\DomainAnalysis;


use Illuminate\Support\ServiceProvider;
use Sendmarc\DnsLookup\Lookups\SpfLookup;
use Sendmarc\DnsLookup\Records\RecordTrees\Builders\SpfRecordTreeBuilder;
use Sendmarc\SenderAnalysis\SpfHelper;

class SpfServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SpfHelper::class, function () {
            return new SpfHelper(
                $this->app->make(SpfRecordTreeBuilder::class),
                $this->app->make(SpfLookup::class));
        });
    }
}