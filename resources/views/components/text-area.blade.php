@props(['disabled' => false])

<textarea {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:text-gray-300 dark:bg-gray-800 dark:text-gray-300 text-sm pl-4 pr-2 py-2 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow', 'rows' => 1]) !!} 
{{ $disabled ? 'disabled' : '' }}>{{ $slot }}</textarea>