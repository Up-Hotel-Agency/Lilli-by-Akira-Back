<?php 
//This file is used to sync existing icon field data and update with new standard. It can be removed after running. 
function find_autoload_icon_value($value){
    //Get a list of all SVG codes (these will be the previosuly stored values)
    $db_data = up_icons_get_db();
    foreach($db_data as $id => $icon):
        if(html_entity_decode($icon->svg) == $value):
            return $id;
        endif;
    endforeach;
}
function find_and_replace_existing_icon_values(){

    global $wpdb;
    $results = $wpdb->get_results("
        SELECT ID, post_content, post_excerpt 
        FROM {$wpdb->posts} 
        WHERE post_content LIKE '%autoloaded_icon%'
    ");
    $posts_updated = 0;
    $replacements_made = 0;
    if ($results) {
        foreach ($results as $row) {
            $replace_array = array();
            if($row->post_excerpt == "autoloaded_icon"){
                continue;
            }
            $matches = array();
            $pattern = '/\b\w*_autoloaded_icon":"([^"]+)"/';
            preg_match_all($pattern, $row->post_content, $matches);
            if($matches):
                foreach($matches[1] as $svg):
                    if(isset($svg)):
                        if(str_contains($svg, "field_")):
                            continue;
                        endif;
                        $decoded_string = json_decode('"' . $svg . '"');
                        $new_value = find_autoload_icon_value($decoded_string);   
                        if($new_value):
                            array_push($replace_array, array($svg, $new_value));
                        endif;
                    endif;
                endforeach;
            endif;
            if($replace_array):
                $replacements_made = $replacements_made + count($replace_array);
                $content = $row->post_content;
                foreach($replace_array as $replace):
                    $content = str_replace($replace[0], $replace[1], $content);
                endforeach;
                $wpdb->update(
                    $wpdb->posts, 
                    array('post_content' => $content),       
                    array('ID' => $row->ID)    
                );
                clean_post_cache($row->ID);
                $posts_updated++;
            endif;          
        }
    }
    ?>
    <h1 style='color:green;'>ACF Icons Sync: Complete</h1>
    <?php if(is_multisite()): ?>
        <b>Current Blog ID: <?php echo get_current_blog_id(); ?></b>
    <?php endif; ?>
    <h3>Page tables:</h3>
    <p>Number of page replacements made: <b><?php echo $replacements_made; ?></b></p>
    <p>Number of page ids updated: <b><?php echo $posts_updated; ?></b></p>
    <?php

    $metaSearch = array('postmeta', 'termmeta');
    foreach($metaSearch as $metaID):
        // Fetch the rows that match the criteria
        $results = $wpdb->get_results("
            SELECT meta_id, meta_value 
            FROM {$wpdb->$metaID} 
            WHERE meta_key LIKE '%autoloaded_icon%'
        ");
        $meta_updated = 0;
        if ($results) {
            foreach ($results as $row) {
                $new_meta_value = false;
                if(!$row->meta_value || str_contains($row->meta_value, "field_") || !str_contains($row->meta_value, "<svg")):
                    continue;
                endif;
                $new_meta_value = find_autoload_icon_value($row->meta_value);   
                
                if($new_meta_value):
                    $wpdb->update(
                        $wpdb->$metaID,
                        array('meta_value' => $new_meta_value),
                        array('meta_id' => $row->meta_id),
                        array('%s'),
                        array('%d')
                    );
                    $meta_updated++;
                endif;
            }
        }
        ?>
        <h3>Meta tables: <?php echo $metaID; ?></h3>
        <p>Number of meta fields updated: <b><?php echo$meta_updated; ?></b></p>
        <?php
    endforeach;
}
up_icons_db();
if(is_multisite()):
    echo "<h1>Multisite Network Sync</h1>";
    $wp_blogs = get_sites($args = array('number' => 500)); 
    foreach($wp_blogs as $blog):
        switch_to_blog($blog->blog_id); 
            find_and_replace_existing_icon_values();
        restore_current_blog();
    endforeach;
else:
    find_and_replace_existing_icon_values();
endif;    
echo "<p style='margin-top:50px;'>Please <b>remove</b> the setup-icons-sync.php file from the codebase.</p>";
echo "<p><b style='color:red;'>Remeber to clear site cache, network cache etc. And review icons to ensure they have been replaced correctly!</b></p>";
die();