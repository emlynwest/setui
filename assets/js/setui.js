$(document).ready(function(){

    // Hide any children as long as the branch is not active
    $('.setui-leaf')
        .not('.setui-active')
        .find('ul')
        .hide();

    // Make sure the content can be shown and hidden
    $('.setui-link').on('click', function(element){
        element.preventDefault();
        $('#' + $(this).data('parent'))
            .find('ul')
            .slideToggle(200);
    });
});
