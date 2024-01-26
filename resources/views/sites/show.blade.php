<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<form action="/sites/{{ $site->id }}/update" method="POST">
						@csrf

					<div class="mb-4">
						<label for="name" class="block mb-1">
							Name:
						</label>
						<x-text-input type="text" class="mt-1 block w-full" id="name" name="name" value="{{ $site->name }}" />
					</div>

                    <div class="mb-4">
						<label for="team_id" class="block mb-1">
							Default Team:
						</label>

						<x-select-input name="team_id" id="team_id" class="w-full">
                            <option value=""></option>
							@foreach ($teams as $team)
								<option value="{{ $team->id }}" @if ($team->id == $site->team_id) selected @endif 	>{{ $team?->name }}</option>
							@endforeach
						</x-select-input>
					</div>

					<div class="mb-4">
						<label for="description" class="block mb-1">
							Description:
						</label>
						<x-text-input type="text" class="mt-1 block w-full" id="description" name="description" value="{{ $site->description }}" />
					</div>



						<x-primary-button>update</x-primary-button>
						<a class="text-red-500 underline ml-8" href="{{ $site->link() }}/delete">Delete</a>
					</form>

				</div>
            </div>
        </div>
    </div>

</x-app-layout>
