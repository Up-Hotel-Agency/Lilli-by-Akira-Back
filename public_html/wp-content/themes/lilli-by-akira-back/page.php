<?php
get_header();
while ( have_posts() ) : the_post();
extract(block_color_variables());
?>

<main

class="
page-container  
page--<?php echo str_replace(' ', '-', strtolower(get_the_title())); ?> 
<?php include get_template_directory() .'/blocks/_block_components/component_block_class.php'; //Apply inline styles and variables from ACF row settings ?>
"
id="scroll-target"
style="
<?php include get_template_directory() .'/blocks/_block_components/component_block_style.php'; //Apply inline styles and variables from ACF row settings ?>
"
>

    <?php include get_template_directory() .'/blocks/_block_components/component_bg_media.php'; ?>

    <?php the_content(); ?>
</main>



<?php endwhile;

get_footer();