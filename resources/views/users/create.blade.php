<x-layouts.app :title="__('Create User')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Create User') }}</h1>

    <form action="{{ route('users.store') }}" method="POST" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Password') }}</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Confirm Password') }}</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Create') }}
        </button>
    </form>
</x-layouts.app>