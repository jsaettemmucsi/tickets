<div class="dark:text-gray-200 bg-gray-800 text-gray-100 fixed z-10 bottom-0 left-0 top-16 w-48">
	<form action="/tickets" method="POST" class="text-center mt-4">@csrf <x-primary-button>Create incident</x-primary-button></form>

	<div class="mt-6 text-sm">
		@foreach($views as $viewx)
			<a class="block whitespace-nowrap text-blue-100 hover:text-white underline w-full px-4 py-3 hover:bg-gray-300 hover:bg-gray-700" href="{{ $viewx->link() }}">{{ $viewx->name }}</a>
		@endforeach
	</div>
</div>