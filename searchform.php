<div class="toggle-search fcc">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32.005" viewBox="0 0 32 32.005" class="tr">
        <path d="M31.565,27.671l-6.232-6.232A1.5,1.5,0,0,0,24.271,21H23.252A12.995,12.995,0,1,0,21,23.252v1.019a1.5,1.5,0,0,0,.438,1.063l6.232,6.232a1.494,1.494,0,0,0,2.119,0L31.559,29.8A1.507,1.507,0,0,0,31.565,27.671ZM13,21a8,8,0,1,1,8-8A8,8,0,0,1,13,21Z" fill="#3a1bff"/>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" class="tr">
        <path data-name="Path 222" d="M19.395,112l10.256-10.256,2.115-2.115a.8.8,0,0,0,0-1.131L29.5,96.235a.8.8,0,0,0-1.131,0L16,108.606,3.629,96.234a.8.8,0,0,0-1.131,0L.234,98.5a.8.8,0,0,0,0,1.131L12.606,112,.234,124.372a.8.8,0,0,0,0,1.131L2.5,127.766a.8.8,0,0,0,1.131,0L16,115.395l10.256,10.256,2.115,2.115a.8.8,0,0,0,1.131,0l2.263-2.263a.8.8,0,0,0,0-1.131Z" transform="translate(0 -96)" fill="#3a1bff"/>
    </svg>
</div>
<form class="flex tr" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-field tr" id="s"  name="s" placeholder="Search articles" value="<?php echo get_search_query(); ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32.005" viewBox="0 0 32 32.005" class="tr">
        <path d="M31.565,27.671l-6.232-6.232A1.5,1.5,0,0,0,24.271,21H23.252A12.995,12.995,0,1,0,21,23.252v1.019a1.5,1.5,0,0,0,.438,1.063l6.232,6.232a1.494,1.494,0,0,0,2.119,0L31.559,29.8A1.507,1.507,0,0,0,31.565,27.671ZM13,21a8,8,0,1,1,8-8A8,8,0,0,1,13,21Z" fill="#3a1bff"/>
    </svg>
    <input type="submit" value="search" />
</form>