<?php

namespace App\Http\Middleware;

use App\Http\Traits\GetsReferrer;
use Closure;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class VerifyReferrer
{
    use GetsReferrer;

    /**
     * @var HasherContract
     */
    protected $hasher;

    /**
     * GuardWithToken constructor.
     * @param HasherContract $hasher
     */
    public function __construct(HasherContract $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $referrer = $this->getReferrer();

        if (is_null($referrer) || is_null($request->get('token')) || !$this->checkToken($request->get('token'), $referrer->token)) {
            abort(403, 'Referrer not allowed.');
        }

        return $next($request);
    }

    /**
     * @param string $requestToken
     * @param string $referrerToken
     * @return bool
     */
    private function checkToken(string $requestToken, string $referrerToken): bool
    {
        return $this->hasher->check($requestToken, $referrerToken);
    }
}
