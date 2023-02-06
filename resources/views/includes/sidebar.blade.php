<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard.index') }}">    <img src="{{ asset('assets/img/logo.jpeg') }}" style="max-width: 70px" alt="logo" /> 
            </a>
        </div>
        {{-- <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.index') }}"><i class="fas fa-user" aria-hidden="true"></i></a>
        </div> --}}
        <ul class="sidebar-menu">
            <li class="menu-header">MAIN MENU</li>
            <li class="{{ setActive('admin') }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ setActive('admin/users') }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="{{ setActive('admin/category'. '*') }}">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="{{ setActive('admin/products'. '*') }}">
                <a class="nav-link" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Products</span>
                </a>
            </li>
            <li class="{{ setActive('admin/transactions') }}">
                <a class="nav-link" href="{{ route('admin.transactions.index') }}">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Transactions</span>
                </a>
            </li>
            
            <li class="{{ setActive('admin/admin' . '*') }}">
                <a class="nav-link" href="{{ route('admin.admin.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Admin</span>
                </a>
            </li>

            <li class="{{ setActive('admin/setting') }}">
                <a class="nav-link" href="{{ route('admin.setting.index') }}">
                    <i class="fas fa-cog"></i>
                    <span>Setting Akun</span>
                </a>
            </li>
         
        </ul>
    </aside>
</div>