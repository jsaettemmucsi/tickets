<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="/bs" class="text-blue-600 hover:text-blue-500 hover:underline">{{ __('Business Services') }}</a>
			&raquo;
			<a href="{{ $bs->link() }}" class="text-blue-600 hover:text-blue-500 hover:underline">
				{{ $bs->name }}
			</a>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<form action="/bs/{{ $bs->id }}/update" method="POST">
						@csrf

						<div class="mb-4 w-full block">
							<label for="name" class="block mb-1">
								Name:
							</label>
							<x-text-input class="w-full block" type="text" autofocus id="name" name="name" value="{{ $bs->name }}" />
						</div>

						<x-primary-button>update</x-primary-button>

					</form>

				</div>
            </div>
        </div>
    </div>
</x-app-layout>
