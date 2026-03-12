console.log('I exist');
// Select your target

// Define the observer
const observer = new IntersectionObserver(
  (entries) => {
    const target = document.querySelectorAll(".header, .page-container, .wp-block-post-content");
    entries.forEach((entry) => {
      
      //Get data attribute values from each element
      let theme = entry.target.dataset.pageColorTransitionTheme;
      let palette = entry.target.dataset.pageColorTransitionPalette;

      // Detect when observed element enters the viewport
      console.log(entry.isIntersecting);
      if (entry.isIntersecting) {
        console.log(target);
        target.forEach((el) => {
          //Split all the classes on target elements (we'll use this to find the appropriate classes to replace)
          let elClasses = el.className.split(" ");

          if (theme) {
            //Get the current page theme
            let elCurrentTheme = elClasses.find((cls) =>
              cls.startsWith("theme--")
            );

            el.classList.remove(elCurrentTheme); //Remove the current theme class from targets
            el.classList.add("theme--" + theme); //Add the observed theme as a class to targets
          }

          if (palette) {
            //Get the current palette class from targets
            let elCurrentPalette = elClasses.find((cls) =>
              cls.startsWith("palette--")
            );
            
            el.classList.remove(elCurrentPalette); //Remove the current palette light class from targets
            el.style.removeProperty("--color-black"); //Remove any palette inline CSS vars from targets
            el.style.removeProperty("--color-white"); //Remove any palette inline CSS vars from targets
            el.style.removeProperty("--color-primary"); //Remove any palette inline CSS vars from targets
            el.style.removeProperty("--color-primary-reverse"); //Remove any palette inline CSS vars from targets
            
            //If palette switch is a custom value, set the value as an inline CSS var on the targets
            if (palette == "custom") {
                let customPaletteDark = entry.target.dataset.pageColorTransitionPaletteCustomDark;
                let customPaletteLight = entry.target.dataset.pageColorTransitionPaletteCustomLight;
                let customPalettePrimary = entry.target.dataset.pageColorTransitionPaletteCustomPrimary;
                let customPalettePrimaryReverse = entry.target.dataset.pageColorTransitionPaletteCustomPrimaryReverse;

                el.style.setProperty("--color-black", customPaletteDark);
                el.style.setProperty("--color-white", customPaletteLight);
                el.style.setProperty("--color-primary", customPalettePrimary);
                el.style.setProperty("--color-primary-reverse", customPalettePrimaryReverse);
            } 
            //Otherwise, add the value as a class on the targets
            else {
              el.classList.add("palette--" + palette);
            }
          }
        });
      }
    });
  },
  { threshold: 0.5 }
); // Triggers when 50% of the element is visible

const mutationObserver = new MutationObserver(entries => {
// Choose the elements to observe – in this case, we want elements that use the below class
    const switcherEls = document.querySelectorAll(
        ".page-color-transition"
    );

    if (switcherEls.length) {
        // Attach them to the observer
        switcherEls.forEach((el) => {
            observer.observe(el);
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    mutationObserver.observe(document, {
        childList: true,
        subtree: true
    });
});
