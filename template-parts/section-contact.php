<?php
/**
 * Show Contact section
 * @package vigor
 */

// Grab option values.
$vigor_location_showhide = get_theme_mod( 'vigor_location_showhide', 'hide' );
$vigor_location_title = get_theme_mod( 'vigor_location_title', '' );

$vigor_location_title1 = get_theme_mod( 'vigor_location_title1', '' );
$vigor_location_address1 = get_theme_mod( 'vigor_location_address1', '' );
$vigor_location_details1 = get_theme_mod( 'vigor_location_details1', '' );
$vigor_location_gallery1 = get_theme_mod( 'location_gallery1', true );
$images1 = explode( ',', $vigor_location_gallery1 );

$vigor_location_title2 = get_theme_mod( 'vigor_location_title2', '' );
$vigor_location_address2 = get_theme_mod( 'vigor_location_address2', '' );
$vigor_location_details2 = get_theme_mod( 'vigor_location_details2', '' );
$vigor_location_gallery2 = get_theme_mod( 'location_gallery2', '' );
$images2 = explode( ',', $vigor_location_gallery2 );

$vigor_location_title3 = get_theme_mod( 'vigor_location_title3', '' );
$vigor_location_address3 = get_theme_mod( 'vigor_location_address3', '' );
$vigor_location_details3 = get_theme_mod( 'vigor_location_details3', '' );
$vigor_location_gallery3 = get_theme_mod( 'location_gallery3', '' );
$images3 = explode( ',', $vigor_location_gallery3 );

