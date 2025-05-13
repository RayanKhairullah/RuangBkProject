<x-layouts.app :title="__('Edit User')">
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ $user->name }}" required>
        </div>
        <div class="mb-4">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="form-input" value="{{ $user->email }}" required>
        </div>
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">{{ __('Role') }}</label>
            <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('User') }}</option>
                <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>{{ __('Teacher') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
    </form>
</x-layouts.app>