<table class="table w-full text-s relative">

	<thead class="bg-white text-black dark:bg-black dark:text-white shadow">	
		<tr>
			@foreach ($headers as $column)
				<th class="bg-white dark:bg-gray-800 px-2 py-2 sticky top-0 text-left">{{ App\Models\View::displayColumn($column) }}</th>
			@endforeach
		</tr>
	</thead>