//change refresh period here
var REFRESH_PERIOD = 1000;

//IFE for updating
(function() {
  //initial coloring
  getSeats();
  //After loading initial time, refreshes data every period
  setInterval(function(){
    var seats = getSeats();
    //seats = seats + 1;
  //  colorSeats(seats);
/*  console.log(seats);*/ }, REFRESH_PERIOD);
})();

function randomIntFromInterval(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}

function colorSeats(seats){
  //seat 1 occupied if odd number
  if(seats%2==1){
    $("#seat1").css('background-color','red');
  }
  else{
    $("#seat1").css('background-color','green');
  }
  //seat 2 occupied
  if(seats==2||seats==3||seats==6||seats==7||seats==10||seats==11||seats==14||seats==15){
    $("#seat2").css('background-color','red');
  }
  else{
    $("#seat2").css('background-color','green');
  }
  //seat 3 occupied
  if((seats>3&&seats<8)||(seats>11)){
    $("#seat3").css('background-color','red');
  }
  else{
    $("#seat3").css('background-color','green');
  }
  //seat 4 occupied
  /*
  if(seats>7){
    $("#seat4").css('background-color','red');
  }
  else{
    $("#seat4").css('background-color','green');
  }*/
}

function getSeats(){
  var temp = 0;
  //update seats used
  $.get("./php/read-data.php",function(data){
    temp = parseInt(data,10);
  //  console.log(temp);
    colorSeats(temp);
    getUpdateTime();
  });

  //get last database update time
  function getUpdateTime(){
    //update datetime
    $.get("./php/read-date.php",function(data){
      $("#last_update").text("Last Updated "+data+" UTC");
    });
  }
}
