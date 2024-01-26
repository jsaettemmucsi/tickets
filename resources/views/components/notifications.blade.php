<div class="bg-white overflow-clip hidden dark:text-white dark:bg-gray-700 shadow rounded-xl fixed right-10 top-16 w-72 z-50 text-sm" id="notifications">
	@foreach(auth()->user()->notifications as $notification)
		<div class="block notification p-3 dark:hover:bg-gray-800 ">

			<!-- when -->
			<div class="dark:text-gray-500">{{ $notification->created_at->ago() }}</div>

			<!-- title -->
			<div class="md notification-title">{!! $notification->title() !!}</div>

			<!-- body -->
			<div class="md notification-body">{!! $notification->body() !!}</div>
		</div>		
	@endforeach

</div>