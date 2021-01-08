<?php


namespace Tests\Feature;


use Tests\TestCase;

class SpfAnalysisTest extends TestCase
{
    public function testGetRecordsWithInvalidDomainInput()
    {
        $response = $this->post(route('spf.record'), ['domain' => null]);
        $response->assertSessionHasErrors();
    }

    public function testGetRecordsWithValidDomainInput()
    {
        $response = $this->post(route('spf.record'), ['domain' => 'sendmarc.com']);
        $response->assertSessionHasNoErrors();
    }

    public function testGetAnalysisWithInvalidDomainInput()
    {
        $response = $this->post(route('spf.analysis'), ['domain' => null]);
        $response->assertSessionHasErrors();
    }

    public function testGetAnalysisWithValidDomainInput()
    {
        $response = $this->post(route('spf.analysis'), ['domain' => 'sendmarc.com']);
        $response->assertSessionHasNoErrors();
    }
}