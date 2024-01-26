<div class="dark:text-gray-200 bg-gray-800 text-gray-100 fixed z-20 bottom-0 left-0 top-16 w-48">
	<x-link class="hover:bg-sagikos hover:text-white no-underline block whitespace-nowrap w-full px-4 py-3" href="/tickets/create"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> 
	<span class="underline">
		Create incident
	</span>
</x-link>

	<div class="mt-6 text-sm">
		@foreach($views as $viewx)
			<x-link class="no-underline block whitespace-nowrap w-full px-4 py-3 hover:bg-sagikos hover:text-white" href="{{ $viewx->link() }}">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline mr-2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
</svg>
				<span class="underline">
					{{ $viewx->name }} 
					<span class="p-1 text-xs rounded bg-gray-700 text-white">
						{{ $viewx->ticket_count() }}
					</span>
				</span>
			</x-link>
		@endforeach
	</div>
</div>