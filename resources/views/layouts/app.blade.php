<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}
		</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
		<link rel="icon" type="image/svg+xml" href="https://sagikos.com/sagikos-logo.svg">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-gray-900">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-200 dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="mt-12">
                {{ $slot }}
            </main>
			<footer class="dark:text-gray-400 text-center mt-12 text-xs py-2">
				&copy;
				<x-link href="https://sagikos.com" class="text-center">
					<img src="https://sagikos.com/sagikos-logo.svg" alt="" class="h-8 inline opacity-20 hover:opacity-100">
				</x-link> 2023
	
			</footer>
        </div>
		<x-notifications />

    </body>

<script>

	function toggle(el) {
		document.querySelector(el).classList.toggle('hidden');
	}

	function hide(el) {
		document.querySelector(el).classList.add('hidden');
	}
	
	function show(el) {
		document.querySelector(el).classList.remove('hidden');
	}

	document.querySelector('main').addEventListener('click', function() {
		hide('#notifications');
	});
	
</script>

</html>
