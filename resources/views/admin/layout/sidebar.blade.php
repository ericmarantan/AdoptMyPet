  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
      <img src="{{ url('admin/images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ChiliDogtags</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (!empty(Auth::guard('admin')->user()->image))
            <img src="{{ asset('admin/images/photos/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{ url('admin/images/no-name.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @endif
          
        </div>
        <div class="info">
          {{Auth::guard('admin')->user()->name}}
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

      <div class="form-inline">
        @if(Auth::guard('admin')->check())
            Hello {{Auth::guard('admin')->user()->name}}
        @elseif(Auth::guard('user')->check())
            Hello {{Auth::guard('user')->user()->name}}
        @endif
      </div>




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
            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if (Session::get('page')=="manage-orders" OR Session::get('page')=="manage-invoices")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if (Session::get('page')=="manage-orders")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('admin/manage-orders') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage/View Orders</p>
                </a>
              </li>
            @if (Session::get('page')=="manage-invoices")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('admin/manage-invoices') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoices</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item menu-open">
            @if (Session::get('page')=="register-account" OR Session::get('page')=="manage-account")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Accounts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if (Session::get('page')=="register-account")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('admin/register-account') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register New Account</p>
                </a>
              </li>
            @if (Session::get('page')=="manage-account")
              @php $active = "active" @endphp
            @else
              @php $active = "" @endphp
            @endif
              <li class="nav-item">
                <a href="{{ url('admin/manage-account') }}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Accounts</p>
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
                <a href="{{ url('admin/update-password') }}" class="nav-link {{ $active }}">
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
                <a href="{{ url('admin/update-details') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Details</p>
                </a>
              </li>
              
            </ul>
          </li>
  
          <li class="nav-header">EXAMPLES</li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>