<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserInterface
{
    /**
     * Add new Model.
     * @return Model
     */
    public function add($data): Model;

    /**
     * Update existing Model.
     * @return Model|boolean
     */
    public function update($data): Model|bool;

    /**
     * Get model detail.
     * @return Model|Collection|null
     */
    public function detail($id): Model|Collection|null;

}
