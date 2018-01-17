$(function() {


var count = 5;

var counter = setInterval(timer, 1000); //1000 will  run it every 1 second

function timer()
{
  count = count-1;
  console.log(count)
  if (count <= 0)
  {
     clearInterval(counter);
     window.location.replace("/");
  }
$(".returnCountdown").html("Returning Home in "+count);
}
});