<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Teams') }}
        </h2>
    </x-slot>


	
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="block mb-4">
				<form action="/teams" method="POST">
					@csrf
					<x-primary-button>add</x-primary-button>
				</form>
			</div>

			<div class="block mb-4">
				<input type="checkbox" name="hit" id="hit" class="mr-2">
				<label for="hit">Hide inactive teams.</label>
			</div>

			<div class="block w-full">
				@foreach ($teams as $team)
					<x-card href="{{ $team->link() }}" header="{{ $team->name }}" footer="{{ $team->email }}">
					</x-card>
				@endforeach
			</div>
        </div>
    </div>
</x-app-layout>
