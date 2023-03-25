<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
			<div class="block mb-4">
				<form action="/tickets" method="POST">
					@csrf
					<x-primary-button>new</x-primary-button>
				</form>
			</div>
			<span class="bg-red-600 bg-green-600 bg-amber-600"></span>

			<x-table-head :headers="['Number', 'Assignment group', 'Status', 'Priority', 'Assigned to', 'Short description', 'Updated', 'Created']" />
				<tbody class="text-gray-700 dark:text-gray-300">
					@foreach ($tickets as $ticket)
						<tr class="dark:bg-gray-800 bg-white dark:hover:bg-gray-700 hover:bg-gray-100">
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">
								<a href="{{ $ticket->link() }}" class="text-blue-600 hover:underline hover:text-blue-700">
									{{ $ticket->identifier() }}
								</a>
							</td>
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">
								<a href="{{ $ticket->assigned_group?->link() }}" class="text-blue-600 hover:underline hover:text-blue-700">
									{{ $ticket->assigned_group?->name }}
								</a>
							</td>
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">{{ $ticket->status }}</td>
							<td class="border-b border-gray-100 dark:border-gray-600">{!! $ticket->prioritybox() !!}</td>
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">
								<a href="{{ $ticket->assigned?->link() }}" class="text-blue-600 hover:underline hover:text-blue-700">
									{{ $ticket->assigned?->name }}
								</a>
							</td>
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">{!! $ticket->short_description() !!}</td>
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">{{ $ticket->updated_at->diffForHumans() }}</td>
							<td class="px-4 py-3 border-b border-gray-100 dark:border-gray-600">{{ $ticket->created_at->diffForHumans() }}</td>
						</tr>
					@endforeach
				<x-table-foot />
        </div>
    </div>

</x-app-layout>
