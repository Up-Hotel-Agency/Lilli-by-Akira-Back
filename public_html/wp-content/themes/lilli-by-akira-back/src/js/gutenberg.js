// set the global variables here for JSLint
/*global AOS, jQuery, document, wp, console, setTimeout, window */
"use strict";

// set fullscreen mode by default
jQuery(document).ready(function($){
    var isFullScreenMode = wp.data.select('core/edit-post').isFeatureActive('fullscreenMode');
    if ( !isFullScreenMode ) {
        wp.data.dispatch('core/edit-post').toggleFeature('fullscreenMode');
    }

    const getCssVarName = (colour) => colour.replace(/([A-Z])/g, '-$1').toLowerCase();

    const addColourChangeListener = (colour, colourPicker, wrapper) => {
        const cssVar = getCssVarName(colour);

        const colourPickerElement = colourPicker.querySelector('.iris-picker');
        const colourPickerManualInput = colourPicker.querySelector('input[class="wp-color-picker"]');
        const colourInput = colourPicker.querySelector('input[type="hidden"]');

        const colourVal = colourInput.value;

        wrapper.style.setProperty(`--color-${cssVar}`, colourVal);

        colourPickerElement.addEventListener('click', () => {
            wrapper.style.setProperty(`--color-${cssVar}`, colourInput.value);
        });
        colourPickerManualInput.addEventListener('change', (event) => {
            wrapper.style.setProperty(`--color-${cssVar}`, event.target.value);
        });
    }

    // add page theme in gutenberg
    if( jQuery('#acf-field_5f199b3c9decb-field_5f199b3c9decb_field_5f22df005795e-field_5f22cd70c0d44').length ) {
        let pageTheme = jQuery('#acf-field_674de280d6995-field_674de280d6995_field_674ddfc9911bf_field_67470e71e21e0-field_5f22cd70c0d44 option:checked').val();
        let pagePalette = jQuery('#acf-field_674de280d6995-field_674de280d6995_field_674ddfc99110a_field_67470986e21da-field_663c9880df6f0 option:checked').val();
        let pageBackground = document.querySelector('.acf-field-674706c11ef91').querySelector('input[type="radio"][checked]').value;

        const colourFields = {
            'black': document.querySelector('.acf-field-5f280287338c3'),
            'white': document.querySelector('.acf-field-5f280294338c4'),
            'primary': document.querySelector('.acf-field-67470b83e21de'),
            'primaryReverse': document.querySelector('.acf-field-67470b83e21df'),
            'background': document.querySelector('.acf-field-663cb941194dc')
        }

        const colourEntries = Object.entries(colourFields);

        setTimeout(function() {
            const wrapper = document.querySelector(".block-editor-block-list__layout");
            wrapper.classList.add('theme--' + pageTheme);
            wrapper.classList.add('palette--' + pagePalette);
            wrapper.classList.add(`background--${pageBackground}`);
            wrapper.classList.add('has-background');

            // Add listener to theme select
            const themeSelect = document.querySelector('.acf-field-5f22cd70c0d44');
            const themeInput = themeSelect.querySelector('select');

            themeInput.addEventListener('change', (event) => {
                wrapper.classList.remove(`theme--${pageTheme}`);
                pageTheme = event.target.value;
                wrapper.classList.add(`theme--${pageTheme}`);
            });

            // Add listener to palette select
            const paletteSelect = document.querySelector('.acf-field-663c9880df6f0');
            const paletteInput = paletteSelect.querySelector('select');

            paletteInput.addEventListener('change', (event) => {
                wrapper.classList.remove(`palette--${pagePalette}`);
                pagePalette = event.target.value;
                wrapper.classList.add(`palette--${pagePalette}`);
                
                if (pagePalette !== 'custom') {
                    for (const entry of colourEntries) {
                        if (entry[0] !== 'background') {
                            wrapper.style.removeProperty(`--color-${getCssVarName(entry[0])}`);
                        }
                    }
                } else {
                    for (const entry of colourEntries) {
                        if (entry[0] !== 'background') {
                            addColourChangeListener(entry[0], entry[1], wrapper);
                        }
                    }
                }
            });

            // Add listener to background shade select
            const backgroundShadeSelect = document.querySelector('.acf-field-663cac626f268');
            const backgroundShadeButtons = backgroundShadeSelect.querySelectorAll('input[type="radio"]');

            for (const button of backgroundShadeButtons) {
                if (button.checked) {
                    wrapper.classList.add(`background--${button.value}`);
                }

                button.addEventListener('click', (event) => {
                    wrapper.classList.remove(`background--${pageBackground}`);
                    pageBackground = event.target.value;
                    wrapper.classList.add(`background--${pageBackground}`);

                    if (pageBackground !== 'custom') {
                        wrapper.style.removeProperty('--color-background')
                    } else {
                        const colour = document.querySelector('input[name="acf[field_5f199b3c9decb][field_5f199b3c9decb_field_5f22df005795e][field_663cb941194dc]"]').value;
                        wrapper.style.setProperty('--color-background', colour);
                    }
                })
            }

            if (pagePalette === 'custom') {
                for (const entry of colourEntries) {
                    if (entry[0] !== 'background') {
                        addColourChangeListener(entry[0], entry[1], wrapper);
                    }
                }
            }

            if (pageBackground === 'custom') {
                addColourChangeListener('background', colourFields.background, wrapper);
            }
        }, 1500);
    }


    // if page theme is image, add image in gutenberg
    function removeThumbnailSize(imageString) {
        return imageString.replace(/-\d+x\d+(?=\.\w+$)/, '');
    }

    if( jQuery('.acf-field-674706c11ef91 input[checked="checked"]').val() === 'media' 
    && jQuery('#acf-field_674de280d6995-field_674de280d6995_field_674ddfc990f9f_field_674708f4e21d9-field_674dc25e33620-field_67470fefe21ea-field_67470fefe21ee').val() === 'image') {
        let bgImgThumb = jQuery('.acf-field-674705cb5941c .acf-image-uploader img').attr('src');
        let bgImg = removeThumbnailSize(bgImgThumb);
        setTimeout(function() {
            jQuery('.block-editor-block-list__layout').prepend('<div class="page-bg-img overlay--medium"><img class="object-fit" src="' + bgImg + '"></div>');
        }, 500);
    }
});