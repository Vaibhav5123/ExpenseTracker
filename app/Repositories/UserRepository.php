<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    // Get all users
    // public function getAllUsers()
    // {
    //     return $this->userModel->all();
    // }
    public function getAllUsers()
    {
        // Fetch all users from the database
        return User::with('role')->paginate(10);
    }

    // Get user by ID
    public function getUserById($id)
    {
        return $this->userModel->with('role')->find($id);
    }

    // Create a new user
    public function createUser(array $data)
    {
        return $this->userModel->create($data);
    }

    // Update a user by ID
    public function updateUser($id, array $data)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    // Delete a user by ID
    public function deleteUser($id)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
