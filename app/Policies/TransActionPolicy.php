<?php

namespace App\Policies;

use App\Models\TransAction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransActionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role->hasPermissions("show-self-trans-action") || $user->role->hasPermissions("show-all-trans-action");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransAction  $transAction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TransAction $transAction)
    {
        return $user->role->hasPermissions("show-trans-action") || $user->id === $transAction->user_id;
    }

    public function onlyview(User $user, TransAction $transAction)
    {
        return $user->id === $transAction->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransAction  $transAction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TransAction $transAction)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransAction  $transAction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TransAction $transAction)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransAction  $transAction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TransAction $transAction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransAction  $transAction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TransAction $transAction)
    {
        //
    }
}
