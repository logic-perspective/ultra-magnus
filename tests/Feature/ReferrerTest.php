<?php

namespace Tests\Feature;

use App\Referrer;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ReferrerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string[]
     */
    private $tokenRequest;

    /**
     * @var string[]
     */
    private $emailChangeRequest;

    /**
     * @var int
     */
    private $referrerId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->referrerId = 1;
        $this->tokenRequest = ['domain' =>'example.com', 'email' => 'test@example.com'];
        $this->emailChangeRequest = ['email' => 'new.test@example.com'];

        Referrer::factory()->create(['id' => $this->referrerId]);

        if ($this->getName() !== 'testUnauthenticatedUserCannotViewAdminPanel') {
            $this->signIn();
        }
    }

    public function testUnauthenticatedUserCannotViewAdminPanel()
    {
        $this->get(route('admin'))->assertRedirect('/login');
    }

    public function testGetTokenValidatesRequest()
    {
        $this->post(route('referrer.token.generate'))->assertSessionHasErrors(['domain', 'email']);
    }

    public function testGetTokenRedirectsWithReferrerToken()
    {
       $this->from(route('admin'))
           ->post(route('referrer.token.generate', $this->tokenRequest))
           ->assertRedirect(route('admin'))
           ->assertSessionHas('referrer-token');
    }

    public function testChangeTokenUpdatesReferrerToken()
    {
       $response = $this->post(route('referrer.token.change', [$this->referrerId]));

       $this->assertTrue(Hash::check($response->getSession()->get('referrer-token'),  Referrer::find($this->referrerId)->token));
    }

    public function testDestroyTokenDeletesReferrer()
    {
        $this->delete(route('referrer.token.destroy', [$this->referrerId]));

        $this->assertDatabaseMissing('referrers', [
            'id' =>  $this->referrerId,
        ]);
    }

    public function testChangeEmailUpdatesReferrerEmail()
    {
        $this->post(route('referrer.email.change', [$this->referrerId]), $this->emailChangeRequest);

        $this->assertDatabaseHas('referrers', [
            'email' =>  $this->emailChangeRequest['email'],
        ]);
    }

    private function signIn(): void
    {
        $this->actingAs(User::factory()->make());
    }
}
