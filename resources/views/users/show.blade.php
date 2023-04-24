<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="/users" class="text-blue-600 hover:text-blue-500 hover:underline">{{ __('Users') }}</a>
			&raquo;
			<a href="{{ $user->link() }}" class="text-blue-600 hover:text-blue-500 hover:underline">
				{{ $user->name }}
			</a>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<form action="/users/{{ $user->id }}/update" method="POST">
						@csrf

						<div class="mb-4">
							<label for="name" class="block mb-1">
								Name:
							</label>
							<x-text-input type="text" class="w-full block mt-1" id="name" name="name" value="{{ $user->name }}" />
						</div>

						<div class="mb-4">
							<label for="email" class="block mb-1">
								Email:
							</label>
							<x-text-input type="email" class="w-full block mt-1" id="email" name="email" value="{{ $user->email }}" />
						</div>

						<div class="mb-4">
							<label for="default_team" class="block mb-1">
								Default team:
							</label>
						</div>

						<x-primary-button>update</x-primary-button>
					</form>


				</div>
            </div>
			<div class="mt-2overflow-hidden p-6 text-gray-900 dark:text-gray-100">
				<div class="text-xl font-bold">
					Teams
				</div>
				<form action="/users/{{ $user->id }}/teams/edit" method="POST">@csrf <x-primary-button>Edit</x-primary-button></form>

				<table class="table w-full">
					<thead>
						<tr>
							<th>Name</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($user->teams as $team)
							<tr>
								<td>{{ $team->name }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
        </div>
    </div>
</x-app-layout>
