jQuery(document).ready(function($) {
    Admin.init();
});
let Admin = {
    init() {
        this.setEventListeners();
    },
    setEventListeners() {
        jQuery('#reset-posts-container #reset-posts').click(Admin.resetPosts);
        jQuery('#reset-posts-container #reset-offers').click(Admin.resetOffers);
    },
    resetPosts() {
        //attach hidden input then submit the form
        Admin.attachPostsData();     
        jQuery('#post').submit();
    },
    attachPostsData() {
        let $buttonContainer = jQuery('#reset-posts-container');
        let inputField = '<input type="hidden" name="reset-post" value="post" />';
        $buttonContainer.append(inputField);
    },
    resetOffers() {
        //attach hidden input then submit the form
        Admin.attachOffersData();     
        jQuery('#post').submit();
    },
    attachOffersData() {
        let $buttonContainer = jQuery('#reset-posts-container');
        let inputField = '<input type="hidden" name="reset-offers" value="offers" />';
        $buttonContainer.append(inputField);
    }
}