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


    //links for pdf generation
    jQuery(".ajax-lnk").click(function(e){


        //add a preloader to the cell intead of a button
        var parent = jQuery(this).parent();
        parent.html('<div style="text-align: center"><img style="width: 34px; height: 34px;" src="/img/ajax_preloader.gif"></div>');

        //get 'href' from link
        var href = $(this).attr('href');

        //ajax load data
        jQuery.ajax({ url: href,beforeSend: function(){}}).done(function(data)
        {
            //new href
            var new_href = href;
            new_href = new_href.replace('genpdf','getpdf');

            //set data from ajax
            parent.html('<a href="'+new_href+'">'+data+'</a>')
        });

        //stop event propagation
        return false;
    });
	
});

