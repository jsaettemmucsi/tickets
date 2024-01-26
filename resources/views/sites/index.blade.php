<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sites') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
			<div class="block mb-4">
				<form action="/sites" method="POST">
					@csrf
					<x-primary-button>add</x-primary-button>
				</form>
			</div>

			<div class="block w-full">
				@foreach ($sites as $site)
					<x-card href="{{ $site->link() }}" header="{{ $site->name }}">
						{{ $site->description ?? '' }}
					</x-card>
				@endforeach
			</div>
        </div>
    </div>
</x-app-layout>
