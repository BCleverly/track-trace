<x-app-layout>
    <x-slot name="header">
        <div class="flex space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Venues') }}
            </h2>
            <p>
                <a class="text-orange-500 hover:text-orange-700" href="{{ route('dashboard.venue.create') }}">Create</a>
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full">
                    <thead>
                    <tr class="bg-white rounded-lg shadow-lg py-1 overflow-hidden border-b border-gray-300">
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">ID</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Name</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Url</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Active</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Created</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($venues as $key => $venue)
                        <tr class="bg-white rounded-lg shadow-lg py-1 overflow-hidden">
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $venue->id }}</td>
                            <td class="text-blue-500 hover:text-blue-300 text-truncate px-4 py-2 select-none text-gray-700">
                                <a href="{{ route('dashboard.venue.show', $venue) }}">
                                    {{ $venue->name }}
                                </a>
                            </td>
                            <td >
                                <button class="copy-venue-url" data-clipboard-text="{{ route('index.venue', $venue) }}">
                                    {{ route('index.venue', $venue) }}
                                </button>
                            </td>
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $venue->active ? 'Yes' : 'No' }}</td>
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $venue->created_at }}</td>
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">
                                <a href="{{ route('dashboard.venue.edit', $venue) }}">E</a>
                                <a class="text-red-500" href="#" onclick="event.preventDefault(); document.getElementById('venue-delete-{{ $venue->id }}').submit()">D</a>
                                <form method="post" action="{{ route('dashboard.venue.destroy', $venue) }}" class="hidden" id="venue-delete-{{ $venue->id }}">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                {{ $venues->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
