<section class="sidebar">
  <div class="logo">
    <a href="{{route('home')}}">
      <img src="{{url('admin/img/cj.png')}}" alt="" />
      <span>CJ Book Store</span>
    </a>
  </div>
  <!-- each option -->
  <a href="{{route('home')}}" class="option {{Route::currentRouteNamed('home') ? 'active' : null }}">
    <i class="fa-solid fa-house"></i>
    <span>Dashboards</span>
  </a>
  <!-- each option -->
  <a href="{{route('customers.create')}}"
    class="option {{Route::currentRouteNamed('customers.create') ? 'active' : null }}">
    <i class="fa-solid fa-user-plus"></i>
    <span>Create Customer</span>
  </a>
  <!-- each option -->
  <a href="{{route('customers.index')}}"
    class="option {{Route::currentRouteNamed('customers.index') ? 'active' : null }}">
    <i class="fa-solid fa-magnifying-glass"></i>
    <span>Search Customer</span>
  </a>
  <!-- each option -->
  <a href="{{route('books.create')}}" class="option {{Route::currentRouteNamed('books.create') ? 'active' : null }}">
    <i class="fa-solid fa-book"></i>
    <span>Create Book</span>
  </a>
  {{-- each option --}}
  <a href="{{route('books.index')}}" class="option {{Route::currentRouteNamed('books.index') ? 'active' : null }}">
    <i class="fa-solid fa-magnifying-glass"></i>
    <span>Search Book</span>
  </a>
  <!-- each option -->
  <a href="{{route('orders.create')}}" class="option {{Route::currentRouteNamed('orders.create') ? 'active' : null }}">
    <i class="fa-solid fa-bookmark"></i>
    <span>Create Order</span>
  </a>
  <!-- each option -->
  <a href="{{route('orders.index')}}" class="option {{Route::currentRouteNamed('orders.index') ? 'active' : null }}">
    <i class="fa-solid fa-magnifying-glass"></i>
    <span>Search Order</span>
  </a>


  <a href="{{route('logout')}}" class="option logout-btn">
    <i class="fa-solid fa-right-from-bracket reverse"></i>
    <span>logout</span>
  </a>

  <form action="{{route('logout')}}" method="POST" class="logout-form">
    @csrf
  </form>

</section>