@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 pl-4 pr-2 py-2  focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md']) !!}>
