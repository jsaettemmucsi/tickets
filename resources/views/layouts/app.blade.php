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
            <main class="mt-16">
                {{ $slot }}
            </main>
			<footer class="dark:bg-gray-800 dark:text-gray-400 text-center mt-24 py-2">
				&copy; 
				<x-link href="https://sagikos.com">
					<img src="https://sagikos.com/sagikos-logo.svg" class="inline h-6">
				</x-link> 2021-2023<br>
				<img src="https://saettem.com/saettem-logo-2023-2-1.svg" class="inline h-8">
				<x-link href="https://saettem.com">
					Saettem
				</x-link> 2012-2021<br>
				ITAC-Pait 2005-2012<br> 
				IESO 1997-2005
	
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
