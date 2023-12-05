<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
      <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('backend/template/assets/images/logo.svg') }}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="index.html"><img src="{{ asset('backend/template/assets/images/logo-mini.svg') }}" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{ asset('backend/template/assets/images/faces/face1.jpg') }}" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column pr-3">
            <span class="font-weight-medium mb-2">Henry Klein</span>
            <span class="font-weight-normal">$8,753.00</span>
          </div>
          <span class="badge badge-danger text-white ml-3 rounded">3</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('order.index') }}">
          <i class="mdi mdi-monitor menu-icon"></i>
          <span class="menu-title">Order</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('order_item.index') }}">
          <i class="mdi mdi-monitor-multiple menu-icon"></i>
          <span class="menu-title">Order Item</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('store.index') }}">
          <i class="mdi mdi-home-variant menu-icon"></i>
          <span class="menu-title">Store</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-library-books menu-icon"></i>
          <span class="menu-title">Item</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('category.index') }}">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('brand.index') }}">Brand</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('product.index') }}">Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('stock.index') }}">Stock</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.index') }}">
          <i class="mdi mdi-account-multiple menu-icon"></i>
          <span class="menu-title">Customer</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('staff.index') }}">
          <i class="mdi mdi-account-switch menu-icon"></i>
          <span class="menu-title">Staff</span>
        </a>
      </li>
      <li class="nav-item sidebar-actions">
        <div class="nav-link">
          <div class="mt-4">
            <div class="border-none">
              <p class="text-black">Sign Out</p>
            </div>
            <ul class="mt-4 pl-0">
              <li>Sign Out</li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </nav>