<table class="table w-full text-s relative counter text-sm">

	<thead class="bg-white text-black dark:bg-black dark:text-white shadow">	
		<tr>
			@foreach ($headers as $column)
				<th class="bg-white dark:bg-gray-800 p-2 sticky top-0 text-left">{{ App\Models\View::displayColumn($column) }}</th>
			@endforeach
		</tr>
	</thead>