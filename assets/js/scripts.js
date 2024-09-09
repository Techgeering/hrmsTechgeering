/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }
});

// Call the dataTables jQuery plugin
$(document).ready(function () {
    $("#dataTable").DataTable();
});

function showDropdown(elementId) {
    var pElement = document.querySelector('p[onclick="showDropdown(\'' + elementId + '\')"]');
    var selectElement = document.getElementById(elementId);

    pElement.style.display = 'none';
    selectElement.style.display = 'block';

    selectElement.addEventListener('change', function () {
        pElement.innerHTML = selectElement.value;
        pElement.style.display = 'block';
        selectElement.style.display = 'none';
        // You can add an AJAX call here to save the changed blood group to the database
    });
}

/* for department id get */
function myfcn1(idx, DepartmentName) {
    document.getElementById("id1").value = idx;
    document.getElementById("DepartmentNamee").value = DepartmentName;
}
/* for department id get */
function myfcn2(idx, DesignationNamee) {
    document.getElementById("id2").value = idx;
    document.getElementById("DesignationNamee").value = DesignationNamee;
}

function myfcn3(idx, degreetitle, result, institute, passingyear) {
    document.getElementById("id3").value = idx;
    document.getElementById("degreetitle").value = degreetitle;
    document.getElementById("result").value = result;
    document.getElementById("institute").value = institute;
    document.getElementById("passingyear").value = passingyear;
}

/* for leaveTypee id get */
function myfcn5(idx, leaveTypee, dayss) {
    document.getElementById("id5").value = idx;
    document.getElementById("leaveTypee").value = leaveTypee;
    document.getElementById("dayss").value = dayss;
}


/* for leaveTypee id get */
function myfcn6(idx, degreetitle, institutename, universityname, result, passingyear) {
    document.getElementById("id6").value = idx;
    document.getElementById("degreetitle22").value = degreetitle;
    document.getElementById("institutename22").value = institutename;
    document.getElementById("universityname22").value = universityname;
    document.getElementById("result22").value = result;
    document.getElementById("passingyear22").value = passingyear;
}

/* for pdf id get */
function myfcn8(idx, filename) {
    document.getElementById("id8").value = idx;
    document.getElementById("filename11").value = filename;
}







