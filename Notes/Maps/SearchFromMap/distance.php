<?php 
/*
 * some notes. 
 * If we are going to Jekyll Island, we don't really want properties 
 * that are 100 miles away. so we can keep our radius at let's say 40 mi, 
 * then let the maps redraw from that same radius as things get moved around. 
 * 
 * the idea of adjusting the radius to zoom level is over complicating things. 
 * this also eliminates the need to calculate the bounds of our viewport. 
 * we know that we want to measure from the center of the map. 
 * */
?>

<?php 
	/*
	 * further notes
	 * 1 our first results should use the destination field 
	 * to generate our lat lng, and get our markers accordingly. 
	 * 
	 * 2 our next results should use the map bounds to find 
	 * see, here is where the logic falls apart. we do not need to 
	 * be plotting markers 100 miles away from where we are going
	 * by using a set number of miles from our map center, we should 
	 * be good to go.
	 * */
?>
<h1>Get Properties that fall within a radius of lat / lng value</h1>
<?php 
// SOLUTION 1
// find all of the properties that fall in a radius from the 
// center of our viewport

$sql = "SELECT id, ( 3959 * acos( cos( radians( 33.8299446 ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(-84.2654419) ) + sin( radians(33.8299446) ) * sin( radians( latitude ) ) ) ) 
AS distance, latitude, longitude, city, state_id FROM properties
having distance < 50 ORDER BY distance DESC";

//this works: 

$sql2 = "SELECT id, ( 3959 * acos( cos( radians( 33.8299446 ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(-84.2654419) ) + sin( radians(33.8299446) ) * sin( radians( latitude ) ) ) ) 
AS distance, latitude, longitude, city, state_id FROM properties 
WHERE latitude <> '' AND longitude <> '' 
having distance < 50 ORDER BY distance DESC"

?>

<p>
If we want to add WHERE conditions, we can do so as well with this

<?php 
$sql3 = "SELECT id, (3959 * acos( cos( radians(45.20327) ) * cos( radians( latitude ) ) * cos( radians( 23.7806 ) - radians(longitude) ) + sin( radians(45.20327) ) * sin( radians(latitude) ) )) AS distance
FROM properties
WHERE latitude <>''
AND longitude <>''
HAVING distance < 50
ORDER BY distance desc";


$sql4 = "SELECT id, ( 3959 * acos( cos( radians( 33.8299446 ) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(-84.2654419) ) + sin( radians(33.8299446) ) * sin( radians( latitude ) ) ) ) 
AS distance, latitude, longitude, city, state_id FROM properties 
WHERE latitude <> '' AND longitude <> '' 
having distance < 50 ORDER BY distance DESC";

?>

this query would get rid of any results that do not have lat / lng 
entries. nice. 
then if we wanted to go further we could plug all of our criteria into 
this. 
</p>


	<h1>Get Properties that fall within Map Bounds</h1>
	
	
	<?php 
$sql = "SELECT city, latitude, longitude, title FROM properties 
WHERE 
(latitude >= 33.8299446 AND latitude <= 36.33) AND 
(longitude >= -87.265 AND longitude <= -84.2654419)"; 

//this gets everybody
	?>
	now let's see if we can use least and greatest

<?php 
	/*
	 * here is our magic query for search within map bounds. 
	 * it should be able to sort negative and postive long / lat values. 
	 * */


$sql = "SELECT city, latitude, longitude, title FROM properties
WHERE
(latitude >= LEAST(33.8299446, 36.33) AND latitude <= GREATEST(33.8299446, 36.33)) AND
(longitude >= LEAST(-87.265, -84.2654419) AND longitude <= GREATEST(-87.265, -84.2654419));"


$sql = "SELECT city, latitude, longitude, title FROM properties
WHERE
(latitude >= LEAST(33.8299446, 36.33) AND latitude <= GREATEST(33.8299446, 36.33)) 
AND
(longitude >= LEAST(-84.2654419, -87.265) AND longitude <= GREATEST(-84.2654419, -87.265))


'fields' => array(
	'')
	,

'conditions' => 
	array(
		'Property.latitude <>' => '',
		'AND'=> array(
		'Property.longitude <>' => ''),
		'AND' => array(
		'Property.latitude >=' => array('LEAST' => array($ne_lat, $sw_lat))),
		'AND' => array(
		'Property.latitude <=' => array('GREATEST' => array($ne_lat, $sw_lat))),
		'AND' => array( 
		'Property.longitude >=' => array('LEAST' => array($ne_lat, $sw_lat))),
		'AND' => array(
		'Property.longitude <=' => array('GREATEST' => array($ne_lat, $sw_lat))), 
		),
 
	
),
?>	
	
	
<?php 
// SOUTION 2 
// find all of the properties that fall within the rectangle of 
// our viewport

/*
	not really. people are not seeking a store that sells marine parts 
	for Rolls Royce engines, regardless of location. 
	
	they are trying to find accomodations at a specific location. 
	then if they don't have what they are looking for, they'll 
	want to broaden or narrow their search. 
	
	our stakeholders however are wanting "the kitchen sink". 
	which produces a lot of relevant information. 
	
	
	to that end, how do we find all of the locations that match our 
	bounds?
*/
?>
	<h3>Get all of the properties within our bounding box</h3>
