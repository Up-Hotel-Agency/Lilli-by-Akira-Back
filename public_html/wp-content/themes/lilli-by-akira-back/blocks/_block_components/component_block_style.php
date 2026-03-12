<?php

//Output style style
if( $palette == 'custom' ): ?>
    <?php if( $custom_dark ): ?>--color-black: <?php echo $custom_dark; ?>;<?php endif; ?>
    <?php if( $custom_light ): ?>--color-white: <?php echo $custom_light; ?>;<?php endif; ?>
    <?php if( $custom_primary ): ?>--color-primary: <?php echo $custom_primary; ?>;<?php endif; ?>
    <?php if( $custom_primary_reverse ): ?>--color-primary-reverse: <?php echo $custom_primary_reverse; ?>;<?php endif; ?>
<?php endif; ?>
<?php if( $bg == 'custom' ): ?>
    <?php if( $custom_bg ): ?>--color-background: <?php echo $custom_bg; ?>;<?php endif; ?>
<?php endif; ?>