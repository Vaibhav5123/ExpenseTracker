<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0">User Details</h5>
    </div>
    <div class="card-body">
        <p class="card-text">
            <strong>Name:</strong>{{ $users->name }}<br>
            <strong>Email:</strong> {{ $users->email }}<br>
            <strong>Role:</strong> {{ $users->role->name }}<br><br>
        </p>

        <div class="d-flex gap-2">
            <a href="{{ route('users.edit', $users->id) }}" class="btn btn-warning btn-sm">Edit</a>
            
            <form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                    Delete
                </button>
            </form>
        </div>
    </div>


            </div>
        </div>
    </div>
</x-app-layout>
