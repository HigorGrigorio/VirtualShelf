<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{$title}}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Import all css files on folder-->
    @foreach (glob(public_path('css/*.css')) as $file)
        <link rel="stylesheet" href="{{ asset('css/' . basename($file)) }}">
    @endforeach

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
        rel="stylesheet"
    />

</head>
<body>

@auth
    <x-side-nav :tables="$tables??[]" :table="$table??''" :user="Auth::user()"/>

    <main id="main-content" class="p-2 pb-0 inactive h-100">
        <div class="h-100">
            <x-nav-bar :user="Auth::user()"/>
            <section class="container-fluid content-wrapper mt-2 primary-shadow rounded-3 h-100">
                @yield('content')
            </section>
        </div>
    </main>
@else
    @yield('content')
@endauth

@extends('components.alert')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>

<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
></script>

<script>
    $(document).ready(function () {
        setTimeout(async function () {
            // get quantity of alerts
            let alertContainer = $('#alert-container');
            let alertCount = alertContainer.children().length;

            while (alertCount > 0) {
                // await 3 seconds
                await new Promise(r => setTimeout(r, 3000));
                // get the last alert
                let alert = alertContainer.children().last();
                // remove the alert
                alert.remove();
                // decrease the alert count
                alertCount--;
            }
        }, 0);
    });
</script>

@stack('scripts')

<script>
    $(document).ready(function () {
        $('#input-file').on('change', function () {
            //get the file name
            let fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.file-label').html(fileName);
            let reader = new FileReader();
            reader.onload = (e) => {
                console.log(e.target.result);
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        })

        $('#remove').on('click', function () {
            $('#avatar').attr('src', '{{asset('images/default-photo.jpg')}}');
            $('#input-file').val('');
            $(this).next('.file-label').html('Select a user profile image');
        })
    })
</script>


</body>
</html>