<?php 

	$map_ne = "38.90161393554903,-70.8573690895916";
	$map_sw = "	23.33456403809711,-90.2811972145916";
	$map_ne_lat = $map_ne[0];
	$map_ne_lng = $map_ne[1];

	$map_sw_lat = $map_sw[0];
	$map_sw_lng = $map_sw[1];
	
	/*
	 * here is another way
	 * */
?>
	<script>
var map_ne_lat = map.getBounds().getNorthEast().lat();
var map_ne_lng = map.getBounds9).getNorthEast().lng();

var map_sw_lat = map.getBounds().getSouthWest().lat();
var map_sw_lng = map.getBounds().getSouthWest().lng();

	</script>
	
	So in our calculations, we want to use the lowest of each 
	compared to the highest of each. 
	
	well, let's see:
	
	decatur ga
	33.8299446, -84.2654419
	
	this doesn't quite work.
	
SELECT city, latitude, longitude, title FROM properties
WHERE latitude BETWEEN least(33.8299446, 36.33) AND greatest(33.8299446, 36.33)
AND  longitude BETWEEN least(-87.265, -84.2654419) AND greatest(-87.265, -84.2654419)	
	
SELECT city, latitude, longitude, title FROM properties 
WHERE latitude BETWEEN LEAST( 33.8299446, 36.33 ) AND GREATEST( 33.8299446, 36.33 ) 
AND longitude BETWEEN LEAST( -87.265, -84.2654419 ) AND GREATEST( -87.265, -84.2654419 )

this does not produce our properties, although their long IS between the values!
SELECT city, latitude, longitude, title FROM properties 
WHERE longitude BETWEEN LEAST( -87.265, -84.2654419 ) AND GREATEST( -87.265, -84.2654419 )

SELECT city, latitude, longitude, title FROM properties 
WHERE 
(latitude >= 33.8299446 AND latitude <= 36.33) AND 
(longitude >= -87.265 AND longitude <= -84.2654419) 

this gets everybody


	
SELECT *
FROM `properties`
WHERE latitude between 33.8299446 AND 36.33
AND longitude between -87.265 AND -84.2654419 

for the BETWEENs to work, we need the smallest number first.
if the first number is greater, the BETWEEN does not work.  


SELECT *
FROM `properties`
WHERE latitude between 33.8299446 AND 36.33
AND longitude >= -87.265 AND longitude <= -84.2654419 

SELECT *
FROM `properties`
WHERE latitude between 33.8299446 AND 36.33
AND longitude between -87.265 AND -84.2654419


SELECT *
FROM `properties`
WHERE latitude between 36.33 and 33.8299446



SELECT *
FROM `properties`
WHERE latitude >= 33.8299446 AND latitude <= 36.33

this gets our properties, but if we add the long, they disappear
	
	
lat / lng 	33.8299446, -84.2654419
	36.33, -87.265
	
ne 38.90161393554903,-70.8573690895916
sw 23.33456403809711,-90.2811972145916

these are not for decatur ga, they are for salt lake city ut

SELECT *
FROM `properties`
WHERE latitude >= 23.33456403809711 AND latitude <= 38.90161393554903
AND longitude >= -70.8573690895916 AND longitude <= -90.2811972145916

our map is only generating the long lat values for salt lake city. 
it is not using Google API to retrieve nw_ and se_ bounds. 

so that needs to be fixed as well. 
	
	salt lake city
	
ne	38.90161393554903,-70.8573690895916
sw	23.33456403809711,-90.2811972145916

SELECT *
FROM `properties`
WHERE latitude >= 23.33456403809711 AND latitude <= 38.90161393554903
AND longitude >= -70.8573690895916 AND longitude <= -90.2811972145916

/* this should work, but it looks like we have 
a bunch of bogus data in our db. */
SELECT *
FROM `properties`
WHERE latitude >= 23.33456403809711 AND latitude <= 38.90161393554903
AND longitude >= -70.8573690895916 AND longitude <= -90.2811972145916

let's try this for our decatur properties




SELECT *
FROM `properties`
WHERE latitude <= 38.90161393554903 AND longitude >= -70.8573690895916
AND latitude >= 23.33456403809711 AND longitude <= -90.2811972145916	
<?php 
$sql = "SELECT *
FROM `properties`
WHERE latitude BETWEEN 23.33456403809711 AND latitude < 38.90161393554903
AND longitude BETWEEN -70.8573690895916 AND longitude < -90.2811972145916";


//	To get all the points one by one : alert(map.getBounds().getNorthEast().lat()); alert(map.getBounds().getNorthEast().lng()); alert(map.getBounds().getSouthWest().lat()); alert(map.getBounds().getSouthWest().lng());

$sql = "SELECT *
FROM `properties`
WHERE latitude >= lat0 AND latitude <= lat1 
AND longitude >= lng0 AND longitude <= lng1";


//SELECT * FROM properties WHERE latitude BETWEEN a AND < c AND lng between b AND < d

?>