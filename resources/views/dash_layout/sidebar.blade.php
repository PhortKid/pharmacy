  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
     @if(Auth::user()->role=='owner')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('users_management.index')}}">
              <i class="bi bi-circle"></i><span>Manage Users</span>
            </a>
          </li>
            
        </ul>
      </li><!-- End Components Nav -->
     @endif
 
     @if(Auth::user()->role=='owner' || Auth::user()->role=='procurer')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('categories.index')}}">
              <i class="bi bi-circle"></i><span>Manage Product Categories</span>
            </a>
          </li>

          <li>
            <a href="{{route('product_management.index')}}">
              <i class="bi bi-circle"></i><span>Manage Product</span>
            </a>
          </li>
            
        </ul>
      </li>
   @endif
      
   @if(Auth::user()->role=='owner' || Auth::user()->role=='procurer')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav90" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Purchase Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav90" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('purchases.index')}}">
              <i class="bi bi-circle"></i><span>Manage Purchase</span>
            </a>
          </li>  
            

        </ul>
      </li>
  @endif

  @if(Auth::user()->role=='owner' || Auth::user()->role=='procurer')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Sales Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('sales.index')}}">
              <i class="bi bi-circle"></i><span>Manage Sales</span>
            </a>
          </li>   

        </ul>
      </li>
    @endif


    @if(Auth::user()->role=='owner' || Auth::user()->role=='procurer')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/product-report">
              <i class="bi bi-circle"></i><span>Product Report</span>
            </a>
          </li>  

          <li>
            <a href="/reports_stock">
              <i class="bi bi-circle"></i><span>Stock Report</span>
            </a>
          </li>  

          <li>
            <a href="/sales-report">
              <i class="bi bi-circle"></i><span>Sales Report</span>
            </a>
          </li>  

          <li>
            <a href="/low-stock-report">
              <i class="bi bi-circle"></i><span>Low stock Alert</span>
            </a>
          </li>  
        </ul>
      </li>
      @endif
      
      {{--
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Expiry & Waste Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/waste">
              <i class="bi bi-circle"></i><span> Waste Management</span>
            </a>
          </li>  
          <li>
            <a href="/reports_expiry">
              <i class="bi bi-circle"></i><span> Expiry</span>
            </a>
          </li>  
        </ul>
      </li>--}}

{{--
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Supplier & Purchase Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/suppliers">
              <i class="bi bi-circle"></i><span> Supplier Management</span>
            </a>
          </li>  
          <li>
            <a href="/payments">
              <i class="bi bi-circle"></i><span> Supplier Payment</span>
            </a>
          </li>  

          <li>
            <a href="/purchases">
              <i class="bi bi-circle"></i><span> Purchase</span>
            </a>
          </li>  
        </ul>
      </li>
      
      --}}

     

      <li class="nav-heading">Others</li>
     
      <li class="nav-item">
        <a class="nav-link collapsed" href="/suppliers">
          <i class="bi bi-person"></i>
          <span>Suppliers</span>
        </a>
      </li><!-- End Profile Page Nav -->
      
     

    </ul>

  </aside><!-- End Sidebar-->