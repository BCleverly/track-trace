<x-app-layout>
    <x-slot name="title">
        Create user
    </x-slot>

    <x-slot name="header">
        <div class="flex space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create user') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('dashboard.user.store') }}" method="post"
                      class="w-full space-y-4 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="text-gray-400">Name:</label>
                        <input name="name" id="name"
                               class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2"
                               placeholder="John doe" type="text">
                        @error('name')
                        <p class="text-red-600"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="email" class="text-gray-400">Email:</label>
                        <input name="email" id="email"
                               class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2"
                               placeholder="Email" type="email">
                        @error('email')
                        <p class="text-red-600"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="password" class="text-gray-400">Password:</label>
                        <input name="password" id="password"
                               class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2"
                               placeholder="Password" type="password">
                        @error('password]')
                        <p class="text-red-600"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                    <x-button text="Create"/>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
