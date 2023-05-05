<x-app-layout>
    <div class="">
		<div class="flex">
			<x-viewlist :views="$views" />
			<form class="w-full relative" action="/tickets/{{ $ticket->id }}/update" method="POST">
				@csrf
				<div class="dark:bg-gray-900 border-b border-gray-800 bg-gray-200 w-full p-2 text-right sticky">
					<x-primary-button formaction="/tickets/{{ $ticket->id }}/update" title="Save and continue">update</x-primary-button>
					<x-primary-button formaction="/tickets/{{ $ticket->id }}/save" title="Save and stay">save</x-primary-button>
				</div>
        		<div class="max-w-5xl mx-auto text-sm mt-8">

				<div class="grid grid-cols-4">

					<x-ticket-field label="Opened" field="opened" value="{{ $ticket->opened }}" disabled /> 
					<x-ticket-select label="Channel" field="channel" value="{{ $ticket->channel }}" required="true" /> 
					<x-ticket-field label="Updated" field="updated" value="{{ $ticket->updated_at }}" disabled /> 
					<x-ticket-select label="Status" field="status" value="{{ $ticket->status }}" required="true" /> 
					<x-ticket-field label="Number" field="id" value="{{ $ticket->identifier() }}" disabled /> 
					<x-ticket-select label="Impact" field="impact" value="{{ $ticket->impact }}" required="true" /> 
					<x-ticket-select label="Requester" field="requester" required="true" required="true" /> 
					<x-ticket-select label="Urgency" field="urgency" value="{{ $ticket->urgency }}" required="true" /> 
					<x-ticket-select label="Category" field="category" value="{{ $ticket->category }}" required="true" /> 
					<x-ticket-field label="Priority" field="priority" value="{{ $ticket->priority }}" readonly="true" disabled /> 
					<x-ticket-select label="Subcategory" field="subcategory" value="{{ $ticket->subcategory }}" required="true" /> 
					<x-ticket-select label="Owner Group" field="owner_group" value="{{ $ticket->owner_group }}" readonly="true" /> 
					<x-ticket-select label="Business Service" field="businessservice_id" value="{{ $ticket->businessservice_id }}" required="true" /> 
					<x-ticket-select label="Assignment group" field="assignment_group" value="{{ $ticket->assignment_group }}" required="true" /> 
					<x-ticket-select label="Configuration item" field="configurationitem_id" value="{{ $ticket->configurationitem_id }}" required="true" /> 
					<x-ticket-select label="Assigned to" field="assigned_to" value="{{ $ticket->assigned_to }}"  /> 

					<label for="short_description" class="dark:text-gray-500 text-right align-middle mr-5 pt-2 mb-1 mt-6">
					<span class="text-red-500">&#10033;</span> Short description</label>
					<x-text-input type="text" autofocus class="w-full col-span-3 align-middle mb-1 mt-6" id="short_description" name="short_description" value="{{ $ticket->short_description }}" />

					<label for="description" class="dark:text-gray-500 text-right align-middle mr-5 pt-2">Description</label>
					<x-text-area rows=3 type="text" class="align-middle w-full col-span-3" id="description" name="description">{{ $ticket->description }}</x-text-area>

					<div id="sep-bar" class="my-12 col-start-1 col-end-5 border border-gray-200 dark:border-gray-800"></div>
					
					<div class="col-start-1 col-end-5 text-center mb-6 dark:text-white">
						<a href="https://mermaid.js.org/syntax/flowchart.html" class="text-blue-500 hover:underline" target="_new">Both notes and comments support Mermaid diagrams.</a> Wrap it in <code>```mermaid</code> and <code>```</code>.
					</div>

					<x-addl-comments />
					<x-work-notes :users="$users" />

					<div class="mt-5 dark:text-white col-start-2 col-end-5 w-full text-right">
						<x-primary-button formaction="/tickets/{{ $ticket->id }}/savepost">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
</svg>

							Post
						</x-primary-button>
					</div>

					<input type="hidden" name="active" value=1>

					<!-- Show whatever existing worknotes and addl comments this ticket has -->
					<div class="mt-5 dark:text-white col-start-2 col-end-5">
						<h1 class="font-2xl my-4">Activity Log</h1>

						@foreach($ticket->worknotes as $worknote)
							<x-work-note :worknote="$worknote" />
						@endforeach
						
					</div>
				</div>
			</form>
		</div>
		</div>
   	</div>
</div>

