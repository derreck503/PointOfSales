function showSupplier(supplierID) {
    console.log("Show supplier function entered");
    console.log(SupplierID);
    if (document.getElementById("showSupplier").style.display == "block") {
        document.getElementById("showSupplier").style.display = "none";

    } else {
        document.getElementById("showSupplier").style.display = "block";
    }
}