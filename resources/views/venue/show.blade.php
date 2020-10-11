<x-app-layout>
    <x-slot name="title">
        {{ $venue->name }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $venue->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mx-auto border border-gray-200">
                <ul class="shadow-box">
                    @foreach($visitorDays as $day=>$visitors)
                        <li class="relative border-b border-gray-200 cursor-pointer" x-data="{selected:null}">
                            <div class="w-full px-8 py-6 text-left "
                                 @click="selected !== 1 ? selected = 1 : selected = null">
                                <div class="flex items-center justify-between">
                                    <p>{{ $day }}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" class="w-6" x-show="selected == null">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" class="w-6" x-show="selected != null">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                                 x-ref="container1"
                                 x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                <div class="p-6">
                                    <table class="w-full">
                                        <thead>
                                        <tr>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                ID
                                            </th>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                Email
                                            </th>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                Phone
                                            </th>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                Postcode
                                            </th>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                Extra guests
                                            </th>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                Duration of stay (roughly)
                                            </th>
                                            <th class="text-teal-600 text-truncate px-4 py-2 select-none text-gray-700">
                                                Created
                                            </th>
                                        </tr>
                                        </thead>
                                        @foreach($visitors as $key => $visitor)
                                            <tr>
                                                <td>{{ $visitor->id }}</td>
                                                <td class="text-black text-truncate px-4 py-2 select-none text-gray-700">{{ $visitor->email }}</td>
                                                <td>{{ $visitor->phone }}</td>
                                                <td>{{ $visitor->postcode }}</td>
                                                <td>{{ $visitor->extra_guests }}</td>
                                                <td>{{ $visitor->duration_of_stay }}</td>
                                                <td>{{ $visitor->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                            </div>

                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

    </div>
</x-app-layout>
