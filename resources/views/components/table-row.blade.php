<tr class="bg-white hover:bg-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 border-b border-gray-100 dark:border-gray-800 dark:hover:border-gray-700 border-l border-r">
	@foreach($data as $item)
	<td class="px-4 py-3">
		@if(is_array($item))
			<a class="text-blue-600 underline hover:text-blue-400" href="{{ $item[1] }}">{{ $item[0] }}</a>
		@else 
			{{ $item }}
		@endif
	</td>
	@endforeach
</tr>