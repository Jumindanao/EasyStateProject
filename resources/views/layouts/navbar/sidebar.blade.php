<div class="sidebar" data-color="orange" data-background-color="white" data-image="/assets/imgbg/wewlogo.png">
    <div class="logo"><a href="#" class="simple-text logo-normal">
            EasyState Admin
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('categories') }}">
                    <i class="material-icons">category</i>
                    <p>Categories</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-category') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-category') }}">
                    <i class="material-icons">shop 2</i>
                    <p>ADD Category</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('products') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('products') }}">
                    <i class="material-icons">inventory</i>
                    <p>Properties</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-products') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-products') }}">
                    <i class="material-icons">add_shopping_cart</i>
                    <p>Add Properties</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('orders') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('orders') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Transactions</p>
                </a>
            </li>
            @if (Auth::user()->role_as == '1')
                <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('users') }}">
                        <i class="material-icons">person</i>
                        <p>Users</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