if ( 'show' ==  $vigor_location_showhide ) { ?>

	<div class="section-contact">
		<?php if ( ! empty( $vigor_location_title ) ) { ?><h2 class="contact-title"><?php echo esc_html( $vigor_location_title ); ?></h2><?php } ?>

		<div id="gallery1" style="display: none" class="vigor-gallery"><?php vigor_gallery( $images1 ); ?></div>
		<div id="gallery2" style="display: none" class="vigor-gallery"><?php vigor_gallery( $images2 ); ?></div>
		<div id="gallery3" style="display: none" class="vigor-gallery"><?php vigor_gallery( $images3 ); ?></div>

		<script src="https://maps.googleapis.com/maps/api/js?key=[YOUR API KEY]"></script>
		<script>
			
			// Set global variables
			var map;
			var bounds;
			var locationCount;
			var mapOptions;
			var infoWindow = null;
			var defaultZoom = 13; // The minimum zoom level
			var mapElementId = 'map'
			var mapElement = document.getElementById(mapElementId);
			var pin_url = '<?php echo esc_url( get_template_directory_uri() ); ?>/images/pin.png';
			var pin_selected_url = '<?php echo esc_url( get_template_directory_uri() ); ?>/images/pin-selected.png';
			// Locations array
			var markers = [];

			// Location data
			var location_title_1 = '<?php echo esc_html( $vigor_location_title1 ); ?>';
			var location_title_2 = '<?php echo esc_html( $vigor_location_title2 ); ?>';
			var location_title_3 = '<?php echo esc_html( $vigor_location_title3 ); ?>';

			var location_address_1 = '<?php echo esc_html( $vigor_location_address1 ); ?>';
			var location_address_2 = '<?php echo esc_html( $vigor_location_address2 ); ?>';
			var location_address_3 = '<?php echo esc_html( $vigor_location_address3 ); ?>';

			var location_details_1 = '<?php echo esc_html( $vigor_location_details1 ); ?>';
			var location_details_2 = '<?php echo esc_html( $vigor_location_details2 ); ?>';
			var location_details_3 = '<?php echo esc_html( $vigor_location_details3 ); ?>';
			
			var location_gallery_1 = document.getElementById("gallery1").innerHTML;
			var location_gallery_2 = document.getElementById("gallery2").innerHTML;
			var location_gallery_3 = document.getElementById("gallery3").innerHTML;

			// Set marker attributes. If you need unique values for each marker, 
			// you can update the values directly in the locations array.
			var markerWidth = 93;
			var markerHeight = 82;
			var markerScale = 1; // Scale the image, if you can't control the source file.

			// The array of locations to mark on the map.
			// Add as many locations as necessary.
			var locations = [
				[
					location_address_1,
					{	
						// Marker icon config object
						url: pin_url,
						size: new google.maps.Size(markerWidth, markerHeight),
						origin: new google.maps.Point(0,0),
						anchor: new google.maps.Point(markerWidth * (markerScale / 2), markerHeight * markerScale),
						scaledSize: new google.maps.Size(markerWidth * markerScale, markerHeight * markerScale)
					},
					new google.maps.Size((markerWidth * (markerScale / 4)) * -1, markerHeight * markerScale), // marker offset
					location_title_1,
					location_address_1,
					location_details_1,
					location_gallery_1,
				],
				[
					location_address_2,
					{	
						// Marker icon config object
						url: pin_url,
						size: new google.maps.Size(markerWidth, markerHeight),
						origin: new google.maps.Point(0,0),
						anchor: new google.maps.Point(markerWidth * (markerScale / 2), markerHeight * markerScale),
						scaledSize: new google.maps.Size(markerWidth * markerScale, markerHeight * markerScale)
					},
					new google.maps.Size((markerWidth * (markerScale / 4)) * -1, markerHeight * markerScale), // marker offset
					location_title_2,
					location_address_2,
					location_details_2,
					location_gallery_2,
				],
				[
					location_address_3,
					{	
						// Marker icon config object
						url: pin_url,
						size: new google.maps.Size(markerWidth, markerHeight),
						origin: new google.maps.Point(0,0),
						anchor: new google.maps.Point(markerWidth * (markerScale / 2), markerHeight * markerScale),
						scaledSize: new google.maps.Size(markerWidth * markerScale, markerHeight * markerScale)
					},
					new google.maps.Size((markerWidth * (markerScale / 4)) * -1, markerHeight * markerScale), // marker offset
					location_title_3,
					location_address_3,
					location_details_3,
					location_gallery_3,
				],
			];

			// Init map on Google 'load' event
			google.maps.event.addDomListener(window, 'load', init);

			// Init the map
			function init() {

				// Customize look of the map.
				// https://www.mapbuildr.com/
				mapOptions = {
					zoom: defaultZoom,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
					},
					disableDoubleClickZoom: false,
					mapTypeControl: false,
					panControl: false,
					scaleControl: false,
					scrollwheel: false,
					streetViewControl: false,
					draggable : true,
					overviewMapControl: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					
				}

				// Create new map object
				map = new google.maps.Map(document.getElementById('map'), mapOptions);

				// OPTIONAL: Set listener to tell when map is idle
				// Can be useful during dev
				google.maps.event.addListener(map, "idle", function(){
					// console.log("map is idle");
				});

				var geocoder = new google.maps.Geocoder();
				bounds = new google.maps.LatLngBounds();
				locationCount = 0;

				// Init InfoWindow and leave it
				// for use when user clicks marker
				infoWindow = new google.maps.InfoWindow( { content: "Loading content..." } );


				// Loop through locations and set markers
				for (i = 0; i < locations.length; i++) {

					var address = locations[i][0];

					//Get latitude and longitude from address
					geocoder.geocode( {'address': address}, onGeocodeComplete(i));
				}

				// Re-center map on window resize
				google.maps.event.addDomListener(window, 'resize', function() {
					var center = map.getCenter();
					google.maps.event.trigger(map, "resize");
					map.setCenter(center);
				});

			} // END init()


			// Triggered as the geocode callback
			function onGeocodeComplete(i) {

				// Callback function for geocode on response from Google.
				// We wrap it in 'onGeocodeComplete' so we can send the
				// location index through to the marker to establish
				// content.
				var geocodeCallBack = function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {

						// The HTML content for the InfoWindow.
						// Includes a form to allow the user to
						// get directions.
						var windowContent = '<div class="infoBox"><h3>' + locations[i][3] + '</h3>' + 
						'<div class="content">' + 
						'<div class="address">' + locations[i][4] + '</div>' + 
						'<div class="details">' + locations[i][5] + '</div>' + 
						locations[i][6] + 
						'</div></div>';
							
					

						// Create the marker for the location
						// We use 'html' key to attach the
						// InfoWindow content to the marker.
						var marker = new google.maps.Marker({
							icon: locations[i][1],
							position: results[0].geometry.location,
							map: map,
							window_offset: locations[i][2],
							html: windowContent
						});

						

						// Set event to display the InfoWindow anchored
						// to the marker when the marker is clicked.

						google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							showInfoWindow(this);
							for (var j = 0; j < markers.length; j++) {
								markers[j].setIcon(pin_url);
							}
							marker.setIcon(pin_selected_url);
						};
						})(marker, i));
						markers.push(marker);

						// Add this marker to the map bounds
						extendBounds(results[0].geometry.location);

					} else {
						window.log('Location geocoding has failed: ' + google.maps.GeocoderStatus);

						// Hide empty map element on error
						mapElement.style.display = 'none';
					}
				} // END geocodeCallBack()

				return geocodeCallBack;

			} // END onGeocodeComplete()


			function showInfoWindow(marker) {
				// Updates the InfoWindow content with
				// the HTML held in the marker ('this').
				infoWindow.setOptions({
					content: marker.html,
					//pixelOffset: marker.window_offset
				});
				infoWindow.open(map, marker);
			}


			// Establishes the bounds for all the markers
			// then centers and zooms the map to show all.
			function extendBounds(latlng) {
				++locationCount;

				bounds.extend(latlng);

				if (locationCount == locations.length) {
					map.fitBounds(bounds);

					var currentZoom = map.getZoom();
					if (currentZoom > mapOptions.zoom) {
						map.setZoom(mapOptions.zoom);
					}
				}
			} // END extendBounds()

		</script>

		<div id="map" class="google-map"></div>
		        
	</div>

<?php }
