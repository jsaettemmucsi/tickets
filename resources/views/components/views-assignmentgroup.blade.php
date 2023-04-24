<x-views-link :href="$ticket->assigned_group?->link()">
	{{ $ticket->assigned_group?->name }}
</x-views-link>
