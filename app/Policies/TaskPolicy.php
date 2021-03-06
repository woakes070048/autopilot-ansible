<?php

namespace App\Policies;

use App\Task;
use App\User;
use App\Server;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function restore(User $user, Task $task)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function forceDelete(User $user, Task $task)
    {
        return false;
    }

    /**
     * Determine whether the user can attach a server to a task.
     *
     * @param  \App\User $user
     * @param  \App\Task $task
     * @param  \App\Server $server
     * @return mixed
     */
    public function attachServer(User $user, Task $task, Server $server)
    {
        return false;
    }

    /** 
     * Determine whether the user can deteach a server from a task.
     *
     * @param  \App\User $user
     * @param  \App\Task $task
     * @param  \App\Server $server
     * @return mixed
     */
    public function detachServer(User $user, Task $task, Server $server)
    {
        return false;
    }

    /**
     * Determine whether the user can attach a server to a task.
     *
     * @param  \App\User $user
     * @param  \App\Task $task
     * @return mixed
     */
    public function attachAnyServer(User $user, Task $task)
    {
        return false;
    }
}
