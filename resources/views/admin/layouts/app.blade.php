<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CJ Book Store | @yield('title')</title>
  <link rel="stylesheet" href="{{url('admin/css/style.css')}}" />
  <link rel="shortcut icon" href="{{url('admin/img/cj.png')}}" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <div class="wrapper">
    <!-- main background image -->
    <div class="main-bg">
      <img draggable="false" src="{{url('admin/img/bg3.jpg')}}" alt="Main Background" />
    </div>
    <!-- end -->

    <!-- DASHBOARD -->
    <section class="dashboard">
      {{-- sidebar --}}
      @include('admin.layouts.sidebar')

      {{-- content --}}
      <section class="content">
        @include('admin.layouts.nav')
        @yield('content')
      </section>

    </section>
  </div>
  <script src="{{url('admin/js/script.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('js')
</body>

</html>