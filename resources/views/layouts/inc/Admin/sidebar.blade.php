<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('admin/category','admin/add-category', 'admin/category/*/edit') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/category','admin/add-category', 'admin/category/*/edit') ? 'show':'' }}" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/add-category') ? 'active':'' }}" href="{{ url('admin/add-category') }}">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/category', 'admin/category/*/edit') ? 'active':'' }}" href="{{ url('admin/category') }}">Categories</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ Request::is('admin/brands') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('admin/brands') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Brands</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('admin/colors') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('admin/colors') }}">
          <i class="mdi mdi-border-color menu-icon"></i>
          <span class="menu-title">Colors</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('admin/products','admin/add-product', 'admin/products/*/edit') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-product">
          <i class="mdi mdi-cart menu-icon"></i>
          <span class="menu-title">Product</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/products','admin/add-product', 'admin/products/*/edit') ? 'show':'' }}" id="ui-product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/add-product') ? 'active':'' }}" href="{{ url('admin/add-product') }}">Add Product</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/products', 'admin/products/*/edit') ? 'active':'' }}" href="{{ url('admin/products') }}">Products</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ Request::is('admin/orders') ? 'active':'' }}">
        <a class="nav-link"href="{{ url('admin/orders') }}">
          <i class="mdi mdi-chart-bar menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('admin/sliders','admin/add-slider', 'admin/slider/*/edit') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-slider" aria-expanded="false" aria-controls="orders">
          <i class="mdi mdi-image-multiple menu-icon"></i>
          <span class="menu-title">Home Slider</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/sliders','admin/add-slider', 'admin/slider/*/edit') ? 'show':'' }}" id="ui-slider">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/add-slider') ? 'active':'' }}" href="{{ url('admin/add-slider') }}">Add Slider</a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/sliders', 'admin/slider/*/edit') ? 'active':'' }}" href="{{ url('admin/sliders') }}">Sliders</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ Request::is('admin/settings') ? 'active':'' }}">
        <a class="nav-link" href="{{ url('admin/settings') }}">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">Settings</span>
        </a>
      </li>

      <li class="nav-item {{ Request::is('admin/users','admin/add-user', 'admin/user/*/edit') ? 'active':'' }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{ Request::is('admin/users','admin/add-user', 'admin/user/*/edit') ? 'show':'' }}" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/add-user') ? 'active':'' }}" href="{{ url('admin/add-user') }}"> Add User </a></li>
            <li class="nav-item"> <a class="nav-link {{ Request::is('admin/users', 'admin/user/*/edit') ? 'active':'' }}" href="{{ url('admin/users') }}"> View User </a></li>
          </ul>
        </div>
      </li>

    </ul>
</nav>