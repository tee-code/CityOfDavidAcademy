<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('APP_NAME', 'LaraLearn') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">




    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">




</head>
<body>
    <div id="app">
            @include('inc.navbar')
        <div class = "push-up">
            @include('inc.messages')
            @yield('content')
        </div>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
        <script src="{{ asset('js/ckeditor.js') }}" defer></script>

        <script>
            // Scroll to specific values
// scrollTo is the same
window.scroll({
  top: 2500,
  left: 0,
  behavior: 'smooth'
});

// Scroll certain amounts from current position
window.scrollBy({
  top: 100, // could be negative value
  left: 0,
  behavior: 'smooth'
});

// Scroll to a certain element
document.querySelector('.hello').scrollIntoView({
  behavior: 'smooth'
});
            $('.carousel').carousel({
                interval: 2000
            })
            function MyUploadAdapterPlugin( editor ) {
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = function( loader ) {
                    // ...
                };
                console.log(Array.from( editor.ui.componentFactory.names() ));
            }

            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    extraPlugins: [ MyUploadAdapterPlugin ],

                    // ...
                } )

                .catch( error => {
                    console.error( error );
                } );
        </script>
    </div>
</body>
</html>
