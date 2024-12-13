<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function create(User $user)
    {
        return in_array($user->role, ['Admin', 'Manager']);
    }

    public function update(User $user, Task $task)
    {
        return in_array($user->role, ['Admin', 'Manager']);
    }

    public function delete(User $user, Task $task)
    {
        return $user->role === 'Admin';
    }

    public function view(User $user)
    {
        return in_array($user->role, ['Admin', 'Manager', 'Employee']);
    }
}
