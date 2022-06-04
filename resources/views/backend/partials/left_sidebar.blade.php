<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image"> <img src="/images/faces/face4.jpg" alt="image"/> <span class="online-status online"></span> </div>
              <div class="profile-name">
                <p class="name">Aynul Haque</p>
                <p class="designation">Manager</p>
                <div class="badge badge-teal mx-auto mt-3">Online</div>
              </div>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{route('admin.index')}}"><img class="menu-icon" src="/images/menu_icons/01.png" alt="menu icon"><span class="menu-title">Dashboard</span></a></li>
        {{-- manage product --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="/images/menu_icons/02.png" alt="menu icon"> <span class="menu-title">Product</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.product.index')}}">Manage Products</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.product.create')}}">Add Products</a></li>
              </ul>
            </div>
          </li>
{{-- manage category --}}
         {{--  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages1" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="/images/menu_icons/05.png" alt="menu icon"> <span class="menu-title">Category</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general-pages1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.category.index')}}">Manage Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.category.create')}}">Add category</a></li>
              </ul>
            </div>
          </li> --}}
  {{-- manage Orders --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages2" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="/images/menu_icons/06.png" alt="menu icon"> <span class="menu-title">Orders</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general-pages2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.order.index')}}">Manage Orders</a></li>
              </ul>
            </div>
          </li>

       {{-- manage Division --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages3" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="/images/menu_icons/08.png" alt="menu icon"> <span class="menu-title">Divisions</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general-pages3">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.division.index')}}">Manage Division</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.division.create')}}">Add Division</a></li>
              </ul>
            </div>
          </li>



          {{-- manage district --}}
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages4" aria-expanded="false" aria-controls="general-pages"> <img class="menu-icon" src="/images/menu_icons/09.png" alt="menu icon"> <span class="menu-title">Districts</span><i class="menu-arrow"></i></a>
            <div class="collapse" id="general-pages4">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.district.index')}}">Manage District</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{route('admin.district.create')}}">Add District</a></li>
              </ul>
            </div>
            <li class="nav-item">
             <a class="nav-link">
              <form  class="form-inline" action="#" method="post">
                @csrf
                <input type="submit" name="" value="Logout Now" class="btn btn-danger">
              </form>
             </a>
            </li>
          </li>

        </ul>
      </nav>