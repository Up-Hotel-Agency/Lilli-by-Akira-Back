<?php
    // includes the template of the footer set in setup-footer.php
    include 'templates/' . get_footer_type() . '.php';
    
    // includes the template of the menu of the header set in setup-header.php
    include 'templates/menu_' . get_header_type() . '.php';
?>

<?php
// conversion tools
include 'templates/conversion_tools.php';

// ajax modal container 
include 'templates/ajax_modal.php';
?>
<?php wp_footer(); ?>
<?php acf_load_listener(); ?>

<div class="js-book-widget-container book-widget-container">

    <button class="button icon js-book-widget-close theme--image">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.755 19.245l14.49-14.49m0 14.49L4.755 4.755"/></svg>
    </button>

    <div class="book-widget-container-wrapper">
        <?php echo get_field('book_widget', 'options'); ?>
    </div>

</div>

</body>
</html>
