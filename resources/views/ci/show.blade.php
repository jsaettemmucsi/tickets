<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			<a href="/ci" class="text-blue-600 hover:text-blue-500 hover:underline">{{ __('Configuration Items') }}</a>
			&raquo;
			<a href="{{ $ci->link() }}" class="text-blue-600 hover:text-blue-500 hover:underline">
				{{ $ci->name }}
			</a>
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<form action="/ci/{{ $ci->id }}/update" method="POST">
						@csrf

						<div class="mb-4">
							<label for="businessservice_id" class="block mb-1">
								Business Service:
							</label>
							<x-select-input name="bs_id" id="bs_id" class="w-full">
								@foreach ($bss as $bs)
									<option value="{{ $bs->id }}" @if ($bs->id == $ci->bs_id) selected @endif 	>{{ $bs->name }}</option>
								@endforeach
							</x-select-input>
						</div>

						<div class="mb-4">
							<label for="vendor" class="block mb-1">
								Vendor:
							</label>
							<x-text-input type="text" class="w-full" id="vendor" name="vendor" value="{{ $ci->vendor }}" />
						</div>

						<div class="mb-4">
							<label for="name" class="block mb-1">
								Name:
							</label>
							<x-text-input type="text" class="w-full" id="name" name="name" value="{{ $ci->name }}" />
						</div>

						<x-primary-button>update</x-primary-button>

					</form>
				</div>
            </div>
        </div>
    </div>
</x-app-layout>
