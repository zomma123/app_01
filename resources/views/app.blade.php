<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- add login -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title> zomma phiwthammavong </title>


  <link rel="stylesheet" href="{{mix('css/app.css')}}" type="text/css">
  <!-- Fonts -->
  <link rel="stylesheet" href="css/font_lao.css">
 
  <!-- Icons -->
  <link rel="icon" href="assets/img/avatars/22.jpg">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css">
  <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css">
  <link rel="stylesheet" href="assets/css/demo.css">

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css">
  <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css">


</head>

<body>

<!-- login -->
@if(Auth::check())
    @php
    $user_auth_data = [
    'isLogin' => true,
    'user' => Auth::user(),
    ];
    @endphp
    @else
    @php
    $user_auth_data = [
    'isLogin' => false,
    'user' => Auth::user(),
    ];
    @endphp
    @endif

    
  <!-- login  -->
  <script>
        window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
    </script>

  <div id="app-vue"></div>
  
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/libs/hammer/hammer.js"></script>
  <script src="assets/vendor/libs/i18n/i18n.js"></script>
  <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>


  <!-- Page JS -->
  <script src="assets/js/dashboards-analytics.js"></script>
  <script src="{{mix('js/app.js')}}" type="text/javascript"></script>
</body>

</html>