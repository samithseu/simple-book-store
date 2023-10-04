<!-- navbar -->
<nav class="navbar">
  <div class="toggle_title">
    <i class="fa-solid fa-bars"></i>
    <h1 class="title">@yield('option-title')</h1>
  </div>
  <form action="#">
    <input required type="text" name="search" placeholder="Type to search..." id="search"  />
    <button type="submit" class="search-form-btn">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
  </form>
  <a href="{{route('home')}}" class="profile">
    <img draggable="false" src="{{url('admin/img/user.png')}}" alt="" />
    <span class="profile-name">{{Auth::user()->name}}</span>
  </a>
</nav>
<!-- end navbar -->
