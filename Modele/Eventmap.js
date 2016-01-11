var geocoder;
var map;


function Eventmap(listeadresse, lieu)
{
geocoder = new google.maps.Geocoder();
var latlng = new google.maps.LatLng(0,0);
var mapOptions = 
	{
		zoom: 12,
		center: latlng
	}

map = new google.maps.Map(document.getElementById("map"), mapOptions);
  
  	geocoder.geocode( { 'address': lieu}, function(results, status) 
	{
		if (status == google.maps.GeocoderStatus.OK) 
		{
			map.setCenter(results[0].geometry.location);
			for(var i=0; i<listeadresse.length;i++){	
				geocoder.geocode( { 'address': listeadresse[i]}, function(results2, status){
					var marker = new google.maps.Marker({
						map: map,
						position: results2[0].geometry.location,
						animation: google.maps.Animation.DROP,
						
					});
				map.setCenter(results2[0].geometry.location);
				google.maps.event.addListener(marker,'click',function() {
			map.setZoom(15);
			map.setCenter(marker.getPosition());
  });
				})
				
			}
			
		} 
	else {
	alert("Geocode was not successful for the following reason: " + status);
	}
	});
}

function inscriptionevent(Event_id){
        var scriptElement = document.createElement('script');
            scriptElement.src = '../Modele/particip.php?Event_id='+Event_id;
		document.body.appendChild(scriptElement);
		location.reload();
    
}
function noter(note,Event_id){
		var scriptElement = document.createElement('script');
            scriptElement.src = '../Modele/note.php?Event_id='+Event_id+'&note='+note;
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
function supprcom(i_com){
		var scriptElement = document.createElement('script');
            scriptElement.src = '../Modele/suprcom.php?i_com='+i_com;
		document.body.appendChild(scriptElement);
		location.reload();
}

function profpic(){
	var elmts = document.getElementsByClassName('profpic');
	for(var i=0; i<elmts.length;i++){	
	elmts[i].style.width=elmts[i].offsetHeight+"px";

	}
}

function report (type,id){
		var scriptElement = document.createElement('script');
            scriptElement.src = '../Modele/report.php?type='+type+'&id='+id;
		document.body.appendChild(scriptElement);
		location.reload();
		alert("Votre signalement à bien été pris en compte. Nous vous remercions de contribuer au bon fonctionnement du site")
}