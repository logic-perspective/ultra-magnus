<?php
namespace App\Http\Helpers;

use App\Referrer;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class ReferrerRepository
{
    /**
     * @var HasherContract
     */
    private $hasher;

    /**
     * @param HasherContract $hasher
     * @param string $hashKey
     */
    public function __construct(HasherContract $hasher, string $hashKey)
    {
        $this->hasher = $hasher;
        $this->hashKey = $hashKey;
    }

    /**
     * @param string $referrerDomain
     * @param string $referrerEmail
     * @throws QueryException
     * @return string
     */
    public function store(string $referrerDomain, string $referrerEmail): string
    {
        $referrerToken = new Referrer();

        $token = $this->createNewToken();

        $referrerToken->fill([
            'name' => $referrerDomain,
            'email' => $referrerEmail,
            'token' => $this->hasher->make($token)
        ]);

        $referrerToken->save();

        return $token;
    }


    public function updateToken(int $referrerId): string
    {
        $token = $this->createNewToken();

        $referrer = Referrer::find($referrerId);
        $referrer->token = $this->hasher->make($token);
        $referrer->save();

        return $token;
    }

    /**
     * @param string $newEmail
     * @param int $referrerId
     */
    public function updateEmail(string $newEmail, int $referrerId): void
    {
        $referrer = Referrer::find($referrerId);
        $referrer->email = $newEmail;
        $referrer->save();
    }

    /**
     * @param int $referrerId
     */
    public function delete(int $referrerId): void
    {
        Referrer::find($referrerId)->delete();
    }

    /**
     * @return string
     */
    protected function createNewToken(): string
    {
        return hash_hmac('sha256', Str::random(40), $this->hashKey);
    }

    /**
     * @param string $referrer
     * @return string
     */
    private function extractDomain(string $referrer): string
    {
        return explode('@', $referrer)[1];
    }
}