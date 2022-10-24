<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-4" href="index.php">
        <div class="sidebar-brand-text mx-3">
            <img src="images/logo.png" width="50" style="margin-top: 1rem;"/>
            Acadmission
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/dashboard.php') { ?>active <?php } ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/add_examinee.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_examinee.php') { ?>active <?php } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Examinee</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="add_examinee.php">Add Examinee</a>
                <a class="collapse-item" href="manage_examinee.php">Manage Examinee</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_department.php' || $_SERVER['PHP_SELF'] == '/acadmission/manage_course.php') { ?>active <?php } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Course" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-star"></i>
            <span>Academic Program</span>
        </a>
        <div id="Course" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="manage_department.php"> <i class="fas fa-fw fa-building"></i> Department</a>
                <a class="collapse-item" href="manage_course.php"> <i class="fas fa-fw fa-star"></i> Course</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == '/acadmission/manage_questionnaires.php' || $_SERVER['PHP_SELF'] == '/acadmission/questionnaires_form.php') { ?>active <?php } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Questionnaires" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-file"></i>
            <span>Questionnaires</span>
        </a>
        <div id="Questionnaires" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="manage_questionnaires.php">Manage Questionnaire</a>
                <a class="collapse-item" href="utilities-animation.html">Course Category</a>
                <a class="collapse-item" href="utilities-animation.html">Question Category</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-cog"></i>
            <span>General Settings</span>
        </a>
        <div id="settings" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="utilities-color.html">Timer Type</a>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->