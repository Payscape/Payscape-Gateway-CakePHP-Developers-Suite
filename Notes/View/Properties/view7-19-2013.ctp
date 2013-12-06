<?php 
	//echo "<pre>";
	//print_r($property['PropertyImage']);
	//echo "</pre>";
	//exit();
	//$property_id = $property['PropertyImage']['property_id'];
?>
<?php 
$this->Html->script(array(
	//	'properties/properties'
), array('inline' => false));

?>
<?php $this->Html->css('jcarousel.css', null, array('inline' => false)); ?>
<?php $this->Html->css('iphone', null, array('inline' => false));?>

<?php $this->Html->script('https://maps.googleapis.com/maps/api/js?key=AIzaSyDLnnQUaavOoVb6xTlQhDEswKay4RwqyKM&sensor=false&libraries=places,geometry', array('inline' => false)); ?>
<?php $this->Html->script(array('map.js'), array('inline' => false)); ?>
<?php //$this->Html->script(array('galleria-1.2.8.js', 'jquery.jcarousel.min.js'), array('inline' => false)); ?>
<?php $this->Html->script(array('galleria-1.2.9.js', 'jquery.jcarousel.min.js'), array('inline' => false)); ?>

<?php $this->Html->script('iphone-style-checkboxes', array('inline' => false));?>

