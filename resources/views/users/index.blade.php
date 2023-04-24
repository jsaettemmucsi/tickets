<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>


	
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-0 text-gray-900 dark:text-gray-100">
					<div class="block mb-4">
						<form action="/users" method="POST">
							@csrf
							<x-primary-button>add</x-primary-button>
						</form>
					</div>

					<div class="block w-full ml-1">
						@foreach ($users as $user)
							<x-card href="{{ $user->link() }}" header="{{ $user->name }}" footer="{{ $user->email }}">
							</x-card>
						@endforeach
					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
