<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test BD</title>
    <link rel="icon" href="{{asset('assets/img/icon.png')}}" type="image/png">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" id="token">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    {{-- lightbox --}}
    <link rel="stylesheet" href="{{ asset('assets/dist/css/lightbox.min.css') }}">

    
    <!-- DataTable CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-html5-2.4.0/b-print-2.4.0/r-2.5.0/datatables.min.css"
        rel="stylesheet" />
    <!-- DataTable CSS end-->
    
    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- custome  css  --}}
    {{-- @vite(['resources/scss/home.scss']) --}}
    <link rel="stylesheet" href="{{asset('build/assets/home-b3f4dac9.css')}}">
    @yield('style')
</head>

<body>
    @php
        $user = Auth::user();
    @endphp
    {{-- navbar include --}}
    @include('users.layouts.nav')
    <!-- Header End -->
    <!-- Main Content -->
    <div class="">

        @include('layouts.flash')
    </div>

    @yield('content')

    <!-- Footer -->
    @include('users.layouts.footer')


    <!-- jQuery CDN Here -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTable JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-html5-2.4.0/b-print-2.4.0/r-2.5.0/datatables.min.js">
    </script>
    <!-- DataTable JS -->
    {{-- lightbox --}}
    <script src="{{ asset('assets/dist/js/lightbox-plus-jquery.min.js') }}"></script>
   
    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script>
        AOS.init();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="X-CSRF-TOKEN"]').attr('content')
            }
        });
       
        
    </script>
    <script>
        $(document).ready(function() {
            let cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            let itemCount = cartItems.length;
            $('#additm').text(itemCount);
        });
    </script>

    <script>
        $(document).ready(function() {

            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
            // =========
            // for subcats as cats
            function selectscat(ob) {
                $("#subcategory_id").empty().append('<option value = "0">All');

                let html = "<option value='0'>All</option>";
                for (const key in ob) {
                    if (Object.hasOwnProperty.call(ob, key)) {
                        html += "<option value='" + key + "'>" + ob[key] + "</option>";
                    }
                }
                $("#subcategory_id").html(html);
            }
            $("#category_id").change(function() {
                // console.log( $(this).val() )
                let URL = "{{ url('subcats') }}";
                $.ajax({
                    type: "post",
                    url: URL + '/' + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        selectscat(response);
                    }
                });
            });

            // for topics as subcats
            function selecttopic(ot) {
                // $("#topic_id").html("");
                let html = "<option value='0'>All</option>";
                for (const k in ot) {
                    if (Object.hasOwnProperty.call(ot, k)) {

                        html += "<option value='" + k + "'>" + ot[k] + "</option>";
                    }
                }
                $("#topic_id").html(html);
            }
            $("#subcategory_id").on('change', function() {

                // })
                // $("#subcategory_id").change(function() {
                if ($(this).val() == "null") {
                    $("#topic_id").empty().append('<option value = "0">All');
                    return;
                }
                // console.log( $(this).val() )
                let URL = "{{ url('topics') }}";
                $.ajax({
                    type: "post",
                    url: URL + '/' + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        selecttopic(response);
                    }
                });
            });

        });
        // district,thana,institute autocomplete common scripts
        $(document).ready(function() {

            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
            // =========
            // for district 
            function districtSellect(ob) {
                $("#district_id").empty().append('<option value = "0">All');

                let html = "<option value='0'>All</option>";
                for (const key in ob) {
                    if (Object.hasOwnProperty.call(ob, key)) {
                        html += "<option value='" + key + "'>" + ob[key] + "</option>";
                    }
                }
                $("#district_id").html(html);
            }
            $("#board_id").change(function() {
                // console.log( $(this).val() )
                let URL = "{{ url('dist') }}";
                $.ajax({
                    type: "post",
                    url: URL + '/' + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        districtSellect(response);
                    }
                });
            });

            // for thana
            function selectThana(ot) {

                let html = "<option value='0'>All</option>";
                for (const k in ot) {
                    if (Object.hasOwnProperty.call(ot, k)) {

                        html += "<option value='" + k + "'>" + ot[k] + "</option>";
                    }
                }
                $("#thana_id").html(html);
            }
            $("#district_id").on('change', function() {

                // })
                // $("#subcategory_id").change(function() {
                if ($(this).val() == "null") {
                    $("#thana_id").empty().append('<option value = "0">All');
                    return;
                }
                // console.log( $(this).val() )
                let URL = "{{ url('thana') }}";
                $.ajax({
                    type: "post",
                    url: URL + '/' + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        selectThana(response);
                    }
                });
            });
            // for institute
            function selectIns(ot) {

                let html = "<option value='0'>All</option>";
                for (const k in ot) {
                    if (Object.hasOwnProperty.call(ot, k)) {

                        html += "<option value='" + k + "'>" + ot[k] + "</option>";
                    }
                }
                $("#institute_id").html(html);
            }
            $("#thana_id").on('change', function() {

                // })
                // $("#subcategory_id").change(function() {
                if ($(this).val() == "null") {
                    $("#institute_id").empty().append('<option value = "0">All');
                    return;
                }
                // console.log( $(this).val() )
                let URL = "{{ url('ins') }}";
                $.ajax({
                    type: "post",
                    url: URL + '/' + $(this).val(),
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        selectIns(response);
                    }
                });
            });

        });
        $(document).ready(function() {

            var table = $('#dataTable').DataTable();

            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
            table.buttons().container().appendTo($('.tablebtn', table.table().container()));
            $('.tablebtn .dt-buttons').removeClass('flex-wrap');
            $('.tablebtn .btn').removeClass('btn-secondary').addClass('btn-outline-primary');

        });
        $(document).ready(function() {

            var table = $('.dataTable').DataTable();

            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
            table.buttons().container().appendTo($('.tablebtn', table.table().container()));
            $('.tablebtn .dt-buttons').removeClass('flex-wrap');
            $('.tablebtn .btn').removeClass('btn-secondary').addClass('btn-outline-primary');

        });
    </script>
    <script>
        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    </script>
    @yield('script')
</body>

</html>
