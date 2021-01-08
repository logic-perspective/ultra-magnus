<?php


namespace Tests\Feature;


use Tests\TestCase;

class DmarcAnalysisTest extends TestCase
{
    public function testGetRecordWithInvalidDomainInput()
    {
        $response = $this->post(route('dmarc.record'), ['domain' => null]);
        $response->assertSessionHasErrors();
    }

    public function testGetRecordValidDomainInput()
    {
        $response = $this->post(route('dmarc.record'), ['domain' => 'sendmarc.com']);
        $response->assertSessionHasNoErrors();
    }

    public function testGetAnalysisWithInvalidDomainInput()
    {
        $response = $this->post(route('dmarc.analysis'), ['domain' => null]);
        $response->assertSessionHasErrors();
    }

    public function testGetAnalysisWithValidDomainInput()
    {
        $response = $this->post(route('dmarc.analysis'), ['domain' => 'sendmarc.com']);
        $response->assertSessionHasNoErrors();
    }
}