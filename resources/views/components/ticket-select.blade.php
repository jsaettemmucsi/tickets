<label for="{{ $field }}" class="dark:text-gray-500 text-right align-middle mr-5 pt-2 mb-1">
	@isset($required) <span class="text-red-500">&#10033;</span> @endisset 
	{{ $label }}</label>

<x-select-input 
	class="w-full align-middle dark:bg-gray-800 mb-1" 
	id="{{ $field }}" 
	name="{{ $field }}" 
>
<option value=""></option>
</x-select-input>
