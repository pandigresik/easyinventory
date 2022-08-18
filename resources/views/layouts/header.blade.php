<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="vendor/coreui/icons/svg/brand.svg#cib-coreui"></use>
            </svg></a>
        <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
        </ul>
        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon icon-lg my-1 mx-2">
                        <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-danger">5</span></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0" style="">
                    <div class="dropdown-header bg-light"><strong>You have 5 notifications</strong></div><a
                        class="dropdown-item" href="#">
                        <svg class="icon me-2 text-success">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-user-follow"></use>
                        </svg> New user registered</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2 text-danger">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-user-unfollow"></use>
                        </svg> User deleted</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2 text-info">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-chart"></use>
                        </svg> Sales report is ready</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2 text-success">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-basket"></use>
                        </svg> New client</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2 text-warning">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-speedometer"></use>
                        </svg> Server overloaded</a>
                    <div class="dropdown-header bg-light"><strong>Server</strong></div><a class="dropdown-item d-block"
                        href="#">
                        <div class="text-uppercase mb-1"><small><b>CPU Usage</b></small></div><span
                            class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-medium-emphasis">348 Processes. 1/4 Cores.</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>Memory Usage</b></small></div><span
                            class="progress progress-thin">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-medium-emphasis">11444GB/16384MB</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>SSD 1 Usage</b></small></div><span
                            class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-medium-emphasis">243GB/256GB</small>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon icon-lg my-1 mx-2">
                        <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-list-rich"></use>
                    </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-warning">5</span></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 5 pending tasks</strong></div><a
                        class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Upgrade NPM &amp; Bower<span
                                class="float-end"><strong>0%</strong></span></div>
                        <span class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">ReactJS Version<span class="float-end"><strong>25%</strong></span></div>
                        <span class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">VueJS Version<span class="float-end"><strong>50%</strong></span></div>
                        <span class="progress progress-thin">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Add new layouts<span class="float-end"><strong>75%</strong></span></div>
                        <span class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Angular 8 Version<span class="float-end"><strong>100%</strong></span>
                        </div><span class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item text-center border-top" href="#"><strong>View all tasks</strong></a>
                </div>
            </li>
            <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon icon-lg my-1 mx-2">
                        <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-info">7</span></a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 4 messages</strong></div><a
                        class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 me-3 float-start">
                                <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                        alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                            </div>
                            <div><small class="text-medium-emphasis">John Doe</small><small
                                    class="text-medium-emphasis float-end mt-1">Just now</small></div>
                            <div class="text-truncate font-weight-bold"><span class="text-danger">!</span> Important
                                message
                            </div>
                            <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit, sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 me-3 float-start">
                                <div class="avatar"><img class="avatar-img" src="assets/img/avatars/6.jpg"
                                        alt="user@email.com"><span class="avatar-status bg-warning"></span></div>
                            </div>
                            <div><small class="text-medium-emphasis">John Doe</small><small
                                    class="text-medium-emphasis float-end mt-1">5 minutes ago</small></div>
                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                            <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit, sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 me-3 float-start">
                                <div class="avatar"><img class="avatar-img" src="assets/img/avatars/5.jpg"
                                        alt="user@email.com"><span class="avatar-status bg-danger"></span></div>
                            </div>
                            <div><small class="text-medium-emphasis">John Doe</small><small
                                    class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                            <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit, sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 me-3 float-start">
                                <div class="avatar"><img class="avatar-img" src="assets/img/avatars/4.jpg"
                                        alt="user@email.com"><span class="avatar-status bg-info"></span></div>
                            </div>
                            <div><small class="text-medium-emphasis">John Doe</small><small
                                    class="text-medium-emphasis float-end mt-1">4:03 PM</small></div>
                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                            <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                consectetur
                                adipisicing elit, sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item text-center border-top" href="#"><strong>View all messages</strong></a>
                </div>
            </li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/8.jpg"
                            alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Account</div>
                    </div><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-bell"></use>
                        </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item"
                        href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-envelope-open"></use>
                        </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a
                        class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-task"></use>
                        </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item"
                        href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-comment-square"></use>
                        </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Settings</div>
                    </div><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-user"></use>
                        </svg> Profile</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg> Settings</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-credit-card"></use>
                        </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a
                        class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-file"></use>
                        </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-lock-locked"></use>
                        </svg> Lock Account</a><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="vendor/coreui/icons/svg/free.svg#cil-account-logout"></use>
                        </svg> Logout</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            @stack('breadcrumb')
        </nav>
    </div>
</header>