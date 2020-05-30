<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name', 'LSAPP')}}</title>

        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">

        <!-- Styles -->

    </head>
    <body>

        @include('inc.navbar')
        <div class = "container mb-2">
            @include('inc.messages')
            @yield('content')
        </div>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
        <script src="ckeditor.js"></script>

        <script>
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
    </body>
</html>
