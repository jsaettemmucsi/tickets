<div class="bg-white hover:bg-gray-50 dark:bg-gray-800 rounded w-full block dark:border-2 shadow dark:border-gray-800 dark:text-gray-300 mb-2 pt-2 pb-3 pr-2 pl-5 relative dark:hover:bg-gray-700">
<span class="absolute block
@if ($worknote->internal) bg-gradient-to-b from-amber-400 to-amber-800 @else dark:bg-gradient-to-b from-gray-500 to-gray-900 bg-gray-500 @endif 
" style="width: 6px; bottom:2px; top:2px; left:2px; z-index:3; border-radius: 0;"></span>

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