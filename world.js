document.addEventListener("DOMContentLoaded", function(){

    const btn = document.getElementById("lookup-country");
    const btn2 = document.getElementById("lookup-cities")
    const country = document.getElementById("country");
    const result = document.getElementById("result");

    btn.addEventListener("click", function(){

        const httpRequest = new XMLHttpRequest();
        const query = country.value.trim();

        httpRequest.addEventListener("load", function(){
            if(httpRequest.status == 200){
                result.innerHTML = httpRequest.responseText;
            } else {
                result.innerHTML = "The request has failed.";
            }
        });

        httpRequest.addEventListener("error", function(){
            result.textContent = "Unable to load countries.";
        });

        httpRequest.open("GET","world.php?country=" + encodeURIComponent(query));
        httpRequest.send();
    })

    btn2.addEventListener("click", function(){

        const httpRequest = new XMLHttpRequest();
        const query2 = country.value.trim();

        httpRequest.addEventListener("load", function(){
            if(httpRequest.status == 200){
                result.innerHTML = httpRequest.responseText;
            } else {
                result.innerHTML = "The request has failed.";
            }
        });

        httpRequest.addEventListener("error", function(){
            result.textContent = "Unable to load cities.";
        });

        httpRequest.open("GET","world.php?country=" + encodeURIComponent(query2) + "&lookup=cities");
        httpRequest.send();
    })

});