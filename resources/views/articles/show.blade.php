<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="/kb" class="text-blue-500 underline">Articles</a> &raquo;
			<a href="{{ $article->link() }}" class="text-blue-500 underline">
				{{ $article->headline() }}
			</a>
        </h2>
    </x-slot>

	<div class="py-12">
		<div class="max-w-3xl mx-auto p-4 dark:text-white">
			<div id="errormsg" class="inline rounded text-red-600 p-3"></div>
			<div class="">
				<a href="#" id="viewbutton" class="px-3 py-1 inline-block border-b-4 border-blue-700 hover:border-blue-500">View</a>
				<a href="#" id="editbutton" class="px-3 py-1 inline-block border-b-4 border-blue-900 hover:border-blue-500">Edit</a>
			</div>
		</div>
		<div class="rounded-xl max-w-3xl mx-auto bg-white dark:bg-gray-800 dark:text-gray-400 shadow p-4">

			<!-- Editor -->
			<div class="p-4 shadow block" id="page-edit">
				<div class="text-2xl font-bold mt-2 mb-4">
					<!-- Indicator -->
					<span class="rounded-full inline-block w-4 h-4" id="indicator" style="background:#0c04;"></span>
					{{  $article->headline() }}
				</div>
				
				<x-text-area rows="25" id="artbody" name="artbody" class="bg-white dark:bg-black w-full">{{ $article->body }}</x-text-area>
				<span class="text-gray-500 italic">
					Changes are saved automatically. Wrap snake words in &lbrace;&lbrace; and &rbrace;&rbrace; to trigger link to another article. Example: &lbrace;&lbrace; Sagikos_Tickets &rbrace;&rbrace; will lead to <a class="text-blue-500 dark:hover-text-blue-300 underline" href="/kb/Sagikos_Tickets">Sagikos Tickets</a>
				</span>
			</div>

			<!-- Viewer -->
			<div class="p-4 block" id="page-view">
				<div class="text-2xl font-bold mt-2 mb-4">
					<!-- Indicator -->
					<span class="rounded-full inline-block w-4 h-4" id="indicator" style="background:#0c04;"></span>
					{{  Str::headline($article->title) }}
				</div>
				
				<div id="artbody-view" name="artbody-view" class="dark:text-gray-400 pl-4 pr-2 py-2 w-full md">{!! $article->md() !!}</div>

			</div>
        </div>
    </div>

<script>
	const artbody = el("artbody");
	const indicator = el("indicator");
	const viewbutton = el("viewbutton");
	const editbutton = el("editbutton");
	const errormsg = el("errormsg");
	artbody.addEventListener("keyup", async function(evt) {

		errormsg.innerHTML = "";
		
		// Show indicator as saving... yellow.
		indicator.style.background = "#fecb0044";

		try {
			const res = await axios.post('/updatearticle', {
				params: {
					id: {{ $article->id }},
					body: artbody.value,
				}
			});
			const data = await res;
			if (data.data == "good") {
				indicator.style.background = "#0c04";
			}
		} catch (error) {
			if (error.message == "Network Error") {
				errormsg.innerHTML = "Network Error. Please try again in a while.";
			}
			console.error(error);
		}

	});

	editbutton.addEventListener("click", function() {
		show(el("page-edit"));
		hide(el("page-view"));
		editbutton.classList.add("border-blue-700");
		viewbutton.classList.remove("border-blue-700");
	});

	viewbutton.addEventListener("click", async function() {

		// first update the view based on the edited data.
		try {
			const res = await axios.post('/md', {
				params: {
					body: artbody.value,
				}
			});
			const data = await res;
			el("artbody-view").innerHTML = data.data;
		} catch (error) {
			if (error.message == "Network Error") {
				errormsg.innerHTML = "Network Error. Please try again in a while.";
			}
			console.error(error);
		}


		show(el("page-view"));
		hide(el("page-edit"));
		editbutton.classList.remove("border-blue-700");
		viewbutton.classList.add("border-blue-700");
	});

	function el(t) {
		return document.querySelector("#" + t);
	}

	function toggle(el) {

	}

	function show(el) {
		el.style.display = "block";
	}

	function hide(el) {
		el.style.display = "none";
	}

	hide(el("page-edit"));


</script>

<x-mermaid-include />

</x-app-layout>
