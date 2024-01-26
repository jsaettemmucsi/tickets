<x-app-layout>

    <div class="flex">

		<x-viewlist :views="$views" />

        <div class="w-full mx-auto ml-56">
			<div class="p-4 dark:text-white flex w-full italic">
				@isset($view->filter)
					<div class="w-full">
						Filters: {{ $view->filter }}
					</div>
				@endisset
				@isset($view->grouped_by)
					<div class="w-full">
						Group by: {{  $view->grouped_by }}
					</div>
				@endisset
				@isset($view->sorted_by)
					<div class="w-full">
						Order by: {{  $view->sorted_by }}
					</div>
				@endisset
				<div class="text-right w-full">
					{{ $view->ticket_count() }} {{ Str::plural('incident', $view->ticket_count()) }}
				</div>
			</div>

			<x-table-head :headers="$view->columns()" />
				<tbody class="text-sm">
					@foreach ($view->tickets() as $ticket)
						<tr class="hover:bg-gray-50 bg-white dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800">
							@foreach ($view->columns() as $column)
								<td class="px-2 py-1 border-b border-gray-300 dark:border-gray-700">{!! $ticket->showColumn($column) !!}</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			<x-table-foot />
		</div>
	</div>
</x-app-layout>
