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
/* for service id get */
function myfcn13(idx, servicenm, hsn_nm) {
    document.getElementById("id13").value = idx;
    document.getElementById("servicenm").value = servicenm;
    document.getElementById("hsn_nm").value = hsn_nm;
}
/* for department id get */
function myfcn2(idx, department_name2, DesignationNamee) {
    document.getElementById("id2").value = idx;
    document.getElementById("department_name2").value = department_name2;
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

/* for attendancelist id get */
function myfcn9(idx, signin1, signout1, date) {
    document.getElementById("id9").value = idx;
    document.getElementById("signin1").value = signin1;
    document.getElementById("signout1").value = signout1;
    document.getElementById("date1").value = date;
}

/* for attendancelist id get */
function myfcn10(idx, service_namee1) {
    document.getElementById("id10").value = idx;
    document.getElementById("service_namee1").value = service_namee1;
}

/* for attendancelist id get */
function myfcn11(idx, pro_namew, service_namee11) {
    document.getElementById("id11").value = idx;
    document.getElementById("pro_namew").value = pro_namew;
    document.getElementById("service_namee11").value = service_namee11;
}

/* for attendancelist id get */
// function myfcn12(idx, pro_nm, workk_details, clock_duration, datet) {
//     document.getElementById("id12").value = idx;
//     document.getElementById("pro_nm").value = pro_nm;
//     document.getElementById("workk_details").value = workk_details;
//     document.getElementById("clock_duration").value = clock_duration;
//     document.getElementById("datet").value = datet;
// }


function myfcn12(idx, pro_nm, workk_details, clock_duration, datet) {
    console.log("ID:", idx);
    console.log("Project ID:", pro_nm);
    console.log("Work Details:", workk_details);
    console.log("Duration:", clock_duration);
    console.log("Date:", datet);

    document.getElementById("id12").value = idx;
    document.getElementById("pro_nm").value = pro_nm; // Ensure this matches a <select> option
    document.getElementById("workk_details").value = workk_details;
    document.getElementById("clock_duration").value = clock_duration;
    document.getElementById("datet").value = datet;
}

/* for delete row */
function confirmDelete(id, tb, tbc, returnpage) {
    var confirmation = confirm("Are you sure you want to delete this? You won't be able to revert this!");
    if (confirmation) {
        window.location.href = "delete.php?delete=" + id + "&tb=" + tb + "&tbc=" + tbc + "&returnpage=" + returnpage;
    }
}

function confirmAction(id, name) {
    var confirmation = confirm("Are you sure you want to change the status?");
    if (confirmation) {
        window.location.href = "leads_status.php?id=" + id + "&name=" + encodeURIComponent(name);
    }
}

/* for assigned employee change in all balance */
function loadAssignedUsers() {
    var projectName = document.getElementById("Project_Name").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_assigned_users.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("assigned_users_container").innerHTML = xhr.responseText;
        }
    };
    xhr.send("project=" + projectName);
}

/*calculate duration in the purchase modal */
function calculateDuration() {
    let startDate = new Date(document.getElementById("service_start_date").value);
    let endDate = new Date(document.getElementById("service_end_date").value);
    if (startDate && endDate && endDate >= startDate) {
        let timeDiff = endDate - startDate;
        let duration = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // Convert to days and round up
        document.getElementById("duration").value = duration;
    } else {
        document.getElementById("duration").value = "Invalid";
    }
}

/*calculate duration in the purchase renewal modal */
function calculateDuration1() {
    let startDate = new Date(document.getElementById("service_start_date1").value);
    let endDate = new Date(document.getElementById("service_end_date1").value);
    if (startDate && endDate && endDate >= startDate) {
        let timeDiff = endDate - startDate;
        let duration = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // Convert to days and round up
        document.getElementById("duration12").value = duration;
    } else {
        document.getElementById("duration12").value = "Invalid";
    }
}
// $(document).ready(function () {
//     $('#dept-dropdown').on('change', function () {
//         var category_id = this.value;
//         $.ajax({
//             url: "get_dept_insert.php",
//             type: "POST",
//             data: {
//                 category_id: category_id
//             },
//             cache: false,
//             success: function (result) {
//                 $("#desig").html(result);
//             }
//         });
//     });
// });