<?php $this->Html->scriptblock('
    var VIEW_PAGE = true;
    var dates = '.json_encode(ife($dates, array('start' => false, 'end' => false))).';
', array('inline' => false)); 
?>

<?php

    $visibility_bar = ( ! empty($_SESSION['Auth']['User']['id']) && ($_SESSION['Auth']['User']['id'] == $property['Property']['user_id']));
    if (empty($property['Property']['property_type_id'])
       || empty($property['Property']['description'])
       || empty($property['Property']['address'])
       || empty($property['Property']['zip'])
       || empty($property['Property']['area_latitude'])
       || empty($property['Property']['area_longitude'])
       || empty($property['Property']['state_id'])
       || empty($property['Property']['daily_rate'])
       || empty($property['PropertyImage'][0]['image']['main'])
     ) {
        $visibility_bar = false;
     }

?>

<?php echo $this->Html->scriptblock(' var property_id = '.$property['Property']['id'].'; ', array('inline' => false)); ?>

<div class="productlanding-page">
    <div class="productpage-header">
        <div class="left">
<!-- <a href="searches/results/<?php echo $currentpage; ?>" class="blue-btn-sm"><strong>Back to Search</strong></a> -->
<?php echo $this->Html->image('blue-back-arr.png', array('width' => '7', 'height' => '13', 'class' => 'vm')); ?>
&nbsp; 
	<?php echo $this->Html->link('Back to Search', array('controller'=>'searches', 'action'=>'results', 'page'=>$currentpage), array('class'=>'blue-btn-sm'))?>
      </div>
        <div class="right">
            <ul class="social-bar-listing">
                <li><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $property_plugin_url; ?>" data-count="none"><?php echo __('Tweet'); ?></a></li>
                <li><a href="http://pinterest.com/pin/create/button/?url=<?php echo $property_plugin_url; ?>" class="pin-it-button" count-layout="none"><img src="//assets.pinterest.com/images/PinExt.png" alt="Pin it" /></a>
                    <?php $this->Html->script('http://assets.pinterest.com/js/pinit.js'); ?></li>
                <li><div class="g-plusone" data-size="medium" data-annotation="none" data-href="<?php echo $property_plugin_url; ?>"></div></li>
                <li><a href="mailto:?subject=Share+<?php echo urlencode($property['Property']['title']); ?>&amp;body=<?php echo $property_plugin_url; ?>"><?php echo $this->Html->image('mail-icon.png', array('width' => '29', 'height' => '20')); ?></a></li>
                <li><div class="fb-like" data-href="<?php echo $fb_like_url_for_layout; ?>" data-send="false" data-width="450" data-show-faces="false" layout="button_count"></div></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <h1>
            <?php echo $property['Property']['title']; ?>
            <span><?php echo $property_short_info; ?></span>
        </h1>

        <div class="visibility-wrapper">
        <?php
            if ($visibility_bar) {
                echo '<div class="visibility-text">';
                echo 'Visibility:';
                echo '</div>';
                echo '<div class="visibility-box-float">';
                echo $this->Form->input('visible', array(
                    'type' => 'checkbox',
                    'label' => false ,
                    'class' => 'listing_visibility',
                    'checked' => $property['Property']['published'],
                    'rel' => $property['Property']['id']
                ));
                echo '</div>';
            }
        ?>
        </div>

        <div class="plain-border-box-prop" align="right">
            <?php if ( ! empty($_SESSION['Auth']['User']['id']) && ($_SESSION['Auth']['User']['id'] == $property['Property']['user_id'])) {
                echo $this->Html->link('Edit Listing', array('controller' => 'properties', 'action' => 'create', 'basic', $property['Property']['id']));
            } ?>
        </div>

        <div class="product-content">
            <div class="product-tabs" id="ddpagetabs">
                <ul>
                    <li>
                        <?php
                            echo $this->Html->link(
                                'Photos <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'photos', 'onclick' => "loadTabs1('photos');", 'class' => 'current', 'escape' => false)
                            );
                        ?>
                    </li>
                    <li>
                        <?php
                        if ( ! empty($property['Property']['area_latitude']) && ! empty($property['Property']['area_longitude']) && ! empty($property['Property']['area_radius'])) {
                            echo $this->Html->link(
                                'Maps <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'maps', 'onclick' => "loadTabs1('maps');refresh_map( );", 'escape' => false)
                            );
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                            echo $this->Html->link(
                                'Calendar <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'calendars', 'onclick' => "loadTabs1('calendars');", 'escape' => false)
                            );
                        ?>
                    </li>
                </ul>
            </div>
            <div class="wishlist-listing-button">
                <?php
                    $class = array('disabled', 'wishlist-btn');
                    $url = array('controller' => 'users', 'action' => 'login');

                    if ( ! empty($_SESSION['Auth']['User']['id'])) {
                        unset($class[0]);

                        if (in_array($property['Property']['id'], $wishlisted_ids)) {
                            $class[] = 'inactive';
                            $url = '#';
                        }
                        else {
                            $url = array('controller' => 'wishlistitems', 'action' => 'add', $property['Property']['id']);
                            $class[] = 'thickbox';
                        }
                    }

                    echo $this->Html->link(
                        $this->Html->tag('span', 'Add to wishlist'),
                        $url,
                        array('class' => implode(' ', $class), 'escape' => false)
                    );
                ?>
            </div>
            <div class="product-tab-data">
				<div id="sc1">
					<div class="padder product-photos relative">
					<?php echo $this->Html->image('vacationfish-tag.png', array('style' => 'position:absolute; top:46px; right: 25px; z-index:1000;')); ?>
                        <div id="vFishPhotosGallery">
                        <?php
                            if ( ! empty($property['PropertyImage'][0]['image'])) {
                                foreach( $property['PropertyImage'] as $image ) {

//    $main_image = Router::url('/', true).'img/'.my_ife( $image['image']['main'], 'manage_missing.png' );
                                	                                
	  $main_image = Router::url('/', true) .'img/files/'. $image['property_id'] . '/images/' . my_ife( $image['image'], 'manage_missing.png' );
                                    if ( ! empty($image['name'])) {
                                    	
//  echo $this->Html->link(  $this->Html->image( my_ife($image['image']['thumb'], 'manage_missing.png'), array('data-title' => $property['Property']['title'], 'data-description' => $image['name'], 'alt' => '')), $main_image, array('escape' => false) );
	echo $this->Html->link(	 $this->Html->image( 'files/'. $image['property_id'] . '/images/' . my_ife( $image['image'], 'manage_missing.png'), array('data-title' => $property['Property']['title'], 'data-description' => $image['name'], 'alt' => '')), $main_image, array('escape' => false) );

                                    }
                                    else {
// echo $this->Html->link(  $this->Html->image( my_ife($image['image']['thumb'], 'manage_missing.png'), array('alt' => '')), $main_image, array('escape' => false) );
                                    		
   echo $this->Html->link( $this->Html->image( 'files/'. $image['property_id'] . '/images/' . my_ife( $image['image'], 'manage_missing.png'), array('alt' => 'Vacation Fish premium listing')), $main_image, array('escape' => false) );
                                    }
                                }
                            } // ! empty
                            else {
        echo $this->Html->image('main_missing.png');
                            }
                        ?>
                        </div>    
					</div>
				</div>
                <div id="sc2" class="tab-content">
                    <div class="padder" align="center">
                        <div class="map_canvas" id="map_canvas" style="width:650px;height:459px;"></div>
                    </div>
                </div>
                <?php
                    $circle = array(0, 0);

                    if ( ! empty($property['Property']['area_latitude'])) {
                        $circle = array(
                            $property['Property']['area_latitude'],
                            $property['Property']['area_longitude'],
                            $property['Property']['area_radius']
                        );
                    }

                    echo $this->Html->scriptblock('
                        var circle_opts = '.json_encode($circle).';
                        var center = new google.maps.LatLng(parseFloat(circle_opts[0]), parseFloat(circle_opts[1]));

                        // create our map
                        var mapOptions = {
                            zoom: 12,
                            center: center,
                            mapTypeId: google.maps.MapTypeId.ROADMAP // HYBRID for satellite
                        };

                        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

                        if ("undefined" != typeof circle_opts[2]) {
                            var circle = new google.maps.Circle({
                                map: map,
                                center: center,
                                radius: parseInt(circle_opts[2]),
                                strokeWeight: 0.5,
                                fillColor: "FF867C"
                            });
                        }

                        function refresh_map( ) {
                            google.maps.event.trigger(map, "resize");
                            map.setCenter(center);
                        }
                    ');
                ?>

                <div id="sc3" class="tab-content">
                    <div class="filter-row-top">
                        <div class="inline-block1">
                            Enter Dates:
                        </div>
                        <div class="inline-block-cal">
                            <?php echo $this->Form->input('start_date', array('type' => 'text', 'label' => 'Check in', 'class' => 'datepicker start_val')); ?>
                        </div>
                        <div class="inline-block-cal">
                            <?php echo $this->Form->input('end_date', array('type' => 'text', 'label' => 'Check out', 'class' => 'datepicker end_val')); ?>
                        </div>
                        <div class="inline-block1">
                        <!-- 
                            or Use Interactive Calendar to Calculate, 
                            <br><span style="color:#c0c0c0">Mouse over Check In date, Click on Check Out date.</span>
                             -->
                          <!-- bof: clear feature -->
                            <br><a href="<?php echo $base_url; ?>/properties/view/<?php echo $selected_id; ?>"><button class="blue-btn-sm">Clear</button></a>
                            <!-- eof: clear feature -->
                    </div>
                    </div>
                    <hr class="sexy"/>
                    <div class="padder">
                        <div id="availability_dates">
                        <h3>Availability Calendar</h3>
                            <ul class="calendars">
                        <?php
                            for ($i = 0; 24 > $i; ++$i) {
                                list($mo, $yr) = explode('-', date('m-Y', strtotime('+'.$i.' months')));
                                echo '<li>'.$this->element('calendar', array('mo' => $mo, 'yr' => $yr, 'reserved' => $reservations, 'small' => false, 'last' => (23 <= $i), 'links' => false, 'js' => true)).'</li>';
                            }
                        ?>
                            </ul>
                            <!-- bof: clear feature -->
                            <!--  
                            <br><a href="<?php //echo $base_url; ?>/properties/view/<?php echo $selected_id; ?>"><button class="blue-btn-sm">Clear</button></a>
                            -->
                            <!-- eof: clear feature -->
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>

                    <?php echo $this->Html->scriptblock('
                        jQuery("ul.calendars").jcarousel({
                            scroll: 1
                        });
                    '); ?>

                    <div class="discount-row">
                        <ul>
                        <?php if( ! empty($property['Discount'])) : ?>
                            <li class="multinight-flag"><span class="calc_discount">$0.00</span></li>
                        <?php endif; ?>
                            <li style="float: right;padding: 5px 10px;"><?php echo $this->Html->link(__('EMAIL HOST'), array('controller' => 'properties', 'action' => 'contact_me', $property['Property']['id']), array('class' => 'sm-white-btn thickbox')); ?></li>
                            <li style="float: right;">TOTAL: <span class="calc_subtotal discount-values">$0.00</span></li>
                            <li style="float: right;">Price: <span class="calc_pernight discount-values">$0.00</span>/night</li>
                            <li style="float: right;">Nights: <span class="calc_nights discount-values">0</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear">&nbsp;</div>

            <div class="product-tabs" id="ddpagetabs2">
                <ul>
                    <li>
                        <?php
                        echo $this->Html->link(
                                'Description <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'description', 'onclick' => "loadTabs2('description');", 'class' => 'current', 'escape' => false)
                            );
                        ?>
                    </li>
                    <li>
                        <?php
                        if (!empty($selected_amenities)) :
                            echo $this->Html->link(
                                    'Amenities <span class="arr"></span>',
                                    "javascript:void(0);",
                                    array('id' => 'amenities', 'onclick' => "loadTabs2('amenities');", 'escape' => false)
                            );
                        endif;
                        ?>
                    </li>
                    <?php if(isset($property['Property']['house_rules']) && $property['Property']['house_rules'] !='') { ?>
                    <li>
                        <?php
                        echo $this->Html->link(
                                'House Rules <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'house-rules', 'onclick' => "loadTabs2('house-rules');", 'escape' => false)
                            );
                        ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="product-tab-data">
                <div id="d-sc1">
                    <div class="prod-desc-cnt">
                        <div class="details">
                            <p><?php echo nl2br($property['Property']['description']); ?></p>
                        </div>
                        <div class="features">
                            <div class="row alt-row"> <span class="lbl"><?php echo __('Room Type:'); ?></span> <span class="value"><?php echo $property['PropertyType']['name']; ?></span> </div>
                            <div class="row"> <span class="lbl"><?php echo __('Accommodates:'); ?></span> <span class="value"><?php echo $property['Property']['sleeping_capacity']; ?></span> </div>
                            <div class="row alt-row"> <span class="lbl"><?php echo __('Bedrooms:'); ?></span> <span class="value"><?php echo $property['Property']['bedrooms']; ?></span> </div>
                            <div class="row"> <span class="lbl"><?php echo __('Bathrooms:'); ?></span> <span class="value"><?php echo $property['Property']['bathrooms']; ?></span> </div>
                            <div class="row alt-row"> <span class="lbl"><?php echo __('Country:'); ?></span> <span class="value"><?php echo $property['Country']['name']; ?></span> </div>
                            <div class="row"> <span class="lbl"><?php echo __('Size:'); ?></span> <span class="value"><?php echo number_format($property['Property']['square_footage']); ?> sq.ft.</span> </div>
                        </div>
                    </div>
                </div>

                <div id="d-sc2" class="tab-content amenities-cnt">
                    <div class="view-aminities">
                        <?php
                        if (count($amenities_list) > 0) {
                            $i = 0;
                            $open = false;
                            foreach ($amenities_list as $amenity) {
                                if(!in_array($amenity['Amenity']['id'], $selected_amenities)) {
                                    continue;
                                }
                                $list_cls = ((0 === (int) floor(($i % 6) / 3)) ? ' odd-row' : '');

                                if (0 == ($i % 3)) {
                                    if ($open) {
                                        echo '</div>';
                                        $open = false;
                                    }

                                    echo '<div class="row'.$list_cls.'">';
                                    $open = true;
                                }

                                switch ($i % 3) {
                                    case 1 : $label_cls = 'second'; break;
                                    case 2 : $label_cls = 'third'; break;
                                    case 0 : default : $label_cls = 'first'; break;
                                }
                        ?>
                                <label class="<?php echo $label_cls; ?>">
                                    <?php echo $amenity['Amenity']['name']; ?>
                                    <span class="help">
                                        <?php //echo $this->Html->image('help-icon.png', array('alt' => '')); ?>
                                    </span>
                                </label>
                        <?php
                                ++$i;
                            }

                            if ($open) {
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="d-sc3" class="tab-content house-rules">
                <div class="padder">
                    <div class="row">
                        <p><?php echo nl2br(strip_tags($property['Property']['house_rules'])); ?></p>
                    </div>
                </div>
            </div>

            <div class="clear">&nbsp;</div>
<?php
// commented out until 1.6
if (0) { ?>

            <div class="product-tabs" id="ddpagetabs3">
                <ul>
                    <li>
                        <?php
                        echo $this->Html->link(
                                'Reviews <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'reviews', 'onclick' => "loadTabs3('reviews');", 'escape' => false)
                            );
                        ?>
                    </li>
                    <?php if( ! empty($property['Property']['house_rules'])) { ?>
                    <li>
                        <?php
                        echo $this->Html->link(
                                'House Rules <span class="arr"></span>',
                                "javascript:void(0);",
                                array('id' => 'rules', 'onclick' => "loadTabs3('rules');", 'escape' => false)
                            );
                        ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="product-tab-data">
                <div id="r-sc1">
                    <div class="review-header">
                        <div class="review-tag">
                            <?php echo __('OVERALL GUEST'); ?> <br><?php echo __('SATISFACTION'); ?><br>
                            <?php
                            for($i = 1; $i <= 5; $i++) {
                                if($i <= round($property_rating['overall'])) {
                                    echo $this->Html->image('star-yellow.png', array('alt' => ""));
                                } else {
                                    echo $this->Html->image('star-gray.png', array('alt' => ""));
                                }
                            }
                            ?>
                        </div>

                        <div class="inline-block" style="width:500px; margin-right: 0;">
                            <ul  class="rating-list">
                            <?php
                            unset($property_rating['overall']);
                            foreach($property_rating as $indivisual_rating) {
                                ?>
                                    <li class="row">
                                        <span class="lbl"><?php echo $indivisual_rating['name']; ?></span>
                                        <?php
                                        for($j = 1; $j <= 5; $j++) {
                                            if($j <= round($indivisual_rating['rating'])) {
                                                echo $this->Html->image('star-yellow.png', array('alt' => ""));
                                            } else {
                                                echo $this->Html->image('star-gray.png', array('alt' => ""));
                                            }
                                        }
                                        ?>
                                    </li>
                                <?php
                            }

                            foreach($rating_types as $rating_type) {
                                ?>
                                <li class="row">
                                    <span class="lbl"><?php echo $rating_type['RatingType']['name']; ?></span>
                                    <?php
                                    for($i = 1; $i <= 5; $i++) {
                                        echo $this->Html->image('star-gray.png', array('alt' => ""));
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                            </ul>
                        </div>
                    </div>

                    <ul class="review-list">

                    <?php foreach($property['Review'] as $review) { ?>

                        <li>
                            <div class="thumb">

                            <?php
                                if ( ! empty($review['User']['fb_image'])) {
                                    echo $this->Html->image($review['User']['fb_image']['comment'], array('width' => 68, 'height' => 68));
                                }
                                elseif ( ! empty($review['User']['facebook_id'])) {
                                    echo $this->Facebook->picture($review['User']['facebook_id'], array('facebook-logo' => 0, 'size' => 'large'));
                                }
                                else {
                                    echo $this->Html->image('no_user.jpg', array('width' => 68, 'height' => 68));
                                }
                            ?>

                            </div>
                            <div class="desc"><?php echo $review['comments']; ?></div>
                        </li>

                    <?php } ?>

                    </ul>
                </div>

                <div id="r-sc2" class="tab-content">
                    <div class="padder">
                        <div class="row">
                            <p><?php echo nl2br(strip_tags($property['Property']['house_rules'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
// end commented out
} ?>


    </div>
    <div class="product-sidebar">
    <!--            <div align="right"><?php echo $this->Html->link(__('See Reviews'), '#reviews', array('class' => 'view-link')); ?></div> -->
                <?php if ( ! empty($property['Discount'])) : ?>
                <div class="multi-offer">
                    Multi-Night Discount
                    <?php foreach($property['Discount'] as $discount){ ?>
                   <br><strong>Nights Booked:</strong>  <?php echo $discount['lower_bound']; ?> <strong> = <?php echo $discount['discount']; ?> % off </strong>
                    <?php } ?>
                </div>
                <?php endif; ?>
                <div class="booking-box">
                    <div class="padder"> <?php echo __('From'); ?><br>
                        <span class="price" style="float: left;display: inline;"> $<?php echo number_format($property['Property']['daily_rate']); ?></span>
                        <span style="font-size:12px;float: left;display: inline;margin: 14px 0 0 5px;">Per Night</span>
                    </div>

                    <div class="padder">
                        <div align="center" class="listing-availibility">
                            <?php echo $this->Html->link('CHECK AVAILABILITY', array('controller' => 'properties', 'action' => 'contact_me', $property['Property']['id'], '?' => 'width=500&height=515'), array('class' => 'pink-btn thickbox cal_update', 'id' => 'check_it')); ?>
                        </div>
                        <?php echo $this->Html->scriptblock('
                            $("#check_it").on("click", function(evt) {
                                if ( ! $("#sc3").is(":visible")) {
                                    loadTabs1("calendars");
                                    return false;
                                }
                                else if (("" == $("#start_date").val( )) || ("" == $("#end_date").val( ))) {
                                    alert("Please select Check-in and Check-out dates");
                                    return false;
                                }
                            });
                        '); ?>
                    </div>
                </div>

                <div class="plain-border-box">
                    <div class="user-img">
                    <?php
                        if ( ! empty($property['User']['fb_image']) ) {
                            echo $this->Html->image($property['User']['fb_image']['property'], array('width' => 186, 'height' => 186));
                        }
                        elseif ( ! empty($property['User']['facebook_id'])) {
                            echo $this->Facebook->picture($property['User']['facebook_id'], array('facebook-logo' => 0, 'size' => 'large'));
                        }
                        else {
                            echo $this->Html->image('no_user.jpg', array('width' => 186, 'height' => 186));
                        }
                    ?>
                    </div>
                    <h2><?php echo $property_host_name; ?></h2>
                    <?php
                        if ( ! empty($property['Property']['contact_primary_phone'])) {
                            echo '<div class="phone">'.$property['Property']['contact_primary_phone'].'</div>';
                        }
                    ?>
                    <p align="center"><?php echo $this->Html->link('Contact Me', array('controller' => 'properties', 'action' => 'contact_me', $property['Property']['id'], '?' => 'width=500&height=600'), array('class' => 'blue-btn thickbox cal_update')); ?></p>
    <!--                <p align="center"><?php echo $this->Html->link('Learn more about host', '#'); ?></p> -->
                </div>
    <?php if (false) { ?>
                <div class="side-listbox">
                    <h3><?php echo __('Similar Listings'); ?> <span class="arr"> <?php echo $this->Html->image('gray-arr.png', array('width' => '31', 'height' => '16', 'alt' => '')); ?></span></h3>
                    <ul class="similiar-list">
                        <li>
                          <div class="thumb"> <?php echo $this->Html->image('simlist-thumb.png', array('width' => '93', 'height' => '60', 'alt' => '')); ?></div>
                          <div class="desc"> <?php echo $this->Html->link('0.2km away', '#'); ?><br>
                            $153 per night </div>
                        </li>
                        <li>
                          <div class="thumb"> <?php echo $this->Html->image('simlist-thumb.png', array('width' => '93', 'height' => '60', 'alt' => '')); ?></div>
                          <div class="desc"> <?php echo $this->Html->link('0.2km away', '#'); ?><br>
                            $153 per night </div>
                        </li>
                        <li>
                          <div class="thumb"> <?php echo $this->Html->image('simlist-thumb.png', array('width' => '93', 'height' => '60', 'alt' => '')); ?></div>
                          <div class="desc"> <?php echo $this->Html->link('0.2km away', '#'); ?><br>
                            $153 per night </div>
                        </li>
                        <li>
                          <div class="thumb"> <?php echo $this->Html->image('simlist-thumb.png', array('width' => '93', 'height' => '60', 'alt' => '')); ?></div>
                          <div class="desc"> <?php echo $this->Html->link('0.2km away', '#'); ?><br>
                            $153 per night </div>
                        </li>
                        <li>
                          <div class="thumb"> <?php echo $this->Html->image('simlist-thumb.png', array('width' => '93', 'height' => '60', 'alt' => '')); ?></div>
                          <div class="desc"> <?php echo $this->Html->link('0.2km away', '#'); ?><br>
                            $153 per night </div>
                        </li>
                        <li>
                          <div class="thumb"> <?php echo $this->Html->image('simlist-thumb.png', array('width' => '93', 'height' => '60', 'alt' => '')); ?></div>
                          <div class="desc"> <?php echo $this->Html->link('0.2km away', '#'); ?><br>
                            $153 per night </div>
                        </li>
                    </ul>
                </div>
    <?php } ?>
            </div>
</div>
<?php
    echo $this->Html->scriptblock("
        $('.listing_visibility').iphoneStyle({
            onChange: function(elem, value) {
                var property_id = $(elem).attr('rel');

                if (value.toString() == 'true') {
                    var visibility_status = '1';
                }
                else {
                    var visibility_status = '0';
                }

                $( '#listing_msg_'+ property_id ).html('<img src=\'".Router::url('/')."img/loading.gif\' />&nbsp;Please wait...');
                $.get('".Router::url(array('controller' => 'properties', 'action' => 'update_visibility'))."/'+ property_id + '/'+ visibility_status, function() {
                    if (value.toString() == 'true') {
                        $( '#listing_msg_'+ property_id ).html('Your listing is visible');
                    }
                    else {
                        $( '#listing_msg_'+ property_id ).html('Your listing isn\'t visible yet.');
                    }
                });
            }
        });
    ");
?>
<?php
echo $this->Html->ScriptBlock('
    var img_path = "'.$this->webroot.'";
    var add_to_wishlist_url = "'.Router::url( array('controller' => 'wishlists', 'action' => 'add_to_wish') ).'"
');
 echo $this->Html->script( array('calendar_hover.js', 'property-landing.js') );
 echo $this->Html->script( array('property-landing.js') );

?>

