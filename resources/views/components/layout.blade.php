@props(['active' => '', 'open' => '','link' => ''])

<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('ikn_sneat') }}/assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>ToolsKit</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('ikn_sneat/assets/img/favicon/favicon.ico') }}?v={{ time() }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('ikn_sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('ikn_sneat') }}/assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('ikn_sneat/assets/img/icons/brands/toolkit.png') }}" alt="ToolKit" width="50">
                        </span>
                        <span class="app-brand-text demo menu-text fw-semibold ms-2" style="text-transform: none; font-size: 20px; color: #333;">ToolsKit</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ $active == 'dashboard' ? 'active' : '' }} ">
                        <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $active == 'master' ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Account Settings">Master</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ $open == 'category' ? 'active' : '' }}">
                                <a href="{{route('admin.category.index')}}" class="menu-link">
                                    <div data-i18n="Account">Category</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $open == 'inventory' ? 'active' : '' }}">
                                <a href="{{route('admin.inventory.index')}}" class="menu-link">
                                    <div data-i18n="Notifications">Inventory</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $open == 'tool' ? 'active' : '' }}">
                                <a href="{{ route('admin.tool.index') }}" class="menu-link">
                                    <div data-i18n="Connections">Tools</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item {{ $active == 'request' ? 'active' : '' }}">
                        <a href="{{ route('admin.request.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Analytics">Request</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $active == 'user' ? 'active' : '' }}">
                        <a href="{{ route('admin.user.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Analytics">User</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $active == 'transaction' ? 'active open ' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Account Settings">Transaction</div>
                        </a>
                        <ul class="menu-sub ">
                            <li class="menu-item {{ $open == 'borrowing' ? 'active' : '' }}">
                                <a href="{{ route('admin.borrowing.index') }}" class="menu-link">
                                    <div data-i18n="Account">Borrowing</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $open == 'return' ? 'active ' : '' }}">
                                <a href="{{ route('admin.return.index') }}" class="menu-link">
                                    <div data-i18n="Account">Return</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item {{ $active == 'maintenance' ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div data-i18n="Account Settings">Maintenance Tools</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ $open == 'repair' ? 'active ' : '' }}">
                                <a href="{{ route('admin.repair.index') }}" class="menu-link">
                                    <div data-i18n="Account">Repair</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $open == 'maintenance' ? 'active ' : '' }}">
                                <a href="{{ route('admin.maintenance.index') }}" class="menu-link">
                                    <div data-i18n="Account">Maintenance</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav
                    class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                {{$link}}
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('ikn_sneat') }}/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('ikn_sneat') }}/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="auth-login-basic.html">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-fluid flex-grow-1 container-p-y">
                        {{$slot}}
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-fluid d-flex flex-wrap justify-content-center py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © 2025 -
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                by IKN, template by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('ikn_sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('ikn_sneat') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('ikn_sneat') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('ikn_sneat') }}/assets/js/ui-toasts.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    @stack('script')
</body>

</html>