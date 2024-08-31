<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-success sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                <?php } ?>
                <?php if ($em_role == '1') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Organization"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                        Organization
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Organization" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="departments.php">Departments</a>
                            <a class="nav-link" href="em_role.php">em_role</a>
                        </nav>
                    </div>
                <?php } ?>
                <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#EmployeesLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                        Employees
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="EmployeesLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3') { ?>
                                <a class="nav-link" href="employees.php">Employees</a>
                            <?php } ?>
                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3') { ?>
                                <a class="nav-link" href="Disciplinary.php">Disciplinary </a>
                            <?php } ?>
                            <?php if ($em_role == '1' || $em_role == '3') { ?>
                                <a class="nav-link" href="inactiveuser.php">Ex-Employees</a>
                            <?php } ?>
                        </nav>
                    </div>
                <?php } ?>
                <?php if ($em_role == '1' || $em_role == '3' || $em_role == '4') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Attendance"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div>
                        Attendance
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Attendance" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <?php if ($em_role == '1' || $em_role == '3' || $em_role == '4') { ?>
                                <a class="nav-link" href="attendanceList.php">Attendance List </a>
                            <?php } ?>
                            <?php if ($em_role == '1' || $em_role == '3' || $em_role == '4') { ?>
                                <a class="nav-link" href="attendanceReport.php">Attendance Report </a>
                            <?php } ?>
                        </nav>
                    </div>
                <?php } ?>
                <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#LeaveLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-luggage"></i></div>
                        Leave
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="LeaveLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                <a class="nav-link" href="holiday.php">Holiday </a>
                            <?php } ?>
                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                <a class="nav-link" href="leaveType.php">Leave Type</a>
                            <?php } ?>
                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                <a class="nav-link" href="viewLeave.php"> Leave Application </a>
                            <?php } ?>
                            <?php if ($em_role == '1') { ?>
                                <a class="nav-link" href="leaveEarned.php"> Earned Leave </a>
                            <?php } ?>
                            <?php if ($em_role == '1') { ?>
                                <a class="nav-link" href="leaveReport.php"> Report </a>
                            <?php } ?>
                        </nav>
                    </div>
                <?php } ?>
                <?php if ($em_role == '1') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Payroll"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-luggage"></i></div>
                        Payroll
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Payroll" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="payrollList.php"> Payroll List </a>
                            <a class="nav-link" href="company.php"> Generate Payslip</a>
                            <a class="nav-link" href="companyPersons.php"> Payslip Report</a>
                        </nav>
                    </div>
                <?php } ?>
                <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ProjectLayouts"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-person-walking-luggage"></i></div>
                        Projects
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="ProjectLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <?php if ($em_role == '1' || $em_role == '2' || $em_role == '3' || $em_role == '4') { ?>
                                <a class="nav-link" href="projects.php">All Projects</a>
                            <?php } ?>
                            <?php if ($em_role == '1') { ?>
                                <a class="nav-link" href="tasklist.php"> Task List </a>
                            <?php } ?>
                            <?php if ($em_role == '1') { ?>
                                <a class="nav-link" href="company.php"> Field Visit</a>
                            <?php } ?>
                        </nav>
                    </div>
                <?php } ?>
                <?php if ($em_role == '1') { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#account"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                        Accounts
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="account" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="tbalance.php">Balance Sheet(Tax)</a>
                            <a class="nav-link" href="wtbalance.php">Balance Sheet(W-Tax)</a>
                            <a class="nav-link" href="allbalance.php">Balance Sheet</a>
                            <a class="nav-link" href="expenditure.php">Expenditure</a>
                            <a class="nav-link" href="expenditure_calculator.php">Expenditure Calculator</a>
                        </nav>
                    </div>
                <?php } ?>

                <a class="nav-link" href="leads.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                    Leads
                </a>
                <!-- <a class="nav-link" href="tasks.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                    Tasks
                </a> -->
            </div>
        </div>

    </nav>
</div>