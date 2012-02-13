<?php
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */


// standard path.
$imagepath =  trailingslashit( PLS_EXT_URL ) . 'options-framework/images/';


PLS_Style::add(array( 
            "name" => "General",
            "type" => "heading"));

PLS_Style::add(array( 
                "name" => "Site Logo",
                "desc" => "Upload your logo here. It will appear in the header.",
                "id" => "pls-site-logo",
                "type" => "upload"));

PLS_Style::add(array( 
                "name" => "Site Favicon",
                "desc" => "Upload your favicon here. It will appear in your visitors url and bookmark bar.",
                "id" => "pls-site-favicon",
                "type" => "upload"));

PLS_Style::add(array( 
                "name" => "Google Analytics Tracking Code",
                "desc" => "Add your google analytics tracking code here. It will be loaded into the footer of your site.",
                "id" => "pls-google-analytics",
                "type" => "textarea"));

           