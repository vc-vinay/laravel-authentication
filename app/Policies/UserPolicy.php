<?php

namespace App\Policies;

use App\Constant\Constant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return Constant::STATUS_FALSE;
    }

    /**
     * Determine whether the user get access details.
     */
    public function getDetails(User $user, User $model)
    {
        return true;// return $model->tokenCan('get-details');
    }

    /**
     * Determine whether the user check status.
     */
    public function checkStatus(User $user, User $model)
    {
        return true;// return $model->tokenCan('verified-at');
    }
}