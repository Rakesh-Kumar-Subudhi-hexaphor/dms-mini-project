<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <h3 class="mb-0" style="color:#00af21; font-weight: 700">DMS</h3>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{route('admin.dashboard')}}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
            </a>

        </li>




        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>







        <li class="menu-item">
            <a href="{{ route('admin.user.user') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Users">Customer</div>
            </a>
        </li>

         <li class="menu-item">
            <a href="{{ route('admin.product') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Product">Product</div>
            </a>
        </li>

         <li class="menu-item">
            <a href="{{ route('admin.stock') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Stock">Stock</div>
            </a>
        </li>

         <li class="menu-item">
            <a href="{{ route('admin.order-list') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate" data-i18n="Order List">Order List</div>
            </a>
        </li>

    </ul>



</aside>
<!-- / Menu -->
