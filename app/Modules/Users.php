<?php

namespace App\Modules;

use App\Contracts\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Users implements UserInterface
{
    public function __construct(public User $user)
    {

    }

    /**
     * Add new user.
     * @return User
     */

    public function add($data): User
    {
        $user = $this->user;

        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }

        $user->save();

        return $user;
    }

    /**
     * Update existing user.
     * @return User
     */

    public function update($data): User
    {
        $user = $this->user->find($data['id']);

        unset($data['id']);

        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }

        $user->save();

        return $user;
    }

    /**
     * Get user details.
     * @return User
     */

    public function detail($id): User
    {
        return $this->user->find($id);
    }
}
