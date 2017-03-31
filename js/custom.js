// Forces modal warnings to automatically popup on pageload.
function modalPopup(){
    $("#modalWarning").modal("show");
}
jQuery(document).ready(function(){
    modalPopup();

    $( ".product" ).change(function() {
  		$(".color").removeAttr("disabled");
	});
	$( ".color" ).change(function() {
  		$(".size").removeAttr("disabled");
	});
	$( ".size" ).change(function() {
  		$(".quantity").removeAttr("disabled");
	});
});
