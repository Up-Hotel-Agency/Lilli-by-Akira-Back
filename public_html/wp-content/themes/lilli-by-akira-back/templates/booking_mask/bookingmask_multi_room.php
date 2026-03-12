<form action="#" class="js-booking-mask booking-mask theme--light flex sm:flex-col<?php if( get_field('override_page_theme') ): if( $themeField['disable_overlay'] && $themeField['text_colour'] == 'dark' ): ?> theme--default<?php endif; endif; ?>" data-aos="fade-up">
    <div class="dates-fields flex no-margin">
        <div class="date-field check-in-field flex items-center">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="3.893" y="5.001" width="16.213" height="15.167" rx=".5" stroke-width="1.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.906 8.561L20.107 8.561"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.845 3.831L16.845 6.07"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.431 3.831L7.431 6.07"/><circle cx="12.047" cy="11.404" r="1" fill="currentColor"/><circle cx="16.047" cy="11.404" r="1" fill="currentColor"/><circle cx="12.047" cy="14.404" r="1" fill="currentColor"/><circle cx="16.047" cy="14.404" r="1" fill="currentColor"/><circle cx="12.047" cy="17.404" r="1" fill="currentColor"/><circle cx="16.047" cy="17.404" r="1" fill="currentColor"/><circle cx="8.047" cy="14.404" r="1" fill="currentColor"/><circle cx="8.047" cy="17.404" r="1" fill="currentColor"/></svg>
            <p class="no-margin">
                <strong class="size-xs color-body-50 block">Check In</strong>
                <span class="js-check-in-display"><?php echo date('D d M'); ?></span>
            </p>
            <input aria-label="Check In" type="date" class="hidden xs:block js-arrive-input" name="arrival" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" />
        </div>
        <div class="date-field check-out-field flex items-center">
            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="3.893" y="5.001" width="16.213" height="15.167" rx=".5" stroke-width="1.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.906 8.561L20.107 8.561"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.845 3.831L16.845 6.07"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.431 3.831L7.431 6.07"/><circle cx="12.047" cy="11.404" r="1" fill="currentColor"/><circle cx="16.047" cy="11.404" r="1" fill="currentColor"/><circle cx="12.047" cy="14.404" r="1" fill="currentColor"/><circle cx="16.047" cy="14.404" r="1" fill="currentColor"/><circle cx="12.047" cy="17.404" r="1" fill="currentColor"/><circle cx="16.047" cy="17.404" r="1" fill="currentColor"/><circle cx="8.047" cy="14.404" r="1" fill="currentColor"/><circle cx="8.047" cy="17.404" r="1" fill="currentColor"/></svg>
            <p class="no-margin">
                <strong class="size-xs color-body-50 block">Check Out</strong>
                <span class="js-check-out-display"><?php echo date('D d M', strtotime('tomorrow')); ?></span>
            </p>
            <input aria-label="Check Out" type="date" class="hidden xs:block js-departure-input" name="departure" value="<?php echo date('Y-m-d', strtotime('tomorrow')); ?>" min="<?php echo date('Y-m-d', strtotime('tomorrow')); ?>" />
        </div>
        <div class="js-datepicker-trigger datepicker-trigger xs:hidden"></div>
    </div>
    <div class="rooms-guests-fields flex no-margin">
        <div class="rooms-guests flex items-center js-rooms-guests-trigger">
            <div class="no-margin size-xs guests-container">
                <input type="hidden" class="js-count-rooms" name="rooms" value="1" />
                <input type="hidden" class="js-count-total-adults" name="totaladults" value="1" />
                <input type="hidden" class="js-count-total-children" name="totalchildren" value="0" />
                <strong class="form-label">Rooms / Guests</strong>
                <div class="guests-wrapper">
                    <span class="js-rooms-display">1 Room </span> / <span class="js-guests-display"> 1 Guest</span>
                </div>
            </div>
        </div>
        <div class="rooms-guests-select theme--default">
            <div class="select-inner select-inner-multi">
                <div class="room-selector">
                    <div class="room" data-max="4" data-min="1" data-room="1">
                        <div class="selector-wrap flex items-center justify-between mb-6" data-max="9" data-min="1">
                            <input type="hidden" class="js-count-rooms-single" name="rooms" value="1" />
                            <p class="no-margin overline-1">Room <span class="room-number">1</span></p>
                            <div class="flex remove-room disabled" id="remove-room">
                                <span class="body-xs">Remove</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.065 2.76426C13.1951 2.89443 13.1951 3.10549 13.065 3.23566L3.40497 12.8957C3.2748 13.0258 3.06374 13.0258 2.93357 12.8957C2.80339 12.7655 2.80339 12.5544 2.93357 12.4243L12.5936 2.76426C12.7237 2.63408 12.9348 2.63408 13.065 2.76426Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.93357 2.76426C3.06374 2.63408 3.2748 2.63408 3.40497 2.76426L13.065 12.4243C13.1951 12.5544 13.1951 12.7655 13.065 12.8957C12.9348 13.0258 12.7237 13.0258 12.5936 12.8957L2.93357 3.23566C2.80339 3.10549 2.80339 2.89443 2.93357 2.76426Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <div class="guest-wrap flex">
                            <div class="selector-wrap flex items-center justify-between" data-max="2" data-min="1">
                                <input type="hidden" class="js-count-adults" name="adults" value="1" />
                                <p class="no-margin label-2">Adults</p>
                                <div class="selector flex items-center">
                                    <button class="selector-control minus button icon minor size-s no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                            <title>minus</title>
                                            <path d="M8 24 H40" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                                        </svg>
                                    </button>
                                    <span class="selector-value text-center body-s">1</span>
                                    <button class="selector-control plus button icon minor size-s no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                            <title>plus</title>
                                            <path d="M24 8 V40 M8 24 H40" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="selector-wrap flex items-center justify-between" data-max="2" data-min="0">
                                <input type="hidden" class="js-count-children" name="children" value="0" />
                                <p class="no-margin label-2">Children</p>
                                <div class="selector flex items-center">
                                    <button class="selector-control minus button icon minor size-s no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                            <title>minus</title>
                                            <path d="M8 24 H40" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                                        </svg>
                                    </button>
                                    <span class="selector-value text-center body-s">0</span>
                                    <button class="selector-control plus button icon minor size-s no-margin">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                            <title>plus</title>
                                            <path d="M24 8 V40 M8 24 H40" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
        
                        </div>

                        <div class="js-age-selectors age-selector" style="display: none;">
                            <?php for ($i = 1; $i <= 2; $i++): ?>
                                <div class="child-age flex justify-between" style="display: none;">
                                    <label class="label-2" for="child<?php echo $i ?>_age">Child <?php echo $i ?> Age</label>
                                    <select class="child-age-select" name="child<?php echo $i ?>_age" >
                                        <option class="body-s" value="0">under 1</option>
                                        <?php for ($j = 1; $j <= 15; $j++): ?>
                                            <option value="<?php echo $j ?>"><?php echo $j ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <footer class="flex buttons mt-6 justify-center">
                    <a href="#" class="add-room button minor">Add Room</a>
                    <a href="#" class="rooms-guests-close button primary">Confirm</a>
                </footer>
            </div>
        </div>
    </div>
    <button type="submit" class="submit-button button primary icon-position-right" data-blog-id="<?php echo get_current_blog_id(); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.8551 5.55607C14.0507 5.75169 14.0507 6.06885 13.8551 6.26447L6.29873 13.8208C6.10311 14.0164 5.78595 14.0164 5.59033 13.8208C5.39471 13.6252 5.39471 13.308 5.59033 13.1124L13.1467 5.55607C13.3423 5.36044 13.6594 5.36044 13.8551 5.55607Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.8721 5.53906C13.966 5.633 14.0188 5.76041 14.0188 5.89327L14.0188 11.263C14.0188 11.5396 13.7945 11.7639 13.5179 11.7639C13.2412 11.7639 13.0169 11.5396 13.0169 11.263L13.0169 6.39419L8.14815 6.39419C7.8715 6.39419 7.64723 6.16992 7.64723 5.89327C7.64723 5.61662 7.8715 5.39235 8.14815 5.39235L13.5179 5.39235C13.6507 5.39235 13.7781 5.44512 13.8721 5.53906Z" fill="currentColor"/> </svg>
        <span>Check Availability</span>
    </button>
</form>