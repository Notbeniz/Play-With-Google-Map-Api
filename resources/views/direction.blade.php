<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Direction</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>

html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#container {
  height: 100%;
  display: flex;
}

#sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#map {
  flex-basis: 0;
  flex-grow: 4;
  height: 100%;
}
    </style>
</head>
<body>
    <div id="container">
        <div id="map"></div>
        <div id="sidebar">
          <p>Total Distance: <span id="total"></span></p>
          <div id="panel"></div>
        </div>
      </div>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg_y672ELCDf2FhP9wBJJqIf99dUkB6vo&callback=initMap&v=weekly"
      async
    ></script>

    <script>
    function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center:{ lat: 35.7771685822767, lng: 51.4279889389357 }, // Australia.
  });
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer({
    draggable: true,
    map,
    panel: document.getElementById("panel"),
  });

  var ways = @json($locations);
  const waypts = [];
  for(let i = 0 ; i<ways.length ; i++) {
    
    var origin = ways[0]["address"];
    var destination = ways[10]["address"];
    waypts.push({
        location: ways[i]["address"],
    });
  }
  directionsRenderer.addListener("directions_changed", () => {
    const directions = directionsRenderer.getDirections();

    if (directions) {
      computeTotalDistance(directions);
    }
  });
  displayRoute(
    origin,
    destination,
    directionsService,
    directionsRenderer,
    waypts
    );
  }
function displayRoute(origin, destination, service, display, waypts) {
  service
    .route({
      origin: origin,
      destination: destination,
      waypoints: waypts,
      travelMode: google.maps.TravelMode.DRIVING,
      avoidTolls: true,
    })
    .then((result) => {
      display.setDirections(result);
    })
    .catch((e) => {
      alert("Could not display directions due to: " + e);
    });
}

function computeTotalDistance(result) {
  let total = 0;
  const myroute = result.routes[0];

  if (!myroute) {
    return;
  }

  for (let i = 0; i < myroute.legs.length; i++) {
    total += myroute.legs[i].distance.value;
  }

  total = total / 1000;
  document.getElementById("total").innerHTML = total + " km";
}
    </script>

</body>
</html>