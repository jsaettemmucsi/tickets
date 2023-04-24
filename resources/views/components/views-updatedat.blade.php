<span class="block">{{ $ticket->updated_at }}</span>
<span class="block text-xs text-gray-400 dark:text-gray-600">{{ $ticket->updated_at->diffForHumans(null,null,true) }}</span>