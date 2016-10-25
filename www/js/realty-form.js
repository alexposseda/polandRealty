$('select').material_select();
$('#form-location-country').on('change', function () {
    var val = $(this).parents('.validate').children('ul').children('.active').children().html();
    geocoder.geocode({'address': val}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(9);
            marker.setPosition(results[0].geometry.location);
        }
    });
});

$('#location-city').on('change', function () {
    var val = $(this).val();
    geocoder.geocode({'address': val}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);
            map.setZoom(12);
        }
    });
});

$('#location-street').on('change', function () {
    var val = $(this).val();
    geocoder.geocode({'address': val}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(18);
            marker.setPosition(results[0].geometry.location);
        }
    });
});