var spherical = google.maps.geometry.spherical, 
    bounds = map.getBounds(), 
    cor1 = bounds.getNorthEast(), 
    cor2 = bounds.getSouthWest(), 
    cor3 = new google.maps.LatLng(cor2.lat(), cor1.lng()), 
    cor4 = new google.maps.LatLng(cor1.lat(), cor2.lng()), 
    width = spherical.computeDistanceBetween(cor1,cor3), 
    height = spherical.computeDistanceBetween( cor1, cor4),
    radius = height / 2;

we are looking to create a radius that will fit inside our 
viewport. it would seem that radius should be 1/2 the height of 
the viewport. 

we want our radius to be adjustable so that we can pass it 
to ajax_results to use in our calc. 

ok, there is a simpler way. 

we get the coordinates for top right / bottom right
and this should give us the height of our viewport. 

then we divide that in half to get our "radius" from the center. 
great fun. 



