<?php 

/**
* 
*/
PLS_Listing_Helper::init();
class PLS_Listing_Helper {
	
	function init() {
		add_action('wp_ajax_pls_listings_for_options', array(__CLASS__,'listings_for_options'));
	}

	function listings_for_options () {
		$api_response = PLS_Plugin_API::get_property_list($_POST);
		$formatted_listings = '';
		if ($api_response['listings']) {
			foreach ($api_response['listings'] as $listing) {
				$formatted_listings .= '<option value="' . $listing['id'] . '" >' . $listing['location']['full_address'] . '</option>';
			}
		} else {
		$formatted_listings .= "No Results. Broaden your search.";
		}
		echo json_encode($formatted_listings);
		die();
	}

	function get_featured ($featured_option_id) {
		$option_ids = pls_get_option($featured_option_id);
		if (!empty( $option_ids ) ) {
			$property_ids = array_keys($option_ids);
			$api_response = PLS_Plugin_API::get_listings_details_list($property_ids);
			return $api_response;	
		} else {
			return array('listings' => array());
		}
		
	}
}