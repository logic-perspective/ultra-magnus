<?php

namespace Tests\Feature;

use Tests\TestCase;

class DomainAnalysisTest extends TestCase
{
    public function testGetScoreWithInvalidDomainReturnsError()
    {
        $this->post(route('domain.score'), ['domain' => null])->assertSessionHasErrors(['domain']);
    }

    public function testGetScoreWithValidDomain()
    {
        $this->post(route('domain.score'), ['domain' => 'example.com'])
            ->assertStatus(200)
            ->assertJsonStructure(['score']);
    }

    public function testGetCnameWithInvalidDomainReturnsError()
    {
        $this->post(route('domain.cname'), ['domain' => null])->assertSessionHasErrors(['domain']);
    }

    public function testGetCnameWithValidDomain()
    { $this->withoutExceptionHandling();
        $this->post(route('domain.cname'), ['domain' => '_dmarc.sendmarc.com'])
            ->assertStatus(200)
            ->assertJsonStructure(['cname']);
    }
}