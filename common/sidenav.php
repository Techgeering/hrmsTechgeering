<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">            
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#EmployeesLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                    Employees
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="EmployeesLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="addEmployee.php">Add Employees</a>
                        <a class="nav-link" href="manageEmployee.php">Manage Employees</a>
                        <a class="nav-link" href="departments.php">Departments</a>
                        <a class="nav-link" href="designation.php">Designation</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#LeaveLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-luggage"></i></div>
                    Leave
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="LeaveLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="leaveApply.php">Apply Leave</a>
                        <a class="nav-link" href="leaveType.php">Leave Type</a>
                        <a class="nav-link" href="viewLeave.php">Applyed Leaves</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ProjectLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-luggage"></i></div>
                    Projects
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="ProjectLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="projects.php">All Projects</a>
                        <a class="nav-link" href="company.php">Company</a> 
                        <a class="nav-link" href="companyPersons.php">Company Persons</a> 
                    </nav>
                </div>                
                <a class="nav-link" href="accounts.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                    Accounts
                </a>                
                <a class="nav-link" href="tasks.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                    Tasks
                </a>
            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> -->
    </nav>
</div>