/**
Learn more 
Please note that GitHub no longer supports Internet Explorer versions 7 or 8.
We recommend upgrading to the latest Internet Explorer, Google Chrome, or Firefox.

If you are using IE 9 or later, make sure you turn off "Compatibility View".
  Sign up Sign in ExploreFeaturesEnterpriseBlog  
This repository  This repository All repositories
   Star 39 Fork 5 public adamjacobbecker/jquery-birdseye     Code  
Issues 
0  
Pull Requests 
0  
Pulse  
Graphs  
Network  
HTTPS clone URL
 
Subversion checkout URL 
You can clone with HTTPS, Subversion, and other methods. 

Clone in Desktop Download ZIP  Plugin for moving-map search, like on Yelp or Airbnb. Built with jQuery and Leaflet.

http://ada.mbecker.cc/jquery-birdseye
 20 commits 2 branches 0 tags 1 contributor CoffeeScript 89.1% JavaScript 10.9% CoffeeScriptJavaScript branch: master Switch branches/tags  Branches Tags gh-pages master Nothing to showNothing to showjquery-birdseye / 
Show File Finder 
specify ajax dataType = "json", fixes #3 

latest commit b893602356 
 adamjacobbecker authored October 12, 2012    css  tweak styles for firefox  October 12, 2012 
  images  adding loading indicator  September 07, 2012 
  js  specify ajax dataType = "json", fixes #3  October 12, 2012 
  README.md  adding loading indicator  September 07, 2012 
  index.html  add ga tracking  August 31, 2012 

 README.md
jQuery Birdseye
A plugin for moving-map search built with jQuery & Leaflet, by @AdamJacobBecker

About
jQuery Birdseye is a plugin for replicating the "search in map" functionality of Yelp/Airbnb/Google using the API of your choosing. With a small bit of setup, you can have the sweet, mapsearchy goodness that these sites do, at a fraction of the cost.

Usage
Live Demo 
While jQuery Birdseye does most of the heavylifting for you, it still needs a decent amount of configuration. For example, search results will be displayed differently for each application, and will need to be customized accordingly.

Simplest example code
HTML:

<div class="birdseye-map"></div>
<div class="birdseye-results"></div>
<div class="birdseye-pagination"></div>
Javascript:

*/

$(function(){
  $(".birdseye-map").birdseye({
    request_uri: 'http://sbadb.herokuapp.com/v1/bizs',
    results_template: function(key, result) {
      return '<div>#'+key+': '+result.name+'</div>';
    }
  });

  $(".birdseye-map").birdseye.update();
});
Documentation
Methods
$("#map").birdseye(options) 
Passed a blank div, initializes birdseye's map in that div.

Options

# Show animated loading bar while waiting for results.
loading_indicator: true

# Initial map lat/lng.
initial_coordinates: [40, -100]

# Intial map zoom.
initial_zoom: 3

# Leaflet tile layer.
tile_layer: 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'

# URI of the API we'll be searching.
request_uri: ''

# The basic geographical parameters we'll be tacking onto each request.
# By default, we use a bounding box to constrain our results.
request_geo_params:
  ne_lat: (map) -> map.getBounds().getNorthEast().lat
  ne_lng: (map) -> map.getBounds().getNorthEast().lng
  sw_lat: (map) -> map.getBounds().getSouthWest().lat
  sw_lng: (map) -> map.getBounds().getSouthWest().lng

# JSON key for the results array.
#
# For example, if our API returns:
#
# {
#    'businesses': [
#       { name: "Tom's tasty tacos" },
#       { name: "Adam's apple pies"}
#    ]
# }
#
# ...then our response_json_key should be 'businesses'.
response_json_key: 'results'

# Getter function for the lat/lng of each result.
# By default, we assume that your object has both a 'latitude' and a 'longitude' property.
response_params_latlng: (result) ->
  [result.latitude, result.longitude]

# Getter functions for the pagination.
# By default, we assume that the response has the following structure:
#
# {
#    meta: {
#        page: 1,
#        per_page: 10,
#        total_pages: 3
#        count: 28
#    }
# }
#
response_params_pagination:
  page: (data) -> data.meta.page
  per_page: (data) -> data.meta.per_page
  total_pages: (data) -> data.meta.total_pages
  count: (data) -> data.meta.count

# Element where we'll be inserting our results.
results_el: $(".birdseye-results")

# A function that returns the HTML string for a single result.
# You're definitely gonna need to customize this one.
results_template: (key, result) ->
  "
  <div># #{key}: #{result['name']}</div>
  "

# Element where we'll be inserting our pagination.
pagination_el: $(".birdseye-pagination")

# A function that returns HTML for the pagination controls.
pagination_template: (pagination) ->
  ...

$("#map").birdseye.setView(latlng, zoom, updateMap = true) 
Sets the map's center and zoom level, and by default, makes an AJAX request to update the results.

$("#map").birdseye.update(new_params) 
Searches the API with new_params and displays the results.

$("#map").change_page(page) 
Switches the currently-dispalyed results page.
     StatusDeveloperTrainingShopBlogAbout© 2013 GitHub, Inc.TermsPrivacySecurityContact   
Something went wrong with that request. Please try again. 