<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    use SoftDeletes, AuthorizesRequests;
    protected $authService;
    protected $userRepository;

    public function __construct(AuthService $authService, UserRepositoryInterface $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userRepository->getAllUsers();

        return view('users.users-view', compact('users'));
    }

    public function show($id)
    {
        $users = $this->userRepository->getUserById($id);
        return view('users.users-show', compact('users'));
    }


    public function edit($id)
    {
        $users = $this->userRepository->getUserById($id);
        $roles = Role::all();
        return view('users.users-edit', compact('users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); 

        return redirect()->route('users.index')->with('success', 'User deleted (soft) successfully.');
    }

    
    public function profile()
    {      
        $user = $this->authService->getAuthenticatedUser();

        return view('user.profile', compact('user'));
    }
}
