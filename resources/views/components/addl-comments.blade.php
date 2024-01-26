<label for="addl-comments" class="mt-3 dark:text-gray-500 text-right align-middle mr-5">Additional comments (customer visible)</label>

<div class="w-full col-span-3 relative mb-1 mt-3">
	
	<span class="absolute block bg-gradient-to-b from-gray-400 to-gray-800 bottom-0 top-0 w-1.5 left-0 z-10 rounded-l"></span>

	<x-text-area rows=3 type="text" class="w-full overflow-clip border-gray-400" id="addl-comments" name="addl-comments" :disabled="$disabled ?? ''" placeholder="Additional comments (customer visible)"></x-text-area>
</div>