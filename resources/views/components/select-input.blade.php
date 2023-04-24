@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'shadow border-0 dark:border dark:border-slate-700 dark:bg-gray-800 text-sm dark:text-gray-300 pl-4 pr-2 py-3  focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg']) !!}>
	{{ $slot }}
</select>
