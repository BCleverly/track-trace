<x-guest-layout>
    <x-slot name="title">
        Welcome
    </x-slot>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex-col mt-12 just w-full flex text-center sm:pt-0 mb-4">
                @if(is_file(storage_path('app/public/logo.png')))
                    <div class="w-full flex justify-center">
                        <img src="{{ asset('storage/logo.png') }}" alt="" width="200">
                    </div>
                @endif
                <h1 class="text-5xl font-bold">Track and Trace</h1>
            </div>
            <div class="flex">
                <div class="hidden xl:block xl:w-1/2">
                    <div class=" text-center justify-center flex flex-wrap space-y-4">
                        <div class="w-full">
                            <p>If you'd like to do this on your own device, use this QR code or go to <a
                                    class="text-blue-500 hover:underline"
                                    href="{{ isset($venue) ? route('index.venue', $venue) : config('app.url') }}">{{ isset($venue) ? route('index.venue', $venue) : config('app.url') }}</a></p>
                        </div>
                        @if(is_file($qrCodePath))
                            <div class="w-full flex justify-center">
                                <img src="{{ $qrPublicPath }}"
                                     alt="" width="200">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-full xl:w-1/2">
                    <section class="text-gray-700 body-font">
                        <div class="container px-5 md:px-0 mt-12 md:mt-0  mx-auto flex flex-wrap items-center">

                            <form action="{{ route('visitor.store') }}" method="post" autocomplete="off"
                                  class="w-full bg-gray-200 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 mb-4">
                                @csrf

                                @if(count($venues) === 1 || isset($venue))
                                    <input type="hidden" name="venue_id"
                                           value="{{  $venue->id ?? $venues->first()->id }}">
                                @else
                                    <label for="extra_guests" class="text-gray-400">Venue</label>
                                    <div class="relative  py-2 mb-4">
                                        <select name="venue_id" id="venue_id"
                                                class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="grid-state">
                                            @foreach($venues as $key => $venue)
                                                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                                <div class="flex flex-col">
                                    <label for="email" class="text-gray-400">Email:</label>
                                    <input name="email" id="email"
                                           class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2"
                                           placeholder="john@doe.com" type="email">
                                    @error('email')
                                    <p class="text-red-600"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>

                                <div class="flex flex-col">
                                    <label for="phone" class="text-gray-400 mt-4">Number:</label>
                                    <input name="phone" id="phone"
                                           class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2"
                                           placeholder="Number" type="tel" value="{{ old('phone') }}">
                                    @error('phone')
                                    <p class="text-red-600"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                                <div class="flex flex-col">
                                    <label for="postcode" class="text-gray-400 mt-4">Post code</label>
                                    <input name="postcode" id="postcode"
                                           class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2"
                                           placeholder="Postcode" type="text" value="{{ old('postcode') }}">
                                    @error('postcode')
                                    <p class="text-red-600"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>

                                <div class="flex flex-col">
                                    <label for="extra_guests" class="text-gray-400 mt-4">Extra guests</label>
                                    <input name="extra_guests" id="extra_guests"
                                           class="bg-white rounded border border-gray-400 focus:outline-none focus:border-orange-500 text-base px-4 py-2 mb-4"
                                           placeholder="Extra guests" type="number"
                                           value="{{ old('extra_guests', 0) }}">
                                </div>

                                <div>
                                    <label for="duration_of_stay" class="text-gray-400">Duration of stay</label>
                                    <div class="relative  py-2 mb-4">
                                        <select name="duration_of_stay" id="duration_of_stay"
                                                class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                            <option value="30">Under 30 minutes</option>
                                            <option value="60">One hour</option>
                                            <option value="120">Two hours</option>
                                            <option value="180">Three hours</option>
                                            <option value="240">4 plus</option>
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('duration_of_stay')
                                    <p class="text-red-600"><small>{{ $message }}</small></p>
                                    @enderror
                                </div>
                                <x-button type="submit" text="Submit"/>
                                <p class="text-xs text-gray-500 mt-3">Information will be deleted after 21 days.</p>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>


