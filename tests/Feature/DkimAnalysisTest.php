<?php

namespace Tests\Feature;


use Tests\TestCase;

class DkimAnalysisTest extends TestCase
{
    public function testGetKeyHasNoErrors()
    {$this->withoutExceptionHandling();
        $response = $this->post(
            route('dkim.key'),
            [
                'selector' => 's1',
                'domain' => 'sendmarc.com'
            ]);
        $response->assertSessionHasNoErrors()
            ->assertJsonStructure(['txtRecord', 'cnameRecord']);
    }

    public function testGetNameServersHasNoErrors()
    {
        $response = $this->post(
            route('dkim.nameservers'),
            [
                'domain' => 'iec.org.za'
            ]);
        $response->assertSessionHasNoErrors();

    }
}
