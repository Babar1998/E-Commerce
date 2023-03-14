<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <style>
        a{
            text-decoration: none !important;
        }
        *{
    font-family: 'Roboto', sans-serif;
}
.checkout-form label{
    font-size: 12px;
    font-weight: 700;
}
.checkout-form input{
    font-size: 14px;
    padding: 5px;
    font-weight: 400;
}
.order-detail label{
    font-size: 40px;
    font-weight: 700;
}
.order-detail div{
    font-size: 40px;
    padding: 5px !important;
}
    </style>
    
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- owl carousel --}}
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{-- font awesome --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    

</head>
<body>
        @include('layouts.incl.frontnavbar')
            <div class="content">
                @yield('content')
            </div>
            
            <div class="whatsapp-chat">
                <a href="https://wa.me/+923316460611?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
                    <img src="{{ asset('assets/images/whatsapp-icon.png')}}" alt="whatsapp-logo" width="80px" height="80px">
                </a>
            </div>

     <!-- Scripts -->

     <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" ></script>
    <script src="{{ asset('js/custom.js') }}" ></script>
    <script src="{{ asset('js/checkout.js') }}" ></script>

            <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/628c9fad7b967b117990eebf/1g3qkvfmh';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
       
        var availableTags = [ ];
        $.ajax({
            method: "GET",
            url: "/product-list",
            success: function(response){
                // console.log(response);
                startAutoComplete(response);
            }
        });

        function startAutoComplete(availableTags)
        {
            $( "#search_product" ).autocomplete({
            source: availableTags
            });
        }

        </script>
   
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('status'))
    <script>
        swal("{{ session('status') }}");
    </script>
    @endif
    @yield('scripts')

</body>
</html>
