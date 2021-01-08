<?php


namespace Tests\Feature;


use Tests\TestCase;

class MxAnalysisTest extends TestCase
{
    public function testGetRecordWithInvalidDomainInput()
    {
        $response = $this->post(route('mx.record'), ['domain' => null]);
        $response->assertSessionHasErrors();
    }

    public function testGetRecordWithValidDomainInput()
    {
        $response = $this->post(route('mx.record'), ['domain' => 'sendmarc.com']);
        $response->assertSessionHasNoErrors();
    }
}