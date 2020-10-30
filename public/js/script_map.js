$(document).ready(function(){
	//var coordRef=firebase.database().ref();
	//var database=firebase.database();

    
   var map=new google.maps.Map(document.getElementById('map'),{
      center: {lat:31.669746,lng:-7.973328},
      scrollwheel:false,
      zoom:8
    });


   // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyC6wQgLbs4KRb4YAZk_tksPfLK1m84h7oU",
    authDomain: "bus-tracer.firebaseapp.com",
    databaseURL: "https://bus-tracer.firebaseio.com",
    projectId: "bus-tracer",
    storageBucket: "bus-tracer.appspot.com",
    messagingSenderId: "522512505697",
    appId: "1:522512505697:web:10da31828093ce9c028320",
    measurementId: "G-N6YRMGZ5D6"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  
  var database = firebase.database();
  var ref=database.ref("locations");  //database name 




/**
   getting values from Bus positions (bus's circulation)
**/
    var myLatLng;      //using for bus coordinates
    var previousMarker; // global variable to store previous marker

    //take a snapshot all the time to get real time coordinates from firebase database
    ref.on('value',   function(snapshot) { 
    snapshot.forEach(function(childSnapshot) {
      var childKey = childSnapshot.key;        //name of the bus 
      var childData = childSnapshot.val();
      

      var locWindow=childKey+"<br/>"+childData.latitude+","+childData.longitude;   //var for locWindow
      myLatLng = {lat: childData.latitude, lng: childData.longitude};
      // if the previousMarker exists, remove it
     /* if (previousMarker)
        previousMarker.setMap(null);*/
        
      AddBus(myLatLng,locWindow);
  });
});





/**
getting values from lignes entries (routes)
**/
    var refLigne=database.ref('Ligne');
    
    var directionsService = new google.maps.DirectionsService();

//lecture from BD 
refLigne.on('value',   function(snapshot) { 
    snapshot.forEach(function(childSnapshot) {
      var childKey = childSnapshot.key;         // id of the row 
      var childData = childSnapshot.val();

      AddLigne(childData);  
  });
});


////////////////
var refArret_Ligne=database.ref('arretLigne');


   var refArret_=database.ref('Arrets');

//var path=[{lat:31.646458,lng:-8.020126},{lat:31.639900,lng:-8.023076},{lat:31.642384,lng:-8.026574},{lat:31.644558,lng:-8.023881}];
waypoints = Array();
refArret_Ligne.on('value', function (snapshot) {
    snapshot.forEach(function (data) {
      var fk_arret=data.val().idA;
      refArret_.child(fk_arret).on('value',function (data) {
               //waypoints.push({lat: parseFloat(data.val().lat), lng: parseFloat(data.val().long) });

          });

    });
});
// console.log(path);
 


//if (routes.length!=0){ 31.648622, -8.020523
var path=[{lat:31.648622,lng: -8.020523},{lat:31.644447,lng:-8.023477}];

  var flightPath = new google.maps.Polyline({                 
                path: path,    //collection of buses station 
                geodesic: true,
                strokeColor: '#000000',   //color for the route
                strokeOpacity: 1.0,
                strokeWeight: 2,
                map: map,
                bounds: map.getBounds()
            });
  console.log("greaaaat");
flightPath.setMap(map);   //set the map with the route
/*}
else {
  console.log("noooooooo");
}*/
////////////////////  



/**
getting values from lignes entries (routes)
**/
    var refArret=database.ref('Arrets');
    
    var directionsService = new google.maps.DirectionsService();

//lecture from BD 
refArret.on('value',   function(snapshot) { 
    snapshot.forEach(function(childSnapshot) {
      var childKey = childSnapshot.key;        // id of the row 
      var childData = childSnapshot.val();

      var latlong= {lat: parseFloat(childData.lat), lng: parseFloat(childData.long)};  

      var locWindow=childData.libelle_arret+"<br/>"+childData.lat+","+childData.long;   //var for locWindow
      
     AddArret_bus(latlong,locWindow); 
  });
});






/**
function to add buses icons using coordinates
**/

function AddBus(Coordinates,label_marker) {

    var icon = { // car icon
        path: 'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
        scale: 0.4,
        fillColor: "#000000", //<-- Car Color, you can change it 
        fillOpacity: 1,
        strokeWeight: 1,
        anchor: new google.maps.Point(0, 5),
    };



    var marker = new google.maps.Marker({
        position: Coordinates,
        icon: icon,
        //label:label_marker,
        map: map
    });


    // infoWindows are the little helper windows that open when you click
    // or hover over a pin on a map. They usually contain more information
    // about a location.
    addInfoWindow(marker, label_marker);

}


/**
function to add buses icons using coordinates
**/

function AddArret_bus(Coordinates,label_marker) {

    var pinColor = "dd99ba";    //even it's an hexa color but it works
    var marker = new google.maps.Marker({
        position: Coordinates,
        //fillColor: pinColor,
        icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|'+pinColor,
        size: new google.maps.Size(1,1),
        map: map
    });


    // infoWindows are the little helper windows that open when you click
    // or hover over a pin on a map. They usually contain more information
    // about a location.
   addInfoWindow(marker, label_marker);

}





/**
function to add routes icons using coordinates
**/
function AddLigne(route){
  var directionsService = new google.maps.DirectionsService();

    var request = {
      origin: route.origin,
      destination: route.destination,
      travelMode: google.maps.TravelMode.DRIVING
    };
   

   var symbolOne = {
    path: "M -2,0 0,-2 2,0 0,2 z",
    strokeColor: "#F00",
    fillColor: "#F00"
    
  };

  var symbolTwo = {
    path:
     google.maps.SymbolPath.CIRCLE,
    strokeColor: "#00F"
    
  };  

    var directionsDisplay = new google.maps.DirectionsRenderer({
    polylineOptions: {
      strokeColor: route.color,
      strokeWeight:route.strokeWeight,
     icons: [
      {
        icon: symbolOne,
        offset: "0%",

        strokeWeight: 0.5
      },
      {
        icon: symbolTwo,
        offset: "100%",
        strokeWeight: 0.5
      }]


    }
  });

    directionsDisplay.setOptions({suppressMarkers: true});
    directionsDisplay.setMap(map);

    directionsService.route(request, function(result, status) {
      

      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(result);
      }
    });
}




/**
InfoWindow for markers
**/
function addInfoWindow(marker, content) {
    var infoWindow = new google.maps.InfoWindow({
        content: content
    });

    google.maps.event.addListener(marker, 'click', function () {
        infoWindow.open(map, marker);
    });
}    




});