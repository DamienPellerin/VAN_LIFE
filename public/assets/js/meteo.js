var callBackSuccess = function(data) {
    console.log("donnees api",data);
var meteo = document.getElementById("zone meteo");
meteo.innerHTML = data.main.temp;
}

function buttonClickGet() {
var queryLoc = document.getElementById("queryLoc").value;

    var url = "https://pro.openweathermap.org/data/2.5/forecast/climate?q={city name},{country code}&appid={API key}";
    $.get(url, callBackSuccess).done(function(){
        console.log("done");
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {

    });
}