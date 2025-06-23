<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="/home">
        <i class="bi bi-house-door"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Users & Permissions -->
    @if(Auth::check() && Auth::user()->role && (Auth::user()->hasPermission('users_management') || Auth::user()->hasPermission('roles_management') || Auth::user()->hasPermission('permission_management')))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person-lock"></i><span>Users & Permission</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @if(Auth::user()->hasPermission('users_management'))
        <li>
          <a href="{{ route('users_management.index') }}">
            <i class="bi bi-person-lines-fill"></i><span>Manage Users</span>
          </a>
        </li>
        @endif

        @if(Auth::user()->hasPermission('roles_management'))
        <li>
          <a href="/roles">
            <i class="bi bi-diagram-3"></i><span>Roles</span>
          </a>
        </li>
        @endif

        @if(Auth::user()->hasPermission('permission_management'))
        <li>
          <a href="/permissions">
            <i class="bi bi-shield-lock"></i><span>Permissions</span>
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif

    <!-- Product Management -->
    @if(Auth::user()->hasPermission('product_management') || Auth::user()->hasPermission('product_category'))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-seam"></i><span>Product Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @if(Auth::user()->hasPermission('product_category'))
        <li>
          <a href="{{ route('categories.index') }}">
            <i class="bi bi-tags"></i><span>Manage Product Categories</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('product_management'))
        <li>
          <a href="{{ route('product_management.index') }}">
            <i class="bi bi-box"></i><span>Manage Product</span>
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif

    <!-- Purchase Management -->
    @if(Auth::user()->hasPermission('purchase_management'))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav90" data-bs-toggle="collapse" href="#">
        <i class="bi bi-bag-plus"></i><span>Purchase Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav90" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('purchases.index') }}">
            <i class="bi bi-cart-check"></i><span>Manage Purchase</span>
          </a>
        </li>
      </ul>
    </li>
    @endif

    <!-- Sales Management -->
    @if(Auth::user()->hasPermission('sales_management'))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
        <i class="bi bi-currency-dollar"></i><span>Sales Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('sales.index') }}">
            <i class="bi bi-receipt"></i><span>Manage Sales</span>
          </a>
        </li>
      </ul>
    </li>
    @endif

    <!-- Reports -->
    @if(Auth::user()->hasPermission('product_report'))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
        <i class="bi bi-graph-up"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav3" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @if(Auth::user()->hasPermission('product_report'))
        <li>
          <a href="/product-report">
            <i class="bi bi-clipboard-data"></i><span>Product Report</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('stock_report'))
        <li>
          <a href="/reports_stock">
            <i class="bi bi-boxes"></i><span>Stock Report</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('sales_report'))
        <li>
          <a href="/sales-report">
            <i class="bi bi-cash-coin"></i><span>Sales Report</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('low_stock_report'))
        <li>
          <a href="/low-stock-report">
            <i class="bi bi-exclamation-circle"></i><span>Low Stock Alert</span>
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif

    <!-- Disposal -->
    @if(Auth::user()->hasPermission('disposal_management') || Auth::user()->hasPermission('expire_product'))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
        <i class="bi bi-trash"></i><span>Disposal Product</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav4" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @if(Auth::user()->hasPermission('disposal_management'))
        <li>
          <a href="/disposal">
            <i class="bi bi-x-octagon"></i><span>Disposal</span>
          </a>
        </li>
        @endif
        @if(Auth::user()->hasPermission('expire_product'))
        <li>
          <a href="/reports_expiry">
            <i class="bi bi-calendar-x"></i><span>Expired Product</span>
          </a>
        </li>
        @endif
      </ul>
    </li>
    @endif

    <!-- Supplier Management -->
    @if(Auth::user()->hasPermission('supplier_management'))
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
        <i class="bi bi-truck"></i><span>Supplier Management</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav5" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="/suppliers">
            <i class="bi bi-person-badge"></i><span>Supplier Management</span>
          </a>
        </li>
      </ul>
    </li>
    @endif



  </ul>
</aside>
