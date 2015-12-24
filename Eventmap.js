var geocoder;
var map;


function Eventmap()
{
geocoder = new google.maps.Geocoder();
var address = "Paris";
var latlng = new google.maps.LatLng(0,0);
var mapOptions = 
	{
		zoom: 15,
		center: latlng
	}

map = new google.maps.Map(document.getElementById("map"), mapOptions);


  google.maps.event.addDomListener(map, 'click', function() {
    window.alert('Map was clicked!');
  });
  
  	geocoder.geocode( { 'address': address}, function(results, status) 
	{
		if (status == google.maps.GeocoderStatus.OK) 
		{
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker(
			{
				map: map,
				position: results[0].geometry.location,
				title: 'Hello World!',
				animation: google.maps.Animation.DROP,
			});
		google.maps.event.addListener(marker,'click',function() {
		map.setZoom(9);
		map.setCenter(marker.getPosition());
  });
		} 
	else {
	alert("Geocode was not successful for the following reason: " + status);
	}
	});
}

function inscriptionevent(Event_id){
        var scriptElement = document.createElement('script');
            scriptElement.src = 'particip.php?Event_id='+Event_id;
		document.body.appendChild(scriptElement);
		location.reload();
    
}
function noter(note,Event_id){
		var scriptElement = document.createElement('script');
            scriptElement.src = 'note.php?Event_id='+Event_id+'&note='+note;
		document.body.appendChild(scriptElement);
		location.reload();
}
function notation(Event_id,listenote){
	for(var i= 0; i < listenote.length; i++)
{
	var elmt = document.getElementById(listenote[i]);
	elmt.style.color = "orange";
	
}	
	
	
}
function profpic(){
	var elmts = document.getElementsByClassName('profpic');
	for(var i=0; i<elmts.length;i++){	
	elmts[i].style.width=elmts[i].offsetHeight+"px";
	elmts[i].style.background="pink";

	}
}