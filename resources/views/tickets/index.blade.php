<x-app-layout>

    <x-slot name="header" class="grid grid-cols-2">
        <h2 class="block font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
		<div class="block">
				<form action="/tickets" method="POST">
					@csrf
					<x-primary-button>new</x-primary-button>
				</form>
			</div>
    </x-slot>

    <div class="pt-1 flex">
		<div class="dark:text-gray-200 p-2">
			<h1 class="text-xl font-bold text-center">Views</h1>
			@foreach($views as $view)
			<a class="block whitespace-nowrap text-blue-500 underline w-full p-4" href="{{ $view->link() }}">{{ $view->name }}</a>
			@endforeach
			
		</div>
        <div class="w-full mx-auto sm:px-2 lg:px-2">
        </div>
    </div>
</x-app-layout>
