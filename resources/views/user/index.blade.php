<x-app-layout>
    <x-slot name="title">
        Users
    </x-slot>

    <x-slot name="header">
        <div class="flex space-x-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <p>
                <a class="text-orange-500 hover:text-orange-700" href="{{ route('dashboard.user.create') }}">Add</a>
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
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Email</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Created</th>
                        <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr class="bg-white rounded-lg shadow-lg py-1 overflow-hidden">
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $user->id }}</td>
                            <td class="text-truncate px-4 py-2 select-none text-gray-700">
                                {{ $user->name }}
                            </td>
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $user->email }}</td>
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $user->created_at }}</td>
                            <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">
                                <a href="{{ route('dashboard.user.edit', $user) }}">E</a>
                               @if($user->id !== 1)
                                    <a class="text-red-500" href="#" onclick="event.preventDefault(); document.getElementById('user-delete-{{ $user->id }}').submit()">D</a>
                                    <form method="post" action="{{ route('dashboard.user.destroy', $user) }}" class="hidden" id="user-delete-{{ $user->id }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                               @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
