  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name ?? ''}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
             
              <p>
                Menus
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{request()->is('dashboard*') ? 'active' : ''}}">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link {{request()->is('user*') ? 'active' : ''}}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link {{request()->is('products*') ? 'active' : ''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
     
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link {{request()->is('categories*') ? 'active' : ''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('brands.index')}}" class="nav-link {{request()->is('brands*') ? 'active' : ''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Brands</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('sizes.index')}}" class="nav-link {{request()->is('sizes*') ? 'active' : ''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Sizes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('stock')}}" class="nav-link {{request()->is('stocks') ? 'active' : ''}}">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Stocks</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('stockHistory')}}" class="nav-link {{request()->is('stocks/history') ? 'active' : ''}}">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>Stocks History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('returnProduct')}}" class="nav-link  {{request()->is('return_products') ? 'active' : ''}}">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Return Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('returnProductHistory')}}" class="nav-link  {{request()->is('return_products/history') ? 'active' : ''}}">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>Product Return History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.logout')}}" class="nav-link ">
                  <i class="fas fa-sign-out-alt  nav-icon"></i>
                  <p>Logout</p>
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