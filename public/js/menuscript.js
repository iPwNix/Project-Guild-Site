$(function() {
//alert("SCRIPT ACTIVE");
var $openMenuButton = $(".openMenuButton");
var $closeMenuButton = $(".closeMenuButton");
var $menubar = $(".menubar-inactive");

$openMenuButton.click(function() {
  $menubar.addClass( "menubar-active" );
  $openMenuButton.fadeOut("slow");
});

$closeMenuButton.click(function() {
  $menubar.removeClass( "menubar-active" );
  $openMenuButton.fadeIn("slow");
});

});