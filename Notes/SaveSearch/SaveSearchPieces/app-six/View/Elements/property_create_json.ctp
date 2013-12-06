<?php

	$form = $search;

	$list = $photo = '';
	$lat_lons = $info_boxes = array( );
	if ( ! empty($properties)) {
		foreach ($properties as $property) {
			$list .= $this->element('prop_list_elem', array('property' => $property));
			$photo .= $this->element('prop_photo_elem', array('property' => $property));

			if ( ! empty($property['Property']['area_latitude']) && ! empty($property['Property']['area_longitude'])) {
				$lat_lons[$property['Property']['id']] = array(
					$property['Property']['area_latitude'],
					$property['Property']['area_longitude'],
				);

				$info_boxes[$property['Property']['id']] = $this->element('prop_map_info_box', array('property' => $property));
			}
		}

		$list = '<ul>'.$list.'</ul>';
		$photo = '<ul>'.$photo.'</ul>';
                $page = $this->element('prop_page_elem', array('property' => $property));
	}
	else {
		$list = $photo = '
			<p>We couldn\'t find any results. Here are some ideas:</p>
			<ul class="searchresult-lists">
				<li>Expand the area of your search.</li>
				<li>Search for a city, address, or landmark.</li>
			</ul>
			
		';
                $page = '';
	}

	$map = compact('lat_lons', 'info_boxes');
	$return_data = json_encode(compact('list', 'photo', 'map', 'form', 'page'));

	if ( ! empty($ajax)) {
		echo $return_data;
	}
	else {
		echo $this->Html->scriptblock('
			var return_data = '.$return_data.';
		');
	}

/*

return_data : {
	list : "list page html",
	photo : "photo page html",
	map : {
		lat_lons : {
			##property_id## : [
				##latitude##,
				##longitude##
			],
			##property_id## : [
				##latitude##,
				##longitude##
			]
		},
		info_boxes : {
			##property_id## : "info box html",
			##property_id## : "info box html"
		}
	},
	form : {
		the submitted form data
	}
}


*/