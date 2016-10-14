var Script = function () {


   
  
    var pieData = [
        {
            value: 30,
            color:"#2de52d"
			
        },
        {
            value : 50,
            color : "#ff6c60"
        },
     

    ];
   
  
    new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);


}();