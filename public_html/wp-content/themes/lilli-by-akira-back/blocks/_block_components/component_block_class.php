<?php

//Output style class
if( $has_bg ):
    echo 'has-background';
    if ( $bg ):
      echo ' ' . 'background--' . $bg . ' ';
    endif;
endif;
echo 'palette--' . $palette . ' ';

if (!$theme): 
  $theme = 'inherit';
endif;

  //Check if behaviour is set to 'page transition'
  if ($colorBehaviour == 'page_transition') {
      echo 'page-color-transition';
    } else if ( $palette != 'inherit' && $theme == 'inherit' ) {
      echo 'theme--default';
  } else {
    echo 'theme--' . $theme;
    }
?>