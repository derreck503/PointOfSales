function showAll() {
    console.log("Show All function entered");
    if (document.getElementById("showAllSuppliers").style.display == "block") {
        document.getElementById("showAllSuppliers").style.display = "none";

    } else {
        document.getElementById("showAllSuppliers").style.display = "block";
    }
}