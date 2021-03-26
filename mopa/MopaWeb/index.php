<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="David Vancl">
        <title>Mopa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="Utils/theme.css">
    </head>
    <body>
        <header id="header" class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
            <a id="mainTitle" class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Mopa</a>
        </header>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <img class="feather feather-home" src="Images/monitoring.png" height="24" width="24" alt="">
                                    RTC Monitorování
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Products</a>
                            </li>
                        </ul>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Saved reports</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Current month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Last quarter</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Social engagement</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Year-end sale</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Tabulka naměřených údajů <p id="connection_status">Connection status</p></h1>
                        <span id="last_monitoring">Poslední změna: </span>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 themed-grid-col light_bg">Vnitřní teplota</div>
                        <div id="inside_temperature" class="col-6 themed-grid-col light_bg"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 themed-grid-col light_bg">Vnější teplota</div>
                        <div id="outside_temperature" class="col-6 themed-grid-col light_bg"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 themed-grid-col dark_bg">Vnitřní vlhkost</div>
                        <div id="inside_humidity" class="col-6 themed-grid-col dark_bg"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 themed-grid-col dark_bg">Vnější vlhkost</div>
                        <div id="outside_humidity" class="col-6 themed-grid-col dark_bg"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <canvas id="temperatureChart" width="100" height="100"></canvas>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script type="text/javascript" src="Utils/WebClient.js"></script>
    </body>
</html>