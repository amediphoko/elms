<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ELMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('inc.navbar')
    <div id="app" style="position:relative; top:3.5em">
        <div class="col-md-2" style="margin:0; padding:0">
            @if (Auth::guard('web')->check() or Auth::guard('admin')->check())
                @include('inc.sidebar')
            @endif
        </div>
        @include('inc.messages')
        @yield('content')   
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    <script>
        $('#myTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        }); 
    </script>
    <script>
        jQuery(document).ready(function() {
            var path = window.location.pathname;
            if(path.charAt(path.length-1) == "/") {
                path = path.substring(0, path.length - 1);
            }
            if (path.charAt(0) != "/") {
                path = "/" + path;
            }
            $("#accordion1 a[href*='"+path+"']").addClass("active");
        });

        document.getElementById("pro_img").onchange = function() {
           var reader = new FileReader();

           reader.onload = function(e) {
               $('#output').attr('src', e.target.result);
           };
           reader.readAsDataURL(this.files[0]);
       };

       function datediff() {
           var to = new Date($("#to").val());
           var from = new Date($("#from").val());

           var datediff;

            /**weekends included {Leave Type: Maternity}*/
            if($("#type").val() == 'Maternity')
            {
                var datediff = parseInt((to - from) / (24 * 3600 * 1000));
            }else {
                /**exclude them weekends*/
                if (to < from) return -1;

                var dateFromDayOrig = from.getDay();
                var dateToDayOrig = to.getDay();
                var dateFromDay = (dateFromDayOrig == 0) ? 7 : dateFromDayOrig;
                var dateToDay = (dateToDayOrig == 0) ? 7 : dateToDayOrig;
                dateFromDay = (dateFromDay > 5) ? 5 : dateFromDay;
                dateToDay = (dateToDay > 5) ? 5 : dateToDay;

                var weekDifference = Math.floor((to.getTime() - from.getTime()) / 604800000);

                if(dateFromDay <= dateToDay)
                {
                    datediff = (weekDifference * 5) + (dateToDay - dateFromDay);
                }else {
                    datediff = ((weekDifference + 1) * 5) - (dateFromDay - dateToDay);
                }

                if(dateFromDayOrig >= 6 || dateFromDayOrig == 0)
                {
                    datediff--;
                }
            }                

            $("#days_applied").val(datediff + 1);
       }
        
    </script>
</body>
</html>
