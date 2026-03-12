<?php

/**
* @desc get the the role object
* @desc add $cap capability to this role object
*/
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

//Add alt attribute for gravatar on posts
function replace_content($text) {
    $alt = get_the_title(); 
    $text = str_replace('alt=\'\'', 'alt=\''.$alt .'\'', $text);
    return $text; 
   } 
add_filter('get_avatar','replace_content'); 