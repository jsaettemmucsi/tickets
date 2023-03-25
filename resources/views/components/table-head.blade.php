<table class="dark:text-white table w-full rounded-xl overflow-clip shadow border-4 border-gray-600">

	<thead class="">	
		<tr>
			@foreach ($headers as $header)
				<th class="px-2 py-4 bg-gray-200 dark:bg-black">
					{{ $header }}
				</th>
			@endforeach
		</tr>
	</thead>