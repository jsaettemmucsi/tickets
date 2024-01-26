<label id="label-{{ $field }}" for="{{ $field }}" class="dark:text-gray-500 text-right text-sm align-middle mr-4 pt-2 mb-1 @isset($hidden) hidden @endisset">
	@isset($required) <span class="text-red-500">&#10033;</span> @endisset 
	{{ $label }}</label>


	<div class="@isset($hidden) hidden @endisset" id="parent-{{$field}}">
		<x-select-input 
			class="w-full align-middle dark:bg-gray-800 mb-1" 
			id="{{ $field }}" 
			name="{{ $field }}" 
			:disabled="$disabled ?? ''"
		>
			<option value=""></option>
		</x-select-input>

	</div>
