<label for="work-notes" class="dark:text-gray-500 text-right align-middle mr-5">Work notes (only visible by IT)</label>
<div class="w-full col-span-3">

	<div class="relative">
		<span class="absolute block bg-gradient-to-b from-amber-200 to-amber-400 top-0 w-1.5 left-0 bottom-0 z-10 rounded-l"></span>
		
		<x-text-area :disabled="$disabled ?? ''" rows=3 type="text" class="w-full overflow-clip border-amber-400 bg-amber-50" id="work-notes" name="work-notes" placeholder="Work notes (only visible by IT)"></x-text-area>
	</div>
	<div id="user-list" class="col-span-3 hidden text-center w-full">
		@foreach($users as $user)
			<div class="user-choice text-sagikos cursor-pointer hover:bg-gray-50 hover:shadow inline-block p-2 bg-white border rounded" id="user-{{ $user->id }}">{{ $user->name }}</div>
		@endforeach
	</div>
	<input type="hidden" id="tagged-users" name="tagged-users" value="">

</div>
<script>
	let nwn = document.querySelector('#work-notes');
	let userList = document.querySelector('#user-list');
	let userChoices = document.querySelectorAll('.user-choice');
	let tu = document.querySelector('#tagged-users');
	
	let taggedUsers = [];
	userChoices.forEach(function(choice) {
		choice.addEventListener('click', function(e) {
			nwn.value += e.target.innerHTML;
			
			// close the menu
			hideUserList();

			// tenatively tag the user
			taggedUsers.push(e.target.id);

			// set the tagged users to the input element
			tu.value = JSON.stringify(taggedUsers);

			// not sure how to handle deleted tags yet :)
		});
	})
	nwn.addEventListener("keyup", function(e) {
		if (e.key == "@") {
			showUserList(e);
		}
		else if (e.key == "Shift") {
			// ignore shift
		}
		else {
			hideUserList();
		}

		// clear tagged user list if the text is cleared.
		if (nwn.value == "") {
			taggedUsers.length = 0;
		}
	})

	function showUserList(e) {
		userList.style.top = e.pageYOffset + 100;
		userList.classList.remove('hidden');
	}

	function hideUserList() {
		userList.classList.add('hidden');
	}
</script>