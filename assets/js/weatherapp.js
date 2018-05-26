var placeSearch, autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('autocomplete')),
        {types: ['geocode']});
    autocomplete.addListener('place_changed', fillInForm);
}
function fillInForm() {
    var place = autocomplete.getPlace();
    document.getElementById('city').value = place.name;
    document.getElementById('longitude').value = place.geometry.location.lng();
    document.getElementById('latitude').value = place.geometry.location.lat();
}
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}