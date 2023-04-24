<span class="block">{{ $ticket->created_at }}</span>
<span class="block text-xs text-gray-400 dark:text-gray-600">{{ $ticket->created_at->diffForHumans(null,null,true) }}</span>