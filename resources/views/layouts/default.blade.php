<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

     <link rel="stylesheet" type="text/css" href="{{asset('css/default.css')}}">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

       <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    </head>

    <body>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

        @stack('scripts')
    
    <!-- Navbar goes here -->
    
    @include('includes.nav')
   

    <!-- Page Layout here -->
    <div class="row">

    
        @yield('content')
     
      

    </div>

    

     <script type="text/javascript">
        
        $(document).ready(function () {
          // body...
          $(".mynav").sideNav();

          $('select').material_select();

           $('.modal').modal();

           $('ul.tabs').tabs({
            'swipeable':true
           });

           $('.collapsible').collapsible();

            $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });

        });

       
      </script>

    
    </body>
  </html>