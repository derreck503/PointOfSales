function showEmployee() {
    console.log("Show employee function entered");
        document.getElementById("showEmployee").style.display = "block";
        document.getElementById("updateButton").style.visibility = "visible";
}
function showEmployeeDelete() {
        document.getElementById("showEmployeeDelete").style.display = "block";
        document.getElementById("confirmDelete").removeAttribute("disabled");
}
function disableConfirmButton() {
        document.getElementById("confirmDelete").setAttribute("disabled","disabled");
}
function showAllEmployees() {
	document.getElementById("showAllEmployees").style.display = "block";
}
function showAudit() {
	document.getElementById("showAuditDetails").style.display = "block";
}