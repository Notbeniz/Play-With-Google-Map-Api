<x-app>
    <div id="map"></div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAg_y672ELCDf2FhP9wBJJqIf99dUkB6vo&callback=initMap&v=weekly"
      async
    ></script>
    <script>
        let infoWindow;
        function initMap() {
          const myLatLng = { lat: 35.7771685822767, lng: 51.4279889389357 };
          var cordinates = @json($cordinates);
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: myLatLng,
          });
          cordinates.forEach((cordinate,index) => {
            new google.maps.Marker({
                position: {lat: cordinate['lat'] ,lng: cordinate['long']} ,
                map,
                label: cordinate['address'],
              });
          })
          const trafficLayer = new google.maps.TrafficLayer();
          trafficLayer.setMap(map);

          infoWindow = new google.maps.InfoWindow();
          const locationButton = document.createElement("button");
          locationButton.textContent = "Find Me";
          locationButton.classList.add("btn", "btn-info", "btn-find-me");
          map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
          locationButton.addEventListener("click", () => {

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
              (position) => {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                  };
                  infoWindow.setPosition(pos);
                  infoWindow.setContent("Location found.");
                  infoWindow.open(map);
                  map.setCenter(pos);
                  console.log(pos);
                window.location.href = "/direction?lat="+pos.lat+"&lng="+pos.lng;
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }
          });
        }
  </script>
</x-app>
