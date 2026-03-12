<?php

global $has_used_lcp_image;
if (!isset($has_used_lcp_image)) {
    $has_used_lcp_image = false;
}

//Media Component (Block)
if($block_media_field):

    //Set our root field 
    $root_field = $block_media_field['bg_media'];
    $imgSize = array('default' => 'img_1367', 'page_area' => 100, 'mobile_page_area' => 100); //Default image sizes or defined
    $mediaType = $root_field['media_type'];

    if($mediaType == "image"):
        //Check if array of images
        $imgArray = false;
        if(is_array($root_field['image_options']['bg_images'])):
            $count = count($root_field['image_options']['bg_images']);
            if( $count > 1 ): 
                $imgArray = true;
            endif;
        else:
            return; 
        endif;
        ?>
            <div class="block-bg-img <?php if ($root_field['overlay_intensity'] != 'none'): echo 'overlay--' . $root_field['overlay_intensity']; endif ?>">
                <div class="media-container no-aspect image-carousel js-image-carousel"><?php
                    foreach ( $root_field['image_options']['bg_images'] as $data) :
                        $imageID = $data['images'];
                        $is_lcp = false;

                        if (!$has_used_lcp_image) {
                            $is_lcp = true;
                            $has_used_lcp_image = true;
                        }

                        echo img_sizes($imageID, ['default' => $imgSize['default'], 'page_area' => $imgSize['page_area'], 'mobile_page_area' => $imgSize['mobile_page_area'], 'lazy_load' => !$is_lcp, 'lcp' => $is_lcp ]);
                    endforeach; ?>
                </div>
            </div>
        <?php
    elseif($mediaType == "video"):
        $videoOptions = $root_field['video_options']['bg_video'];
        if($videoOptions['video_source'] == "youtube"):
            if($videoOptions['youtube_embed_url']): 
            $videoURL = $videoOptions['youtube_embed_url'];
            $posterImage = $videoOptions['poster_image'];            
            if($posterImage):
                $posterImage = "background-image: url('".wp_get_attachment_image_url($posterImage, 'full')."');";
            endif;
            ?>
            <div class="block-bg-img overlay--<?php echo $root_field['overlay_intensity']; ?>">
                <div class="media-container video-media-container no-aspect">
                    <lite-youtube
                        data-aos="fade-up"
                        <?php if($autoPlay): ?>data-aos-id="liteYoutube" <?php endif;?> 
                        style="<?php echo $posterImage; ?>"
                        autoplay="1" 
                        videoid="<?php echo $videoURL; ?>" 
                        params="modestbranding=1&autoplay=1&listType=playlist&loop=1&rel=0&controls=0&enablejsapi=1&mute=1">
                    </lite-youtube>
                </div>
            </div>
            <?php
            endif;
        endif;

        //Direct or file select video player
        if($videoOptions['video_source'] == "direct" || $videoOptions['video_source'] == "file"):

            //Get file URL
            if($videoOptions['video_source'] == "direct"):
                $videoURL = $videoOptions['direct_video_link'];
            elseif($videoOptions['video_source'] == "file"):
                $videoURL = wp_get_attachment_url($videoOptions['uploaded_video_file']);
            endif;

            $posterImage = $videoOptions['poster_image'];
            if($posterImage):
                $posterImage = "poster='".wp_get_attachment_image_url($posterImage, 'full')."'";
            endif;
            $fit = "object-fit";

            //Add in video player 
            ?>
                <div class="block-bg-img overlay--<?php echo $root_field['overlay_intensity']; ?>">
                <video 
                class="media-container no-aspect object-fit"
                <?php echo $posterImage; ?>
                width="auto" height="auto" 
                autoplay
                muted
                loop
                playsinline
                preload="metadata"
                >
                <source src="<?php echo $videoURL; ?><?php if(!$posterImage): ?>#t=0.5<?php endif; ?>" type="video/mp4">
                Your browser does not support the video tag.
                </video>
                </div>

            <?php

        elseif($videoOptions['video_source'] == "vimeo"): 

            //Get Vimeo ID
            $videoURL = $videoOptions['vimeo_embed_url'];

            //Get all options 
            $autoPlay = $videoOptions['auto_play'];
            $posterImage = $videoOptions['poster_image'];

            if($posterImage):
                $posterImage = "poster='".wp_get_attachment_image_url($posterImage, 'full')."'";
            endif;
            ?>
            <div class="block-bg-img overlay--<?php echo $root_field['overlay_intensity']; ?>">
                <div class="media-container video-media-container no-aspect">
                    <div 
                    class="vimeo-player" 
                    data-vimeo-id="<?php echo $videoURL; ?>" 
                    data-vimeo-aria-hidden="true"
                    data-vimeo-loop="true"
                    data-vimeo-autoplay="1"
                    data-vimeo-muted="1"
                    data-vimeo-controls="0"
                    ></div>
                </div>
            </div>
            <?php
        endif; 
    endif; 

endif; ?>
