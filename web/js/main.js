jQuery(function ($) {

    function handleAjaxLink(event) {
     
    event.preventDefault();

    const link    = $(event.target),
          callUrl = link.attr('href');

    let jqxhr = $.post( callUrl, function( data ) {
        console.log(data.body);
    })
        .done(function() {
            alert( "second success" );
        })
        .fail(function() {
            alert( "error" );
        })
}
    $('#ajax_link_01').click(handleAjaxLink);

})