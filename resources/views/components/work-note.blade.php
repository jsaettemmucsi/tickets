<div class="bg-white dark:bg-gray-900 rounded-xl w-full block dark:border-2 shadow dark:border-gray-800 dark:text-gray-300 mb-2 pt-2 pb-3 pr-2 pl-5 relative dark:hover:bg-gray-800">
<span class="absolute block
@if ($worknote->internal) bg-yellow-400 @else dark:bg-gray-700 bg-gray-500 @endif 
" style="width: 6px; bottom: 1px; top:1px; left:1px; z-index:3; border-radius: 5px;"></span>

	<div class="my-2 grid grid-cols-2 text-xs">
		<!-- user -->
		<div class="font-bold">
			<a class="text-slate-500 hover:underline text-sm" href="{{ $worknote->user->link() }}">
				{{ $worknote->user->name }}
			</a>
		</div>
		<!-- date -->
		<div class="text-right dark:text-slate-700">
			<span class="mx-2 dark:text-slate-300">
				{{ $worknote->type }}
			</span>
			&bull;
			<span class="mx-2 text-slate-400">
				{{ $worknote->created_at }}
			</span>
			&bull;
			<span class="mx-2 text-slate-500">
				{{ $worknote->created_at->diffForHumans() }}
			</span>
		</div>
	</div>
	@if ($worknote->type == "Diagram")
		<pre class="mermaid">
			{{ $worknote->body }}
		</pre>
	@else 
		<div class="md">
			{!! $worknote->body() !!}
		</div>
	@endif
	@if ($worknote->body == "")
		<div class="grid grid-cols-2 gap-4 auto-cols-min">
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