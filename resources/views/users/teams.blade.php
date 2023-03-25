<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<div class="mb-4">
						Edit Teams for: {{ $user->name }}
					</div>
					<form action="/users/{{ $user->id }}/teams/update" method="POST">
						@csrf
						<div class="grid grid-cols-3 gap-4"> 
							<div>
								<div class="font-bold">Available Teams:</div>
								<x-select-input name="teams_available[]" id="teams_available" multiple size=10>
									@foreach ($teams as $team)
										<option value="{{ $team->id }}">{{ $team->name }}</option>
									@endforeach
								</x-select-input>
							</div>
							<div>
								<button type="button" id="moveleft" class="block p-2 rounded bg-gray-500 mb-1">&larr;</button>
								<button type="button" id="moveright" class="block p-2 rounded bg-gray-500">&rarr;</button>
							</div>
							<div>
								<div class="font-bold">Selected Teams:</div>
								<x-select-input name="teams_selected[]" id="teams_selected" multiple size=10>
									@foreach ($user->teams as $team)
										<option value="{{ $team->id }}">{{ $team->name }}</option>
									@endforeach
								</x-select-input>

							</div>
						</div>
						<div class="block">
							<x-primary-button onClick="selectAll">save</x-primary-button>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
	const moveLeft = document.querySelector("#moveleft");
	const moveRight = document.querySelector("#moveright");
	const teamsAvailable = document.querySelector("#teams_available");
	const teamsSelected = document.querySelector("#teams_selected");

	moveLeft.addEventListener("click", moveleft);
	moveRight.addEventListener("click", moveright);

	function moveright() {
		if (teamsAvailable.selectedOptions.length > 0) {
			for(let i = 0; i < teamsAvailable.selectedOptions.length; i++) {
				addToRight(teamsAvailable.selectedOptions[i]);
			}
		}
	}

	function moveleft() {
		console.log(teamsSelected.value);
	}

	function addToRight(opt) {
		let exists = false;
		// loop through options on the right, see if value exist already.
		
		if (teamsSelected.selectedOptions.length > 0) {
			for(let i = 0; i < teamsSelected.selectedOptions.length; i++) {
			}
		}

		// if not, add the full option to the select list.
		if (exists == false) {
			teamsSelected.add(opt);
		}

	}
	
	function selectAll()
    {
		for (let i = 0; i < teamsSelected.options.length; i++) {
			teamsSelected.options[i].selected = "true";
		}
    }

</script>
