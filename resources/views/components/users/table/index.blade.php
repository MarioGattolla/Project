@props(['users'])

@php
    use App\Models\User;
    /** @var User[] $users */
@endphp

<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
    <tr>
        <th scope="col"
            class="px-6 py-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Name
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Status
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Role
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Edit</span>
        </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach($users as $user)
        <tr>
            <x-users.table.cell>
                <div class="flex items-center">
                    <div class="ml-4">
                        <div class="text-md">
                            {{$user->name}}
                        </div>
                    </div>
                </div>
            </x-users.table.cell>

            <x-users.table.cell>
                <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
            </x-users.table.cell>

            <x-users.table.cell class="text-md text-gray-500">
                {{$user->role->value}}
            </x-users.table.cell>

            <x-users.table.cell class="text-right text-md font-medium">
                <x-nav-link href="{{route('users.show', $user)}}" class="text-indigo-600 hover:text-indigo-900">Edit</x-nav-link>
            </x-users.table.cell>
        </tr>
    @endforeach
    </tbody>
</table>
