<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Business Services') }}
        </h2>
    </x-slot>


	
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
					<div class="block mb-4">
						<form action="/bs" method="POST">
							@csrf
							<x-primary-button>add</x-primary-button>
						</form>
					</div>

					<div class="block w-full">
						@foreach ($bss as $bs)
							<x-card href="{{ $bs->link() }}" header="{{ $bs->name }}">
							</x-card>
						@endforeach
					</div>
            </div>
    </div>
</x-app-layout>
