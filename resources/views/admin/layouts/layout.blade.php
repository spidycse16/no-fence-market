<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/icons/icon-48x48.png') }}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>@yield('admin_page_title')</title>

    <link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="/admin/dashboard">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">Main</li>
                    <li class="sidebar-item {{ request()->routeIs('adminDashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/dashboard">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Category</li>
                    <li class="sidebar-item {{ request()->routeIs('catagory.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/catagory/create">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('catagory.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/catagory/manage">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Sub-Category</li>
                    <li class="sidebar-item {{ request()->routeIs('subcatagory.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/subcatagory/create">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('subcatagory.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/subcatagory/manage">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Product Attribute</li>
                    <li class="sidebar-item {{ request()->routeIs('productattribute.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/productattribute/create">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('productattribute.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/productattribute/manage">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Product Discount</li>
                    <li class="sidebar-item {{ request()->routeIs('discount.create') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/discount/create">
                            <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('discount.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/discount/manage">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Approve Vendors</li>
                    <li class="sidebar-item {{ request()->routeIs('need.approve') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/approve/show">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Approve Vendor</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Product</li>
                    <li class="sidebar-item {{ request()->routeIs('product.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/product/manage">
                            <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Manage Product</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('product.review.manage') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/product/review/manage">
                            <i class="align-middle" data-feather="star"></i> <span class="align-middle">Manage Product Reviews</span>
                        </a>
                    </li>

                    <li class="sidebar-header">History</li>
                    <li class="sidebar-item {{ request()->routeIs('admin.cart.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/cart/history">
                            <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Cart History</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('admin.order.history') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/order/history">
                            <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Order History</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Settings</li>
                    <li class="sidebar-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/settings">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="{{ asset('img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1" alt="Admin" />
                                <span class="text-dark">{{ auth()->user()->name ?? 'Admin' }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="/admin/profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="/admin/settings"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="align-middle me-1" data-feather="log-out"></i> Log out
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">@yield('admin_page_title', 'Admin Dashboard')</h1>
                    @yield('admin_layout')
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <h5>NoFenceMarket - An open D2C marketplace</h5>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="/support" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="/help-center" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="/privacy" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="/terms" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('admin_asset/js/app.js') }}"></script>
</body>

</html>