<script>

	const textareas = document.querySelectorAll('textarea');
	const max_textarearows = 25;

	// Terrible idea, this way anyone can input anything as cat and subcat.
	const channels = [
		{
			"id": "Direct input",
			"name": "Direct input",
		},
		{
			"id": "Email",
			"name": "Email",
		}
	];
	const categories = [
		{
			"id": "Enterprise Systems",
			"name": "Enterprise Systems",
		},
		{
			"id": "Websites",
			"name": "Websites",
		},
	];
	const subcategories = [
		{
			"id": "Bug",
			"name": "Bug",
			"category": "Enterprise Systems",
		},
		{
			"id": "Feature request",
			"name": "Feature request",
			"category": "Enterprise Systems",
		},
		{
			"id": "Unreachable",
			"name": "Unreachable",
			"category": "Websites",
		},
		{
			"id": "Feature request",
			"name": "Feature request",
			"category": "Websites",
		}
	];
	const statuses = [
		{
			"id": "New",
			"name": "New",
		},
		{
			"id": "In progress",
			"name": "In progress",
		},
		{
			"id": "On hold",
			"name": "On hold",
		},
		{
			"id": "Resolved",
			"name": "Resolved",
		},
		{
			"id": "Closed",
			"name": "Closed",
		}

	];
	const impacts = [
		{
			"id": 1,
			"name": "1 - Extensive/Widespread",
			"description": "Entire department, floor, branch, external customer.",
		},
		{
			"id": 2,
			"name": "2 - Significant/Large",
			"description": "Greater than 10 users.",
		},
		{
			"id": 3,
			"name": "3 - Moderate/Limited",
			"description": "Less than 10 users.",
		},
		{
			"id": 4,
			"name": "4 - Minor/Localized",
			"description": "Up to 2 users affected.",
		},
	];
	const urgencies = [
		{
			"id": 1,
			"name": "1 - Critical",
			"description": "User(s) cannot work or service is unavailable. No workaround.",
		},
		{
			"id": 2,
			"name": "2 - High",
			"description": "Some functions are unavailable. System and/or service is degraded.",
		},
		{
			"id": 3,
			"name": "3 - Medium",
			"description": "System and/or service is disrupted/slow but still available. Workaround available.",
		},
		{
			"id": 4,
			"name": "4 - Low",
			"description": "User's activity can be rescheduled without impact on the business.",
		},
	];

	const priorities = [
		{ "id": "Low (P4)", "name": "Low (P4)", "impact": 4, "urgency": 4, },
		{ "id": "Medium (P3)", "name": "Medium (P3)", "impact": 4, "urgency": 3, },
		{ "id": "Medium (P3)", "name": "Medium (P3)", "impact": 4, "urgency": 2, },
		{ "id": "High (P2)", "name": "High (P2)", "impact": 4, "urgency": 1, },

		{ "id": "Low (P4)", "name": "Low (P4)", "impact": 3, "urgency": 4, },
		{ "id": "Medium (P3)", "name": "Medium (P3)", "impact": 3, "urgency": 3, },
		{ "id": "High (P2)", "name": "High (P2)", "impact": 3, "urgency": 2, },
		{ "id": "High (P2)", "name": "High (P2)", "impact": 3, "urgency": 1, },

		{ "id": "Low (P4)", "name": "Low (P4)", "impact": 2, "urgency": 4, },
		{ "id": "Medium (P3)", "name": "Medium (P3)", "impact": 2, "urgency": 3, },
		{ "id": "High (P2)", "name": "High (P2)", "impact": 2, "urgency": 2, },
		{ "id": "Critical (P1)", "name": "Critical (P1)", "impact": 2, "urgency": 1, },

		{ "id": "Low (P4)", "name": "Low (P4)", "impact": 1, "urgency": 4, },
		{ "id": "High (P2)", "name": "High (P2)", "impact": 1, "urgency": 3, },
		{ "id": "Critical (P1)", "name": "Critical (P1)", "impact": 1, "urgency": 2, },
		{ "id": "Critical (P1)", "name": "Critical (P1)", "impact": 1, "urgency": 1, },
	];

	const bss = {!! $bss->toJson() !!};
	const cis = {!! $cis->toJson() !!};
	const teams = {!! $teams->toJson() !!};
	const users = {!! $users->toJson() !!};

	fillSelect('businessservice_id', bss, '{{ $ticket->businessservice_id }}');
	fillSelect('category', categories, '{{ $ticket->category }}');
	fillSelect('status', statuses, '{{ $ticket->status }}');
	fillSelect('impact', impacts, '{{ $ticket->impact }}');
	fillSelect('urgency', urgencies, '{{ $ticket->urgency }}');
	fillSelect('owner_group', teams, '{{ $ticket->owner_group }}');
	fillSelect('assignment_group', teams, '{{ $ticket->assignment_group }}');
	fillSelect('requester', users, '{{ $ticket->requester }}');
	fillSelect('channel', channels, '{{ $ticket->channel }}');

	fillSubSelect('subcategory', subcategories, 'category', 'category', '{{ $ticket->subcategory }}');
	fillSubSelect('configurationitem_id', cis, 'businessservice_id', 'bs_id', '{{ $ticket->configurationitem_id }}')
	fillSubSelectSpecial('assigned_to', teams, 'assignment_group', 'users', '{{ $ticket->assigned_to }}');

	function resize_textarea(ta) { 
		if (!ta.hasOwnProperty("origrows")) {
			ta.origrows = ta.rows;
		}
		ta.rows = ta.value.split('\n').length;
		if (ta.rows > max_textarearows) { ta.rows = max_textarearows; }
		if (ta.rows < ta.origrows) { ta.rows = ta.origrows; }
	}

	textareas.forEach(function(ta) {
		ta.addEventListener('keyup', function(evt) {
			resize_textarea(ta);
		});
	});

	textareas.forEach(function(ta) {
		resize_textarea(ta)
	});

	const priority = document.querySelector("#priority");
	const impact = document.querySelector("#impact");
	const urgency = document.querySelector("#urgency");

	function recalcPriority() {
		priorities.forEach(function(prio) {
			if (prio.impact == impact.value && prio.urgency == urgency.value) {
				priority.value = prio.name;
			}
		})
	}

	function fillSelect(select_element, json_obj, default_el) {
		let selected_element = document.querySelector("#" + select_element);
		json_obj.forEach(function(opt) {
			let newOption = document.createElement("option");
			newOption.text = opt.name;
			newOption.value = opt.id;
			selected_element.add(newOption);
		});

		if (default_el) {
			for (let i = 0; i < selected_element.options.length; i++) {
				if (selected_element.options[i].value == default_el) {
					selected_element.selectedIndex = i;
				}
			}
		}
	}

	function option(text, value) {
		let opt = document.createElement("option");
		opt.text = text;
		opt.value = value;
		return opt;
	}

	function fsst(target_element, object, trigger_element, param) {
		target_element.length = 0;
			target_element.add(option("", 0));
			object.forEach(function(opt) {
				if (opt[param] == trigger_element.value) {
					target_element.add(option(opt.name, opt.id));
				}
			});
	}

	function fillSubSelect(target, object, trigger, param, default_el) {
		let target_element = document.querySelector("#" + target);
		let trigger_element = document.querySelector("#" + trigger);

		if (trigger_element.selectedIndex) {
			fsst(target_element, object, trigger_element, param);
		}

		trigger_element.addEventListener('change', function() {
			fsst(target_element, object, trigger_element, param);
		});

		if (default_el) {
			for (let i = 0; i < target_element.options.length; i++) {
				if (target_element.options[i].value == default_el) {
					target_element.selectedIndex = i;
				}
			}
		}
	}

	function fillSubSelectSpecial(target, object, trigger, param, default_el) {
		let target_element = document.querySelector("#" + target);
		let trigger_element = document.querySelector("#" + trigger);
		if (trigger_element.selectedIndex) {
			fssh(target_element, object, trigger_element, param, default_el);
		}
		trigger_element.addEventListener('change', function() {
			fssh(target_element, object, trigger_element, param, default_el);
		});

		if (default_el) {
			for (let i = 0; i < target_element.options.length; i++) {
				if (target_element.options[i].value == default_el) {
					target_element.selectedIndex = i;
				}
			}
		}
	}

	function fssh(target_element, object, trigger_element, param) {
		target_element.length = 0;
			target_element.add(option("", 0));
			object.forEach(function(opt) {
				if (opt.id == trigger_element.value) {
					opt[param].forEach(function(opx) {
						target_element.add(option(opx.name, opx.id));
					});
				}
			});
	}

	impact.addEventListener('change', recalcPriority);
	urgency.addEventListener('change', recalcPriority);

	document.title = "Tickets - {{ $ticket->identifier() }}";

</script>

<x-mermaid-include />


</x-app-layout>
