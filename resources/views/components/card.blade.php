<a {{ $attributes->merge(['class' => "inline-block box-sizing bg-white hover:bg-gray-50 shadow text-black dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white dark:text-gray-200 p-4 rounded mb-1 mr-1"]) }}>
	@isset($tag)
		<span class="inline-block px-1 text-xl dark:bg-gray-700 bg-gray-100 dark:text-gray-400 text-gray-800 rounded text-xs uppercase mb-1">{{ $tag }}</span>
	@endisset 
	<span class="font-bold py-1 text-xl">{{ $header ?? ''}}</span>
	<span class="block">{{ $slot }}</span>
	<span class="text-sm block text-gray-500">{{ $footer ?? '' }}</span>
</a>
