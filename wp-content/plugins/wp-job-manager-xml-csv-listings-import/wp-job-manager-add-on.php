<?php

/*
Plugin Name: WP All Import - WP Job Manager Add-On
Plugin URI: http://www.wpallimport.com/
Description: Supporting imports into the WP Job Manager theme.
Version: 1.0.4
Author: Soflyy
*/


include "rapid-addon.php";

$wpjm_addon = new RapidAddon( 'WP Job Manager Add-On', 'wpjm_addon' );

$wpjm_addon->disable_default_images();

$wpjm_addon->add_field( '_job_location', 'Location', 'text', null, 'Leave this blank if location is not important' );

$wpjm_addon->add_field( '_company_name', 'Company Name', 'text' );

$wpjm_addon->add_field( '_company_tagline', 'Company Tagline', 'text' );

$wpjm_addon->add_field( '_company_description', 'Company Description', 'text' );

$wpjm_addon->add_field( '_application', 'Application Email or URL', 'text', null, 'This field is required for the "application" area to appear beneath the listing.');

$wpjm_addon->add_field( '_company_website', 'Company Website', 'text' );

$wpjm_addon->add_field( '_company_logo', 'Company Logo', 'image');

$wpjm_addon->add_field( 'company_featured_image', 'Featured Image', 'image');

$wpjm_addon->add_field( 'video_type', 'Company Video', 'radio',
    array(
        'external' => array(
            'Externally Hosted',
            $wpjm_addon->add_field( '_company_video_url', 'Video URL', 'text')
        ),
        'local' => array(
            'Locally Hosted',
            $wpjm_addon->add_field( '_company_video_id', 'Upload Video', 'file')
)));

$wpjm_addon->add_field( '_job_expires', 'Listing Expiry Date', 'text', null, 'Import date in any strtotime compatible format.');

$wpjm_addon->add_field( '_filled', 'Filled', 'radio', 
    array(
        '0' => 'No',
        '1' => 'Yes'
    ),
    'Filled listings will no longer accept applications.'
);

$wpjm_addon->add_field( '_featured', 'Featured Listing', 'radio', 
    array(
        '0' => 'No',
        '1' => 'Yes'
    ),
    'Featured listings will be sticky during searches, and can be styled differently.'
);

$wpjm_addon->add_options(
        null,
        'Social Media Options', 
        array(
            $wpjm_addon->add_field( '_company_facebook', 'Company Facebook', 'text' ),
            $wpjm_addon->add_field( '_company_twitter', 'Company Twitter', 'text' ),
            $wpjm_addon->add_field( '_company_linkedin', 'Company LinkedIn', 'text' ),
            $wpjm_addon->add_field( '_company_google', 'Company Google+', 'text' ),
        )
);

$wpjm_addon->set_import_function( 'wpjm_addon_import' );

$wpjm_addon->admin_notice(
    'The WP Job Manager Add-On requires WP All Import <a href="http://www.wpallimport.com/order-now/?utm_source=free-plugin&utm_medium=dot-org&utm_campaign=wpjm" target="_blank">Pro</a> or <a href="http://wordpress.org/plugins/wp-all-import" target="_blank">Free</a>, and the <a href="https://wordpress.org/plugins/wp-job-manager/">WP Job Manager</a> plugin.',
    array( 
        "plugins" => array( "wp-job-manager/wp-job-manager.php" ),
) );

$wpjm_addon->run( array(
        "plugins" => array( "wp-job-manager/wp-job-manager.php" ),
        'post_types' => array( 'job_listing' ) 
) );

function wpjm_addon_import( $post_id, $data, $import_options, $article ) {
    
    global $wpjm_addon;
    
    // all fields except for slider and image fields
    $fields = array(
        '_job_location',
        '_company_name',
        '_company_tagline',
        '_company_description',
        '_application',
        '_company_website',
        '_filled',
        '_featured',
        '_company_facebook',
        '_company_twitter',
        '_company_linkedin',
        '_company_google'
    );

    // update everything in fields arrays
    foreach ( $fields as $field ) {

        if ( empty( $article['ID'] ) or $wpjm_addon->can_update_meta( $field, $import_options ) ) {

            update_post_meta( $post_id, $field, $data[$field] );

        }
    }


    // set featured image
    $field = 'company_featured_image';

    if ( empty( $article['ID'] ) or $wpjm_addon->can_update_image( $import_options ) ) {

        $attachment_id = $data[$field]['attachment_id'];

        set_post_thumbnail( $post_id, $attachment_id );

    }

    // update video and logo
    $fields = array(
        '_company_logo'
    );

    if ( empty( $article['ID'] ) or $wpjm_addon->can_update_image( $import_options ) ) {

        foreach ( $fields as $field ) {

            $attachment_id = $data[$field]['attachment_id'];

            $url = wp_get_attachment_url( $attachment_id );

            update_post_meta( $post_id, $field, $url );
            
        }

    }

    // update video

    if ( empty( $article['ID'] ) or $wpjm_addon->can_update_meta( '_company_video', $import_options ) ) {

        if ( $data['video_type'] == 'external' ) {

            update_post_meta( $post_id, '_company_video', $data['_company_video_url'] );

        } elseif ( $data['video_type'] == 'local' ) {

            $attachment_id = $data['_company_video_id']['attachment_id'];

            $url = wp_get_attachment_url( $attachment_id );

            update_post_meta( $post_id, '_company_video', $url );
        }
    }

    // update listing expiration date
    $field = '_job_expires';

    $date = $data[$field];

    $date = strtotime( $date );

    if ( empty( $article['ID'] ) or ( $wpjm_addon->can_update_meta( $field, $import_options ) && !empty( $date ) ) ) {

        $date = date( 'Y-m-d', $date );

        update_post_meta( $post_id, $field, $date );

    }
}