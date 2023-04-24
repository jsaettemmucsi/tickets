<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="/teams" class="text-blue-600 hover:text-blue-500 hover:underline">{{ __('Teams') }}</a>
			&raquo;
			<a href="{{ $team->link() }}" class="text-blue-600 hover:text-blue-500 hover:underline">
				{{ $team->name }}
			</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<form action="/teams/{{ $team->id }}/update" method="POST">
						@csrf

					<div class="mb-4">
						<label for="name" class="block mb-1">
							Name:
						</label>
						<x-text-input type="text" class="mt-1 block w-full" id="name" name="name" value="{{ $team->name }}" />
					</div>

					<div class="mb-4">
						<label for="email" class="block mb-1">
							Email:
						</label>
						<x-text-input type="email" class="mt-1 block w-full" id="email" name="email" value="{{ $team->email }}" />
					</div>

					<div class="mb-4">
						<label for="description" class="block mb-1">
							Description:
						</label>
						<x-text-input type="text" class="mt-1 block w-full" id="description" name="description" value="{{ $team->description }}" />
					</div>
						<x-primary-button>update</x-primary-button>
					</form>

				</div>
            </div>
        </div>
    </div>
</x-app-layout>
