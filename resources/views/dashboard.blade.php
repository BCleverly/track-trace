<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <section class="text-gray-700 body-font">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="flex flex-wrap -m-4 text-center">
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ $totalVisitors }}</h2>
                                <p class="leading-relaxed">Total visitors today</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ $popularVenue->name }}</h2>
                                <p class="leading-relaxed">Most popular venue</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2>
                                <p class="leading-relaxed">Something</p>
                            </div>
                            <div class="p-4 sm:w-1/4 w-1/2">
                                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">0</h2>
                                <p class="leading-relaxed">Something</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-700 body-font">
                    <div class="container px-5 py-4 mx-auto">
                        @if(is_file(storage_path('app/public/logo.png')))
                            <div class="relative w-auto">
                                <form action="{{ route('dashboard.logo.delete') }}" method="post" class="absolute left-0 top-0">
                                    @csrf
                                    @method('delete')
                                    <button class="w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path class="fill-current text-white text-shadow" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </form>

                                <img src="{{ asset('storage/logo.png') }}" alt="" width="200">
                            </div>
                        @endif
                        <form class="flex flex-col space-y-4" action="{{ route('dashboard.logo.upload') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <label for="logo">Logo:</label>
                            <input type="file" name="logo" class="form-input">
                            @error('logo')
                            <p class="text-red-600"><small>{{ $message }}</small></p>
                            @enderror
                            <x-button text="Upload"/>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
