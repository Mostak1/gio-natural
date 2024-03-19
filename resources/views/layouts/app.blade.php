<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- DataTable --}}
    <link
        href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.css"
        rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.tailwindcss.min.css"> --}}
    {{-- DataTable --}}

    <style>
    .dataTables_wrapper .dataTables_length select {
            padding-right: 20px;
    }

    .dataTables_wrapper .dataTables_filter input{
        margin-right: 5px;
    }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('header')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{-- {{ $slot }} --}}
            @yield('content')
        </main>
    </div>
    {{-- DataTable --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-1.13.8/af-2.6.0/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/cr-1.7.0/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/rr-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.js"></script>

    {{-- DataTable --}}
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: ['excel']
            });
            var table = $('#dataTable').DataTable();

            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'copy', 'excel', 'print'
                ]
            });
            table.buttons().container().appendTo($('.tablebtn', table.table().container()));
            $('.tablebtn .dt-buttons').removeClass('flex-wrap');
            $('.tablebtn .btn').removeClass('btn-secondary').addClass(
                'text-gray-900 bg-white border border-gray-600 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700'
            );

        });
    </script>

    @yield('footer')
</body>

</html>
