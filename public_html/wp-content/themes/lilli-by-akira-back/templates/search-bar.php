
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('s');
    const searchIcon = document.querySelector('.svg-search');

    if (searchForm && searchInput && searchIcon) {
        searchIcon.addEventListener('click', function() {
            if (searchInput.value.trim() !== '') {
                searchForm.submit();
            } else {
                searchInput.focus();
            }
        });
    }
});
</script>


<form action="<?php echo home_url(); ?>" class="search-bar" id="search-form" method="get">
    <input class="searchinput" type="text" name="s" id="s" placeholder="Search..."
    onfocus="if(this.value=='type your search')this.value=''" />
    <svg class="remove-search" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1836 2.81311C13.3789 3.00838 13.3789 3.32496 13.1836 3.52022L3.5236 13.1802C3.32834 13.3755 3.01175 13.3755 2.81649 13.1802C2.62123 12.985 2.62123 12.6684 2.81649 12.4731L12.4765 2.81311C12.6718 2.61785 12.9883 2.61785 13.1836 2.81311Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M2.81649 2.81311C3.01175 2.61785 3.32834 2.61785 3.5236 2.81311L13.1836 12.4731C13.3789 12.6684 13.3789 12.985 13.1836 13.1802C12.9883 13.3755 12.6718 13.3755 12.4765 13.1802L2.81649 3.52022C2.62123 3.32496 2.62123 3.00838 2.81649 2.81311Z" fill="currentColor"/> </svg>
    <svg class="svg-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3797 12.5197C12.6725 12.2268 13.1474 12.2268 13.4403 12.5197L20.9203 19.9997C21.2132 20.2926 21.2132 20.7674 20.9203 21.0603C20.6274 21.3532 20.1525 21.3532 19.8597 21.0603L12.3797 13.5803C12.0868 13.2874 12.0868 12.8126 12.3797 12.5197Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M9.05899 4.5C6.4638 4.5 4.35999 6.60381 4.35999 9.199C4.35999 11.7942 6.4638 13.898 9.05899 13.898C11.6542 13.898 13.758 11.7942 13.758 9.199C13.758 6.60381 11.6542 4.5 9.05899 4.5ZM2.85999 9.199C2.85999 5.77539 5.63537 3 9.05899 3C12.4826 3 15.258 5.77539 15.258 9.199C15.258 12.6226 12.4826 15.398 9.05899 15.398C5.63537 15.398 2.85999 12.6226 2.85999 9.199Z" fill="currentColor"/> </svg>
    <input type="hidden" value="submit" />
</form>
