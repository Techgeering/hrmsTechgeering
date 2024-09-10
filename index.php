<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Hrms Techgeering</title>
    <link rel="icon" type="image/png" href="assets/img/favicon-t.png">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css?v=<?php echo time(); ?>" rel="stylesheet" />
    <link href="assets/css/style1.css?v=<?php echo time(); ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- start Top Navbar -->
    <?php include 'common/topnav.php' ?>
    <!-- end Top Navbar -->
    <div id="layoutSidenav">
        <!-- start Side Navbar -->
        <?php include 'common/sidenav.php' ?>
        <!-- end Side Navbar -->
        <!-- start body content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="my-2">Dashboard</h1>

                    <div class="page-wrapper mdc-toolbar-fixed-adjust">
                        <main class="content-wrapper">
                            <div class="mdc-layout-grid">
                                <div class="mdc-layout-grid__inner">
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--success">
                                            <div class="card-inner">
                                                <h5 class="card-title">Borrowed</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">$62,0076.00</h5>
                                                <p class="tx-12 text-muted">48% target reached</p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-list-alt text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--danger">
                                            <div class="card-inner">
                                                <h5 class="card-title">Annual Profit</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">$1,958,104.00</h5>
                                                <p class="tx-12 text-muted">55% target reached</p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-usd text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--primary">
                                            <div class="card-inner">
                                                <h5 class="card-title">Lead Conversion</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">$234,769.00</h5>
                                                <p class="tx-12 text-muted">87% target reached</p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i
                                                            class="fa fa-line-chart text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card info-card info-card--info">
                                            <div class="card-inner">
                                                <h5 class="card-title">Average Income</h5>
                                                <h5 class="font-weight-light pb-2 mb-1 border-bottom">$1,200.00</h5>
                                                <p class="tx-12 text-muted">87% target reached</p>
                                                <div class="card-icon-wrapper">
                                                    <i class="material-icons"><i class="fa fa-briefcase text-white fs-2"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                                        <div class="mdc-card">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mb-0">Revenue by location</h4>
                                                <div>
                                                    <i class="material-icons refresh-icon"><i class="fa fa-refresh"
                                                            aria-hidden="true"></i></i>
                                                    <i class="material-icons options-icon ml-2"><i
                                                            class="fa fa-ellipsis-v" aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                            <div class="d-block d-sm-flex justify-content-between align-items-center">
                                                <h5 class="card-sub-title mb-2 mb-sm-0">Sales performance revenue based
                                                    by country</h5>
                                                <div class="menu-button-container">
                                                    <button
                                                        class="mdc-button mdc-menu-button mdc-button--raised button-box-shadow tx-12 text-dark bg-white font-weight-light">
                                                        Last 7 days
                                                        <i class="material-icons ms-3"><i class="fa fa-caret-down"
                                                                aria-hidden="true"></i></i>
                                                    </button>
                                                    <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                                                        <ul class="mdc-list" role="menu" aria-hidden="true"
                                                            aria-orientation="vertical">
                                                            <li class="mdc-list-item" role="menuitem">
                                                                <h6 class="item-subject font-weight-normal">Back</h6>
                                                            </li>
                                                            <li class="mdc-list-item" role="menuitem">
                                                                <h6 class="item-subject font-weight-normal">Forward</h6>
                                                            </li>
                                                            <li class="mdc-list-item" role="menuitem">
                                                                <h6 class="item-subject font-weight-normal">Reload</h6>
                                                            </li>
                                                            <li class="mdc-list-divider"></li>
                                                            <li class="mdc-list-item" role="menuitem">
                                                                <h6 class="item-subject font-weight-normal">Save As..
                                                                </h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mdc-layout-grid__inner mt-2">
                                                <div
                                                    class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-8-tablet">
                                                    <div class="table-responsive">
                                                        <table class="table dashboard-table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <span class="flag-icon-container"><i
                                                                                class="flag-icon flag-icon-us mr-2"></i></span>United
                                                                        States
                                                                    </td>
                                                                    <td>$1,671.10</td>
                                                                    <td class=" font-weight-medium"> 39% </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> <span class="flag-icon-container"><i
                                                                                class="flag-icon flag-icon-ph mr-2"></i></span>Philippines
                                                                    </td>
                                                                    <td>$1,064.75</td>
                                                                    <td class=" font-weight-medium"> 30% </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> <span class="flag-icon-container"><i
                                                                                class="flag-icon flag-icon-gb mr-2"></i></span>United
                                                                        Kingdom</td>
                                                                    <td>$1,055.98</td>
                                                                    <td class=" font-weight-medium"> 45% </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> <span class="flag-icon-container"><i
                                                                                class="flag-icon flag-icon-ca mr-2"></i></span>Canada
                                                                    </td>
                                                                    <td>$1,045.49</td>
                                                                    <td class=" font-weight-medium"> 80% </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> <span class="flag-icon-container"><i
                                                                                class="flag-icon flag-icon-fr mr-2"></i></span>France
                                                                    </td>
                                                                    <td>$2,050.93</td>
                                                                    <td class=" font-weight-medium"> 10% </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-8-tablet">
                                                    <div id="revenue-map" class="revenue-world-map"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card bg-success text-white">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="font-weight-normal">Impressions</h3>
                                                <i class="material-icons options-icon text-white"><i
                                                        class="fa fa-ellipsis-v" aria-hidden="true"></i></i>
                                            </div>
                                            <div class="mdc-layout-grid__inner align-items-center">
                                                <div
                                                    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-2-phone">
                                                    <div>
                                                        <h5 class="font-weight-normal mt-2">Customers 58.39k</h5>
                                                        <h2 class="font-weight-normal mt-3 mb-0">636,757K</h2>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop mdc-layout-grid__cell--span-5-tablet mdc-layout-grid__cell--span-2-phone">
                                                    <canvas id="impressions-chart" height="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-tablet">
                                        <div class="mdc-card bg-info text-white">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="font-weight-normal">Traffic</h3>
                                                <i class="material-icons options-icon text-white"><i
                                                        class="fa fa-ellipsis-v" aria-hidden="true"></i></i>
                                            </div>
                                            <div class="mdc-layout-grid__inner align-items-center">
                                                <div
                                                    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-2-phone">
                                                    <div>
                                                        <h5 class="font-weight-normal mt-2">Customers 58.39k</h5>
                                                        <h2 class="font-weight-normal mt-3 mb-0">636,757K</h2>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop mdc-layout-grid__cell--span-5-tablet mdc-layout-grid__cell--span-2-phone">
                                                    <canvas id="traffic-chart" height="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
                                        <div class="mdc-card">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="card-title mb-2 mb-sm-0">Revenue by location</h4>
                                                <div class="d-flex justtify-content-between align-items-center">
                                                    <p class="d-none d-sm-block text-muted tx-12 mb-0 mr-2">Goal reached
                                                    </p>
                                                    <i class="material-icons options-icon"><i class="fa fa-ellipsis-v"
                                                            aria-hidden="true"></i></i>
                                                </div>
                                            </div>
                                            <div class="d-block d-sm-flex justify-content-between align-items-center">
                                                <h6 class="card-sub-title mb-0">Sales performance revenue based by
                                                    country</h6>
                                                <div class="mdc-tab-wrapper revenue-tab mdc-tab--secondary">
                                                    <div class="mdc-tab-bar" role="tablist">
                                                        <div class="mdc-tab-scroller">
                                                            <div class="mdc-tab-scroller__scroll-area">
                                                                <div class="mdc-tab-scroller__scroll-content">
                                                                    <button class="mdc-tab mdc-tab--active" role="tab"
                                                                        aria-selected="true" tabindex="0">
                                                                        <span class="mdc-tab__content">
                                                                            <span class="mdc-tab__text-label">1W</span>
                                                                        </span>
                                                                        <span
                                                                            class="mdc-tab-indicator mdc-tab-indicator--active">
                                                                            <span
                                                                                class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                                        </span>
                                                                        <span class="mdc-tab__ripple"></span>
                                                                    </button>
                                                                    <button class="mdc-tab mdc-tab" role="tab"
                                                                        aria-selected="true" tabindex="0">
                                                                        <span class="mdc-tab__content">
                                                                            <span class="mdc-tab__text-label">1M</span>
                                                                        </span>
                                                                        <span
                                                                            class="mdc-tab-indicator mdc-tab-indicator">
                                                                            <span
                                                                                class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                                        </span>
                                                                        <span class="mdc-tab__ripple"></span>
                                                                    </button>
                                                                    <button class="mdc-tab mdc-tab" role="tab"
                                                                        aria-selected="true" tabindex="0">
                                                                        <span class="mdc-tab__content">
                                                                            <span class="mdc-tab__text-label">3M</span>
                                                                        </span>
                                                                        <span
                                                                            class="mdc-tab-indicator mdc-tab-indicator">
                                                                            <span
                                                                                class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                                        </span>
                                                                        <span class="mdc-tab__ripple"></span>
                                                                    </button>
                                                                    <button class="mdc-tab mdc-tab" role="tab"
                                                                        aria-selected="true" tabindex="0">
                                                                        <span class="mdc-tab__content">
                                                                            <span class="mdc-tab__text-label">1Y</span>
                                                                        </span>
                                                                        <span
                                                                            class="mdc-tab-indicator mdc-tab-indicator">
                                                                            <span
                                                                                class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                                        </span>
                                                                        <span class="mdc-tab__ripple"></span>
                                                                    </button>
                                                                    <button class="mdc-tab mdc-tab" role="tab"
                                                                        aria-selected="true" tabindex="0">
                                                                        <span class="mdc-tab__content">
                                                                            <span class="mdc-tab__text-label">ALL</span>
                                                                        </span>
                                                                        <span
                                                                            class="mdc-tab-indicator mdc-tab-indicator">
                                                                            <span
                                                                                class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                                        </span>
                                                                        <span class="mdc-tab__ripple"></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="content content--active">
                                                    </div>
                                                    <div class="content">
                                                    </div>
                                                    <div class="content">
                                                    </div>
                                                    <div class="content">
                                                    </div>
                                                    <div class="content">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chart-container mt-4">
                                                <canvas id="revenue-chart" height="260"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet">
                                        <div class="mdc-card">
                                            <div class="d-flex d-lg-block d-xl-flex justify-content-between">
                                                <div>
                                                    <h4 class="card-title">Order Statistics</h4>
                                                    <h6 class="card-sub-title">Customers 58.39k</h6>
                                                </div>
                                                <div id="sales-legend" class="d-flex flex-wrap"></div>
                                            </div>
                                            <div class="chart-container mt-4">
                                                <canvas id="chart-sales" height="260"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-card">
                                            <h6 class="card-title">Line chart</h6>
                                            <canvas id="lineChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-card">
                                            <h6 class="card-title">Bar chart</h6>
                                            <canvas id="barChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-card">
                                            <h6 class="card-title">Area chart</h6>
                                            <canvas id="areaChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-card">
                                            <h6 class="card-title">Doughnut chart</h6>
                                            <canvas id="doughnutChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-card">
                                            <h6 class="card-title">Pie chart</h6>
                                            <canvas id="pieChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-card">
                                            <h6 class="card-title">Scatter chart</h6>
                                            <canvas id="scatterChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        </footer>
                        <!-- partial -->
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card   mb-4">
                                <div class="card-body"><i class="fas fa-user fs-4 me-3"></i><b>9999</b> Employees</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small  stretched-link" href="#">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card   mb-4">
                                <div class="card-body"><i class="fas fa-user fs-4 me-3"></i><b>9999</b> Employees</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small  stretched-link" href="#">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card   mb-4">
                                <div class="card-body"><i class="fas fa-user fs-4 me-3"></i><b>9999</b> Employees</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small  stretched-link" href="#">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card   mb-4">
                                <div class="card-body"><i class="fas fa-user fs-4 me-3"></i><b>9999</b> Employees</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small  stretched-link" href="#">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 text-center">
                                <div class="card-body">
                                    <div>
                                        <h3>1</h3>
                                    </div>
                                    <div>Danger Card</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 text-center">
                                <div class="card-body">
                                    <div>
                                        <h3>1</h3>
                                    </div>
                                    <div>Danger Card</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 text-center">
                                <div class="card-body">
                                    <div>
                                        <h3>1</h3>
                                    </div>
                                    <div>Danger Card</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4 text-center">
                                <div class="card-body">
                                    <div>
                                        <h3>1</h3>
                                    </div>
                                    <div>Danger Card</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Running Projects
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>2011/04/25</td>
                                                <td>2011/04/25</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>2011/07/25</td>
                                                <td>2011/04/25</td>
                                            </tr>
                                            <tr>
                                                <td>Michael Bruce</td>
                                                <td>2011/06/27</td>
                                                <td>2011/04/25</td>
                                            </tr>
                                            <tr>
                                                <td>Donna Snider</td>
                                                <td>2011/01/25</td>
                                                <td>2011/04/25</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                    <tr>
                                        <td>Michael Bruce</td>
                                        <td>Javascript Developer</td>
                                        <td>Singapore</td>
                                        <td>29</td>
                                        <td>2011/06/27</td>
                                        <td>$183,000</td>
                                    </tr>
                                    <tr>
                                        <td>Donna Snider</td>
                                        <td>Customer Support</td>
                                        <td>New York</td>
                                        <td>27</td>
                                        <td>2011/01/25</td>
                                        <td>$112,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'common/copyrightfooter.php' ?>
        </div>
        <!-- start body content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/js/font-awesome.min.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/chartjs.js"></script>
    <script src="assets/js/material.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
</body>

</html>