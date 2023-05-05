@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'hover:shadow border border-slate-300 dark:border-slate-700 dark:bg-gray-800 text-sm dark:text-gray-300 pl-2 pr-2 py-2  focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg']) !!}>
	{{ $slot }}
</select>
