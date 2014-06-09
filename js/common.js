$(document).ready(function(e) {
    
	$(".date-picker").datepicker();
	
	$(".date-picker").on("change", function () {
		var id = $(this).attr("id");
		var val = $("label[for='" + id + "']").text();
		$("#msg").text(val + " changed");
	});
    
    $('.ops_link').click(function(e) {
        var link = $(this).attr('href');
		
        var modal = $('.modal-content');
		$.ajaxSetup({async:false});
        $(modal).load(link);
        $("#myModal").modal('show');

        return false;        
    });//ops_link	
	
	
});

