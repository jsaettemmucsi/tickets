<div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded w-full block hover:shadow dark:text-gray-300 mb-2 pt-2 pb-3 pr-2 pl-5 relative dark:hover:bg-gray-700
@if ($worknote->internal) 
		border-amber-400 bg-amber-50
@elseif($worknote->type == 'Additional comments')
@else
@endif
">
<span class="absolute block w-1.5 top-0 bottom-0 left-0 rounded-l bg-gradient-to-b
@if ($worknote->internal) 
	from-amber-200 to-amber-400 dark:from-amber-600 dark:to-amber-900
@elseif($worknote->type == 'Additional comments') 
	from-gray-400 to-gray-800 dark:from-gray-500 dark:to-gray-900
@else 
	from-gray-200 to-gray-300 dark:from-gray-800 dark:to-black
@endif 
"></span>

	<div class="my-2 grid grid-cols-2 text-xs">

		<!-- user -->
		<div class="font-bold">
			<a class="text-slate-500 hover:underline text-sm" href="{{ $worknote->user->link() }}">
				{{ $worknote->user->name }}
			</a>
		</div>

		<!-- date -->
		<div class="text-right dark:text-slate-700 whitespace-nowrap mr-4">
			<span class="mr-2 dark:text-slate-300">
				{{ $worknote->type }}
			</span>
			&bull;
			<span class="mr-2 text-slate-400 whitespace-nowrap">
				{{ $worknote->created_at }}
			</span>
			&bull;
			<span class="text-slate-500 whitespace-nowrap">
				{{ $worknote->created_at->diffForHumans() }}
			</span>
		</div>
	</div>
	<div class="md my-4">
		{!! $worknote->body() !!}
	</div>
	@if ($worknote->body == "")
		<div class="grid grid-cols-2 gap-4">
			@foreach ($worknote->data as $change)
				<div class="text-right font-bold text-sm">{{ $change[0] }}</div>
				<div>{{ $change[1] }}
					@if ($change[2] != "")
						<span class="mx-1 italic dark:text-slate-500">was</span> {{ $change[2] }}
					@endif 
				</div>
			@endforeach
		</div>
	@endif
</div>