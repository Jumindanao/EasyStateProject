<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
    @yield('title')
    </title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap5.css') }}" rel="stylesheet">

    <!-- Own Carousel -->
    <link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <style>
        a{
            text-decoration: none !important;
        }
        #quantity-input {
        text-align: center;
        width: 30px; /* Adjust the width to your desired size */
        }
    </style>
</head>
<body>
    @include('layouts.navbar.frontnavbar')
    <div class="content">
        @yield('content')
    <!---</div>  
    mao ni messenger
        <div class="messenger-chat">
            <a href="" target="_blank">
                <img src="{{asset('assets/images/messengerlogo.png')}}" alt="messenger-chat" height="50px" width="50px">
            </a>
        </div>-->


    <script src="{{ asset('frontend/js/jquery-3.6.4.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" ></script>
    <script src="{{ asset('frontend/js/custom.js') }}" ></script>
    <script src="{{ asset('frontend/js/checkout.js') }}" ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                s1.async=true;
                s1.src='https://embed.tawk.to/6459fa326a9aad4bc579aa75/1gvvnilk9';
                s1.charset='UTF-8';
                s1.setAttribute('crossorigin','*');
                s0.parentNode.insertBefore(s1,s0);
                })();
</script>
<!--End of Tawk.to Script-->
    <script>
        var availableTags=[];
    $.ajax(
             {
                method:"GET",
                url:"/product-list",
                success:function(response){
                    //console.log(response);
                    startAutocomplete(response);
                },
                error:function(xhr,status,error){
                    console.log(xhr,status,error);
                }
            });
    function startAutocomplete(availableTags)
    {
    $( "#search_bar" ).autocomplete({
      source: availableTags
    });
    }
  </script>

    @if(session('status'))
        <script>
             swal("{{ session('status')}}");
        </script>
    @endif
    @yield('scripts')
</body>
</html>