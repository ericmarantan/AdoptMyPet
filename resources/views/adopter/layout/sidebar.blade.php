  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('adopter/dashboard') }}" class="brand-link">
      <img src="{{ url('admin/images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ChiliDogtags</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
          
        </div>
        <div class="info">
          Hello, {{Auth::guard('adopter')->user()->name}}
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if (Session::get('page')=="dashboard")
            @php $active = "active" @endphp
          @else
            @php $active = "" @endphp
          @endif
          <li class="nav-item">
            <a href="{{ url('adopter/dashboard') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if (Session::get('page')=="order-new-tag" OR Session::get('page')=="manage-orders")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if (Session::get('page')=="order-new-tag")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('adopter/order-new-tag') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order New ID Tag</p>
                </a>
              </li>
            @if (Session::get('page')=="manage-orders")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('adopter/manage-orders') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Orders</p>
                </a>
              </li>
              
            </ul>
          </li>

          


          <li class="nav-item menu-open">
            @if (Session::get('page')=="update-password" OR Session::get('page')=="update-details")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if (Session::get('page')=="update-password")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('adopter/update-password') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
              @if (Session::get('page')=="update-details")
                @php $active = "active" @endphp
              @else
                @php $active = "" @endphp
              @endif
              <li class="nav-item">
                <a href="{{ url('adopter/update-details') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Details</p>
                </a>
              </li>
              
            </ul>
          </li>
  
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>