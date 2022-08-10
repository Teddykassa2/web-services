<html>
<head>
<title>Car Web Service Demo</title>
<style>
	body {font-family:georgia;}

  .car{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
	max-width:50px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">


  function carTemplate(car){
    return `
      <div class="car">
         <b>Name</b>: ${car.Name}<br>
         <b>Year</b>: ${car.Year}<br>
         <b>Engine</b>: ${car.Engine} <br>
         <b>Trim</b>: ${car.Trim}<br>
         <b>Make</b>: ${car.Make}<br>
         <b>Horsepower</b>: ${car.Horsepower}<br>
         <b>Price</b>: ${car.Price}<br>
         <b>Bond</b>: ${car.Bond}<br>
        <div class="pic"><img src="thumbnails/${car.Image}" /></div> 
        </div>   
    `;
  }

  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);



     //place data.title on age
     $("#carname").html(data.name);

     //clear previous films
     $("#cars").html("");

      //loop through data.film and place on page 
     $.each(data.cars,function(i,item){

       let myData = carTemplate(item);
       $("<div></div>").html(myData).appendTo("#cars");
       
     });
     
    /*
     let myData = JSON.stringify(data,null,4);
     myData = "<pre>" + myData + "</pre>";
     $("#output").html(myData);
     */
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 


</script>
</head>
	<body>
	<h1>Car Web Service</h1>
		<a href="engine" class="category">Cars By Engine Size</a><br />
		<a href="makes" class="category">Cars By Makes</a>
		
    
		<h3 id="carname">Cars</h3>
		<div id="cars">
       <!--
			<div class="film">
         <b>Film</b>: 1<br>
         <b>Title</b>: Dr. No<br>
         <b>Year</b>: 1962 <br>
         <b>Director</b>: Terence Young<br>
         <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br>
         <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br>
         <b>Composer</b>: Monty Norman<br>
         <b>Bond</b>: Sean Connery<br>
         <b>Budget</b>: $1,000,000.00<br>
         <b>BoxOffice</b>: $59,567,035.00<br>
         <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
        </div>
        -->
		</div>
		<div id="output">Results go here</div>
	</body>
</html>