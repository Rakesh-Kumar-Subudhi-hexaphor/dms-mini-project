<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->


    <head>
        <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>DMS</title>


        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Bootstrap  -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/stylesheets/bootstrap.css') }}">

        <!-- Theme Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/stylesheets/style.css') }}">

        <!-- Colors -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/stylesheets/colors/color1.css') }}"
            id="colors">

        <!-- Animation Style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/stylesheets/animate.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

        <link href="#" rel="apple-touch-icon-precomposed" sizes="144x144">
        <link href="#" rel="apple-touch-icon-precomposed" sizes="114x114">
        <link href="#" rel="apple-touch-icon-precomposed" sizes="72x72">
        <link href="#" rel="apple-touch-icon-precomposed">
        <link href="#" rel="shortcut icon">


        {{-- Font Awesome Links --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
            integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>

    <body>


        {{ $slot }}



        <!-- Javascript -->
        <script type="text/javascript" src="{{ asset('frontend/javascript/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/javascript/bootstrap.min.js') }}"></script>




        @if (Session::has('success'))
            <script>
                iziToast.success({
                    position: 'topRight',
                    message: "{{ Session::get('success') }}"
                });
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                iziToast.error({
                    position: 'topRight',
                    message: "{{ Session::get('error') }}"
                });
            </script>
        @endif
        @if ($errors->any())
            <script>
                iziToast.error({
                    position: 'topRight',
                    message: "Validation Error: {{ $errors->first() }}" // Displaying the first error message
                });
            </script>
        @endif
    </body>



</html>
