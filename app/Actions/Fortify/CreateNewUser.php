<?php

namespace App\Actions\Fortify;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @throws ValidationException
     * @return User
     */
    public function create(array $input)
    {
        $this->validateInput($input);

        return $this->newUser($input);
    }

    /**
     * @param array $input
     * @throws ValidationException
     */
    private function validateInput(array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();
    }

    /**
     * @param array $attributes
     * @return User
     */
    private function newUser(array $attributes): User
    {
        $user = new User([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
        ]);

        $user->save();

        return $user;
    }
}
