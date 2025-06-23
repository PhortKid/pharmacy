  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
    
      @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('users_management') || Auth::user()->hasPermission('roles_management')  || Auth::user()->hasPermission('permission_management'))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Users & Permission</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('users_management'))
        <li>
            <a href="{{route('users_management.index')}}">
              <i class="bi bi-circle"></i><span>Manage Users</span>
            </a>
          </li>
          @endif
         
          @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('roles_management'))
          <li>
            <a href="/roles">
              <i class="bi bi-circle"></i><span>Roles</span>
            </a>
          </li>
          @endif

          @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('permission_management'))
          <li>
            <a href="/permissions">
              <i class="bi bi-circle"></i><span>Permissions</span>
            </a>
          </li>
          @endif
            
        </ul>
      </li><!-- End Components Nav -->
    @endif
 
     
    @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('product_management') || Auth::user()->hasPermission('product_category') )
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @if(Auth::check() &&  Auth::user()->hasPermission('product_category') )
        <li>
            <a href="{{route('categories.index')}}">
              <i class="bi bi-circle"></i><span>Manage Product Categories</span>
            </a>
          </li>
          @endif

          @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('product_management') )
          <li>
            <a href="{{route('product_management.index')}}">
              <i class="bi bi-circle"></i><span>Manage Product</span>
            </a>
          </li>
          @endif
            
        </ul>
      </li>
      @endif
   
      
   
      @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('purchase_management') )
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
  

 
      @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('sales_management') )
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
    


      @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('product_report') )
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav3" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">

        @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('product_report') )
        <li>
            <a href="/product-report">
              <i class="bi bi-circle"></i><span>Product Report</span>
            </a>
          </li>  
        @endif

        @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('stock_report') )
          <li>
            <a href="/reports_stock">
              <i class="bi bi-circle"></i><span>Stock Report</span>
            </a>
          </li>  
        @endif

        @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('sales_report') )
          <li>
            <a href="/sales-report">
              <i class="bi bi-circle"></i><span>Sales Report</span>
            </a>
          </li>  
          @endif

          @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('low_stock_report') )
          <li>
            <a href="/low-stock-report">
              <i class="bi bi-circle"></i><span>Low stock Alert</span>
            </a>
          </li>  
          @endif
        </ul>
      </li>
      @endif
      
      
      @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('disposal_management') || Auth::user()->hasPermission('expire_product'))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Disposal Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('disposal_management'))
        <li>
            <a href="/disposal">
              <i class="bi bi-circle"></i><span> Disposal</span>
            </a>
          </li>  
          <li>
            @endif 
            @if(Auth::check() &&  Auth::user()->hasPermission('expire_product'))
            <a href="/reports_expiry">
              <i class="bi bi-circle"></i><span> Expired Product</span>
            </a>
          </li> 
          @endif 
        </ul>
      </li>
      @endif


      @if(Auth::check() && Auth::user()->role && Auth::user()->hasPermission('supplier_management') )
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Supplier Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/suppliers">
              <i class="bi bi-circle"></i><span> Supplier Management</span>
            </a>
          </li>  

        </ul>
      </li>
      @endif
      
     

     

      <li class="nav-heading">Others</li>
     
     
      
     

    </ul>

  </aside><!-- End Sidebar-->