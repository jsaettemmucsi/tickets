@props(['disabled' => false])

@if ($disabled)
	<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-200 shadow border-0 dark:border dark:border-gray-700 dark:bg-gray-900 text-sm dark:text-gray-300 pl-2 pr-2 py-2 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg']) !!}>
@else
	<input {!! $attributes->merge(['class' => 'bg-white shadow border-0 dark:border dark:border-gray-700 dark:bg-gray-800 text-sm dark:text-gray-300 pl-2 pr-2 py-2 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg']) !!}>
@endif
