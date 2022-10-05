<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'us_nombre' => ['required', 'string', 'max:255'],
            'us_apellido' => ['required', 'string', 'max:255'],
            'us_rut' => ['required', 'string', 'max:255'],
            'us_telefono' => ['required', 'string', 'max:255'],
            'us_email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'us_nombre' => $input['us_nombre'],
                'us_apellido' => $input['us_apellido'],
                'us_rut' => $input['us_rut'],
                'us_telefono' => $input['us_telefono'],
                'us_email' => $input['us_email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'us_nombre' => $input['us_nombre'],
            'us_apellido' => $input['us_apellido'],
            'us_rut' => $input['us_rut'],
            'us_telefono' => $input['us_telefono'],
            'us_email' => $input['us_email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
