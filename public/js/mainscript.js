$(function() {
    
$('#customImagesCheck').on('change',function(){

    if($(this).prop("checked")){
    	//alert("lelelel");
    	$('.custom-Images-Form').fadeIn("slow");
    	$('#newsSmallImage').removeAttr('disabled');
    	$('#newsImage').removeAttr('disabled');
    	$('#newsCover').removeAttr('disabled');

    }else{
    	//alert("else");
    	$('.custom-Images-Form').fadeOut("slow");
    	$('#newsSmallImage').attr('disabled','disabled');
    	$('#newsImage').attr('disabled','disabled');
    	$('#newsCover').attr('disabled','disabled');
    }
});

});