<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return bool
     */
    public function view(?User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return bool
     */
    public function update(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return bool
     */
    public function delete(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return bool
     */
    public function restore(User $user, TaskStatus $taskStatus)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TaskStatus  $taskStatus
     * @return bool
     */
    public function forceDelete(User $user, TaskStatus $taskStatus)
    {
        return Auth::check();
    }
}
