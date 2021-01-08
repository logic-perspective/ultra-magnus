<?php

namespace Tests\Api;

use App\Mail\DomainAnalysisMail;
use App\Referrer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailAnalysisTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    private $referrerToken;

    /**
     * @var string
     */
    private $testEmail;
    /**
     * @var Referrer
     */
    private $referrer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpReferrer();
        $this->withHeaders(['accept' => 'application/json']);
    }

    protected function setUpReferrer(): void
    {
        $this->referrerToken = 'abcd12345';
        $this->referrer = Referrer::factory()->create([
            'token' => Hash::make($this->referrerToken),
            'name' => parse_url(URL::previous(), PHP_URL_HOST),
            'email' => 'patsy.botsford@flights.com',
        ]);
    }

    public function testGetAnalysisWithoutReferrerTokenReturnsForbiddenError()
    {
        $this->post(route('email.address.analysis'), [
            'email' => $this->referrer->email,
        ])->assertStatus(403);
    }

    public function testGetAnalysisWithValidRequest()
    {
        Mail::fake();

        $response = $this->post(route('email.address.analysis', [
            'token' => $this->referrerToken,
            'email' => $this->referrer->email,
        ]));

        $response->assertStatus(200)
            ->assertJsonStructure(['domainScore', 'spfAnalysis', 'dmarcAnalysis']);

        $this->assertDatabaseHas('domain_analyses', ['email_address' => $this->referrer->email]);

        Mail::assertQueued(function (DomainAnalysisMail $mail) use ($response) {
            return $mail->analysis['score'] === $response->getOriginalContent()['domainScore'];
        });
    }
}