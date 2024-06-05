<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>IPPU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="IPPU Membership APP for CPDs, Events, CRM and Invoicing" name="description" />
    <meta content="Angus Technologies" name="author" />
    <!-- App favicon -->
     <link rel="shortcut icon" href="https://ippu.or.ug/wp-content/uploads/2020/03/cropped-Logo-32x32.png" sizes="32x32"/>
    <link rel="icon" href="https://ippu.or.ug/wp-content/uploads/2020/03/cropped-Logo-192x192.png" sizes="192x192"/>
    <link rel="apple-touch-icon" href="https://ippu.or.ug/wp-content/uploads/2020/03/cropped-Logo-180x180.png"/>
    <meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Layout config Js -->
    <script src="<?php echo e(asset('assets/js/layout.js')); ?>"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo e(asset('assets/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/libs/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/datatables/1.11.5/css/dataTables.bootstrap5.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@simonwep/pickr/themes/classic.min.css')); ?>" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@simonwep/pickr/themes/monolith.min.css')); ?>" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/@simonwep/pickr/themes/nano.min.css')); ?>" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/datatables/responsive/2.2.9/css/responsive.bootstrap.min.css')); ?>" />
    
    <link href="<?php echo e(asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/datatables/buttons/2.2.2/css/buttons.dataTables.min.css')); ?>">

    <?php echo $__env->yieldContent('customcss'); ?>

    <style>
        .navbar-menu .navbar-nav .nav-link{
            font-family: poppins,sans-serif;
        }

        .colorinput {
            margin: 0;
            position: relative;
            cursor: pointer;
        }

        .colorinput-input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .action-btn{
            width: 29px;
            height: 28px;
            border-radius: 9.3552px;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .colorinput-color {
            background-color: #fdfdff;
            border-color: #e4e6fc;
            border-width: 1px;
            border-style: solid;
            display: inline-block;
            width: 1.75rem;
            height: 1.75rem;
            border-radius: 3px;
            color: #fff;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .colorinput-color:before {
            content: '';
            opacity: 0;
            position: absolute;
            top: .25rem;
            left: .25rem;
            height: 1.25rem;
            width: 1.25rem;
            transition: .3s opacity;
            background: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E") no-repeat center center/50% 50%;
        }

        .colorinput-input:checked~.colorinput-color:before {
            opacity: 1;
        }

        .image{
            width: 100%;
              height: 300px;
              object-fit:contain
        }
    </style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo e(asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo e(asset('assets/images/logo-light.png')); ?>" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                        
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span class="position-absolute topbar-badge unread_notifications fs-10 translate-middle badge rounded-pill bg-danger">0<span class="visually-hidden">unread messages</span></span>
                    </button>
                   <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"> <span class="unread_notifications"></span> New</span>
                                    </div>
                                </div>
                            </div>

                            

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2 show_notifications">
                                    

                                    <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="<?php echo e(asset('assets/images/users/avatar-3.jpg')); ?>" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                                    <label class="form-check-label" for="messages-notification-check01"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="<?php echo e(asset('assets/images/users/avatar-2.jpg')); ?>" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check02">
                                                    <label class="form-check-label" for="messages-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="<?php echo e(asset('assets/images/users/avatar-6.jpg')); ?>" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
                                                    </p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check03">
                                                    <label class="form-check-label" for="messages-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="<?php echo e(asset('assets/images/users/avatar-8.jpg')); ?>" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="messages-notification-check04">
                                                    <label class="form-check-label" for="messages-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-3 text-center view-all">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center">
                                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?php echo e(asset('storage/profiles/'.Auth::user()->profile_pic)); ?>" onerror="this.onerror=null;this.src='<?php echo e(asset('assets/images/users/user-dummy-img.jpg')); ?>';" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(ucwords(\Auth::user()->name)); ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?php echo e(\Auth::user()?->account_type?->name); ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo e(ucwords(\Auth::user()->name)); ?>!</h6>
                        <a class="dropdown-item" href="<?php echo e(url('profile')); ?>"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        
                        <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lifetime Points : <b><?php echo e(\Auth::user()->points); ?></b></span></a>
                       
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(url('dashboard')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(url('dashboard')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('assets/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © IPPU.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Designed & Developed by IPPU
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

<!-- Theme Settings -->
<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvasxxxx">
    <div class="d-flex align-items-center bg-primary bg-gradient p-3 offcanvas-header">
        <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="p-4">
                <h6 class="mb-0 fw-semibold text-uppercase">Layout</h6>
                <p class="text-muted">Choose your layout</p>

                <div class="row gy-3">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input">
                            <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout01">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Vertical</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input">
                            <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout02">
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-soft-primary rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-soft-primary ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-soft-primary"></span>
                                    </span>
                                    <span class="bg-light d-block p-1"></span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Horizontal</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout03" name="data-layout" type="radio" value="twocolumn" class="form-check-input">
                            <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout03">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1">
                                            <span class="d-block p-1 bg-soft-primary mb-2"></span>
                                            <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                        </span>
                                    </span>
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Two Column</h5>
                    </div>
                    <!-- end col -->

                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input id="customizer-layout04" name="data-layout" type="radio" value="semibox" class="form-check-input">
                            <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout04">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0 p-1">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column pt-1 pe-2">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Semi Box</h5>
                    </div>
                    <!-- end col -->
                </div>

                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Color Scheme</h6>
                <p class="text-muted">Choose Light or Dark Scheme.</p>

                <div class="colorscheme-cardradio">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-light" value="light">
                                <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-light">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Light</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check card-radio dark">
                                <input class="form-check-input" type="radio" name="data-layout-mode" id="layout-mode-dark" value="dark">
                                <label class="form-check-label p-0 avatar-md w-100 bg-dark" for="layout-mode-dark">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-soft-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-soft-light d-block p-1"></span>
                                                <span class="bg-soft-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Dark</h5>
                        </div>
                    </div>
                </div>

                <div id="sidebar-visibility">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Visibility</h6>
                    <p class="text-muted">Choose show or Hidden sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-visibility" id="sidebar-visibility-show" value="show">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-visibility-show">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0 p-1">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column pt-1 pe-2">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Show</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-visibility" id="sidebar-visibility-hidden" value="hidden">
                                <label class="form-check-label p-0 avatar-md w-100 px-2" for="sidebar-visibility-hidden">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column pt-1 px-2">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Hidden</h5>
                        </div>
                    </div>
                </div>

                <div id="layout-width">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Width</h6>
                    <p class="text-muted">Choose Fluid or Boxed layout.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-fluid" value="fluid">
                                <label class="form-check-label p-0 avatar-md w-100" for="layout-width-fluid">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Fluid</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-width" id="layout-width-boxed" value="boxed">
                                <label class="form-check-label p-0 avatar-md w-100 px-2" for="layout-width-boxed">
                                    <span class="d-flex gap-1 h-100 border-start border-end">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Boxed</h5>
                        </div>
                    </div>
                </div>

                <div id="layout-position">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Position</h6>
                    <p class="text-muted">Choose Fixed or Scrollable Layout Position.</p>

                    <div class="btn-group radio" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                        <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>
                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Topbar Color</h6>
                <p class="text-muted">Choose Light or Dark Topbar Color.</p>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-light" value="light">
                            <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Light</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check card-radio">
                            <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark" value="dark">
                            <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-primary d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Dark</h5>
                    </div>
                </div>

                <div id="sidebar-size">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Size</h6>
                    <p class="text-muted">Choose a size of Sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-default" value="lg">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-default">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Default</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-compact" value="md">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-compact">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Compact</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small" value="sm">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-small">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1">
                                                <span class="d-block p-1 bg-soft-primary mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Small (Icon View)</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar-size" id="sidebar-size-small-hover" value="sm-hover">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-small-hover">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1">
                                                <span class="d-block p-1 bg-soft-primary mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Small Hover View</h5>
                        </div>
                    </div>
                </div>

                <div id="sidebar-view">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar View</h6>
                    <p class="text-muted">Choose Default or Detached Sidebar view.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-default" value="default">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-view-default">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Default</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-layout-style" id="sidebar-view-detached" value="detached">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-view-detached">
                                    <span class="d-flex h-100 flex-column">
                                        <span class="bg-light d-flex p-1 gap-1 align-items-center px-2">
                                            <span class="d-block p-1 bg-soft-primary rounded me-1"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-soft-primary ms-auto"></span>
                                            <span class="d-block p-1 pb-0 px-2 bg-soft-primary"></span>
                                        </span>
                                        <span class="d-flex gap-1 h-100 p-1 px-2">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                        </span>
                                        <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Detached</h5>
                        </div>
                    </div>
                </div>
                <div id="sidebar-color">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Color</h6>
                    <p class="text-muted">Choose a color of Sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-light" value="light">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-light">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Light</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient.show">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-dark" value="dark">
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-dark">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-primary d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Dark</h5>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-link avatar-md w-100 p-0 overflow-hidden border collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient" aria-expanded="false" aria-controls="collapseBgGradient">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-soft-light rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-soft-light"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </button>
                            <h5 class="fs-13 text-center mt-2">Gradient</h5>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="collapse" id="collapseBgGradient">
                        <div class="d-flex gap-2 flex-wrap img-switch p-2 px-3 bg-light rounded">

                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient" value="gradient">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-2" value="gradient-2">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-2">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-2"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-3" value="gradient-3">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-3">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-3"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-sidebar" id="sidebar-color-gradient-4" value="gradient-4">
                                <label class="form-check-label p-0 avatar-xs rounded-circle" for="sidebar-color-gradient-4">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-4"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sidebar-img">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Images</h6>
                    <p class="text-muted">Choose a image of Sidebar.</p>

                    <div class="d-flex gap-2 flex-wrap img-switch">
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-none" value="none">
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-none">
                                <span class="avatar-md w-auto bg-light d-flex align-items-center justify-content-center">
                                    <i class="ri-close-fill fs-20"></i>
                                </span>
                            </label>
                        </div>

                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-01" value="img-1">
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-01">
                                <img src="<?php echo e(asset('assets/images/sidebar/img-1.jpg')); ?>" alt="" class="avatar-md w-auto object-cover">
                            </label>
                        </div>  

                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-02" value="img-2">
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-02">
                                <img src="<?php echo e(asset('assets/images/sidebar/img-2.jpg')); ?>" alt="" class="avatar-md w-auto object-cover">
                            </label>
                        </div>
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-03" value="img-3">
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-03">
                                <img src="<?php echo e(asset('assets/images/sidebar/img-3.jpg')); ?>" alt="" class="avatar-md w-auto object-cover">
                            </label>
                        </div>
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-04" value="img-4">
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimg-04">
                                <img src="<?php echo e(asset('assets/images/sidebar/img-4.jpg')); ?>" alt="" class="avatar-md w-auto object-cover">
                            </label>
                        </div>
                    </div>
                </div>

                <div id="preloader-menu">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Preloader</h6>
                    <p class="text-muted">Choose a preloader.</p>
                    
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-custom" value="enable">
                                <label class="form-check-label p-0 avatar-md w-100" for="preloader-view-custom">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <!-- <div id="preloader"> -->
                                        <div id="status" class="d-flex align-items-center justify-content-center">
                                            <div class="spinner-border text-primary avatar-xxs m-auto" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Enable</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-preloader" id="preloader-view-none" value="disable">
                                    <label class="form-check-label p-0 avatar-md w-100" for="preloader-view-none">
                                        <span class="d-flex gap-1 h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                    <span class="d-block p-1 px-2 bg-soft-primary rounded mb-2"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                    <span class="d-block p-1 px-2 pb-0 bg-soft-primary"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="fs-13 text-center mt-2">Disable</h5>
                            </div>
                        </div>

                    </div>
                    <!-- end preloader-menu -->

                </div>
            </div>

        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="https://1.envato.market/velzon-admin" target="_blank" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-general" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="modal-general-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form method="POST" id="modal-general-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div id="modal-general-headers"></div>
                    <div class="modal-body">
                        <div  id="modal-general-content"></div>
                    </div>
                    <div class="modal-footer d-flex flex-row align-items-center justify-content-between">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modal-general-positive">Create</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div>
    </div>
    <div class="modal fade zoomIn" id="commonModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="body">
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="<?php echo e(asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/simplebar/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/node-waves/waves.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/feather-icons/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'/>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/libs/choices/choices.min.js')); ?>"></script>
<script type='text/javascript' src='<?php echo e(asset('assets/libs/flatpickr/flatpickr.min.js')); ?>'/>
<!-- App js -->


<script src="<?php echo e(asset('assets/js/jquery.repeater.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/libs/select2/js/select2.min.js')); ?>"></script>

<!-- dropzone js -->
<script src="<?php echo e(asset('assets/libs/dropzone/dropzone-min.js')); ?>"></script>


<script src="<?php echo e(asset('assets/libs/datatables/1.11.5/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/datatables/1.11.5/js/dataTables.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/datatables/responsive/2.2.9/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/datatables/buttons/2.2.2/js/dataTables.buttons.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/pages/datatables.init.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/pages/form-validation.init.js')); ?>"></script>

<script src="<?php echo e(asset('assets/libs/@simonwep/pickr/pickr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/pages/form-pickers.init.js')); ?>"></script>

<script src="<?php echo e(asset('assets/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>

    <script type="text/javascript">
               ClassicEditor
        .create( document.querySelector( '.ckeditor' ), {
            ckfinder: {
                uploadUrl: '<?php echo e(route('ckeditor.upload').'?_token='.csrf_token()); ?>',
            }
        } )
        .catch( error => {
            console.error( error );
        } );
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            getReminders();

            $(".btn-delete").click(function(){
                var form = $(this).attr("delete-item-form");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonClass: "btn btn-danger w-xs mt-2",
                    cancelButtonClass: "btn btn-primary w-xs mt-2 me-2",
                    confirmButtonText: "Yes, delete it!",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                    reverseButtons: true
                }).then(function(t) {
                    if (t.isConfirmed) {
                        $("#"+form).submit()
                    }
                })
            })

            $(document).on('click', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]', function () {

                var data = {};
                var title1 = $(this).data("title");

                var title2 = $(this).data("bs-original-title");
                var title3 = $(this).data("original-title");
                var title = (title1 != undefined) ? title1 : title2;
                var title=(title != undefined) ? title : title3;

                $('.modal-dialog').removeClass('modal-xl');
                var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');

                var url = $(this).data('url');
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);

                if ($('#vc_name_hidden').length > 0) {
                    data['vc_name'] = $('#vc_name_hidden').val();
                }
                if ($('#warehouse_name_hidden').length > 0) {
                    data['warehouse_name'] = $('#warehouse_name_hidden').val();
                }
                if ($('#discount_hidden').length > 0) {
                    data['discount'] = $('#discount_hidden').val();
                }
                $.ajax({
                    url: url,
                    data: data,
                    success: function (data) {
                        $('#commonModal .body').html(data);
                        $("#commonModal").modal('show');
            // daterange_set();
                        taskCheckbox();
                        common_bind("#commonModal");
                        commonLoader();

                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_toastr('Error', data.error, 'error')
                    }
                });

            });

            $("[ajax-load=true]").click(function(){
                var url = $(this).attr("data-url"),action=$(this).attr("data-action"),title=$(this).attr("data-title");
                $('#modal-general').modal().show();
                var modal = new bootstrap.Modal(document.getElementById('modal-general'), {
                  keyboard: false
              });

                $("#modal-general-title").text(title)

                if(action == "New"){
                    form_action = url;
                    data_url = url+"/create";
                    $("#modal-general-headers").html("");
                }else{
                    form_action = url+"/"+$(this).attr("data-id");
                    data_url = url+"/"+$(this).attr("data-id")+"/edit";
                    $("#modal-general-headers").html("<input type='hidden' name='_method' value='PUT'>");
                }

                $("#modal-general-form").attr("action",form_action);

                $("#modal-general-positive").text((action == "New") ? "Create" : "Update");

                modal.show();
                load_data(data_url);
            });

            $(".select2").select2();

            $(".dataTable").DataTable();
            $(".datatable").DataTable();

            $('.number_format').on('keyup',function(){

                var selection = window.getSelection().toString();
                if ( selection !== '' ) {
                    return;
                }

                if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                    return;
                }


                var $this = $(this);

                    // Get the value.
                var input = $this.val();

                var input = input.replace(/[\D\s\._\-]+/g, "");
                input = input ? parseInt( input, 10 ) : 0;

                $this.val( function() {
                    return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                });
            });
        })
        <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toast("<?php echo e($error); ?>","bg-danger")
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(session('success')): ?>
        toast("<?php echo e(session('success')); ?>","bg-success")
        <?php endif; ?>

        <?php if(session('warning')): ?>
        toast("<?php echo e(session('warning')); ?>","bg-warning")
        <?php endif; ?>

        <?php if(session('error')): ?>
        toast("<?php echo e(session('error')); ?>","bg-danger")
        <?php endif; ?>

        function toast(message,bg){
            Toastify({

                text: message,

                duration: 7000,
                close: true,
                className: bg,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true,

                }).showToast();
        }

        function reload_data(){
            load_data(data_url);
        }

        function load_data(data_url){
            $.ajax({
                url: data_url,
                type: "GET",
                aSync: false,
                dataType: "html",

                beforeSend:function(){
                    $("#modal-general-content").html('<div class="text-center text-muted"><i>Loading ...</i></div>')
                },

                success: function(data){
                    $("#modal-general-content").html(data)
                },

                error: function(xhr){
                    $("#modal-general-content").html('<div class="alert bg-danger text-center">Unable to load data. <a href="javascript:void(0);" class="text-bold-700 text-white" onclick="reload_data()"><i>Retry Again</i></a></div>')
                }
            })
        }

        function commonLoader() {
            $('[data-toggle="tooltip"]').tooltip();
            if ($('[data-toggle="tags"]').length > 0) {
                $('[data-toggle="tags"]').tagsinput({tagClass: "badge badge-primary"});
            }


    // $(function(){
    //
    //     var dtToday = new Date();
    //
    //     var month = dtToday.getMonth() + 1;
    //     var day = dtToday.getDate();
    //     var year = dtToday.getFullYear();
    //     if(month < 10)
    //         month = '0' + month.toString();
    //     if(day < 10)
    //         day = '0' + day.toString();
    //
    //     var maxDate = year + '-' + month + '-' + day;
    //
    //     $("input[type='date']").attr('max', maxDate);
    // });

            var e = $(".scrollbar-inner");
            e.length && e.scrollbar().scrollLock()

            var e1 = $(".custom-input-file");
            e1.length && e1.each(function () {
                var e1 = $(this);
                e1.on("change", function (t) {
                    !function (e, t, a) {
                        var n, o = e.next("label"), i = o.html();
                        t && t.files.length > 1 ? n = (t.getAttribute("data-multiple-caption") || "").replace("{count}", t.files.length) : a.target.value && (n = a.target.value.split("\\").pop()), n ? o.find("span").html(n) : o.html(i)
                    }(e1, this, t)
                }), e1.on("focus", function () {
                    !function (e) {
                        e.addClass("has-focus")
                    }(e1)
                }).on("blur", function () {
                    !function (e) {
                        e.removeClass("has-focus")
                    }(e1)
                })
            })

    // var e2 = $('[data-toggle="autosize"]');
    // e2.length && autosize(e2);


            if ($(".jscolor").length) {
                jscolor.installByClassName("jscolor");
            }
            summernote();
    // for Choose file
            $(document).on('change', 'input[type=file]', function () {
                var fileclass = $(this).attr('data-filename');
                var finalname = $(this).val().split('\\').pop();
                $('.' + fileclass).html(finalname);
            });
        }


        function summernote() {
            if ($(".summernote-simple").length) {
                $('.summernote-simple').summernote({
                    dialogsInBody: !0,
                    minHeight: 200,
                    maxHeight: 300,
                    toolbar: [
                        ['style', ['style']],
                        ["font", ["bold", "italic", "underline", "clear", "strikethrough"]],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ["para", ["ul", "ol", "paragraph"]],
                        ],

                });
            }


        }
        function taskCheckbox() {
            var checked = 0;
            var count = 0;
            var percentage = 0;

            count = $("#check-list input[type=checkbox]").length;
            checked = $("#check-list input[type=checkbox]:checked").length;
            percentage = parseInt(((checked / count) * 100), 10);
            if (isNaN(percentage)) {
                percentage = 0;
            }
            $(".custom-label").text(percentage + "%");
            $('#taskProgress').css('width', percentage + '%');


            $('#taskProgress').removeClass('bg-warning');
            $('#taskProgress').removeClass('bg-primary');
            $('#taskProgress').removeClass('bg-success');
            $('#taskProgress').removeClass('bg-danger');

            if (percentage <= 15) {
                $('#taskProgress').addClass('bg-danger');
            } else if (percentage > 15 && percentage <= 33) {
                $('#taskProgress').addClass('bg-warning');
            } else if (percentage > 33 && percentage <= 70) {
                $('#taskProgress').addClass('bg-primary');
            } else {
                $('#taskProgress').addClass('bg-success');
            }
        }

        function getReminders(){
            $.ajax({
                url: '<?php echo e(url('admin/reminders')); ?>/?status=unread&response=json',
                type: 'get',
                dataType:'json',
                success: function(data){
                    $(".unread_notifications").html(data.count);
                    // for(var i=0; i<100; i++){
                        
                    // }
                    
                }
            })
        }
    </script>
    <?php echo $__env->yieldContent('customjs'); ?>
</body>

</html><?php /**PATH C:\Users\david\Desktop\work\ippu\ippu\resources\views/layouts/app.blade.php ENDPATH**/ ?>