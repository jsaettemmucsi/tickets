<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
			<x-table-head :headers="['ID', 'Title', 'Author', 'Created', 'Updated']" />
				<tbody class="text-gray-700 dark:text-gray-300 shadow">
					@foreach ($articles as $article)
					<x-table-row 
						:data="[
							[
								$article->identifier(), 
								$article->adminlink()
							],
							[
								Str::headline($article->title),
								$article->link()
							],
							[
								$article->author->name,
								$article->author->link()
							],
							$article->created_at->diffForHumans(),
							$article->updated_at->diffForHumans(),
						]"
					/>
					@endforeach
			<x-table-foot />
		</div>
    </div>

</x-app-layout>
