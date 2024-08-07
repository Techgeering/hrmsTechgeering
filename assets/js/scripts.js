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

/* for project files */
// function myfcn4(idx, filename1, pdf11, assigned_users1) {
//     document.getElementById("id4").value = idx;
//     document.getElementById("filename1").value = filename1;
//     document.getElementById("pdf11").value = pdf11;
//     document.getElementById("assigned_users1").value = assigned_users1;
// }
