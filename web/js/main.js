jQuery(function ($) {

    function handleAjaxLink(event) {
     
    event.preventDefault();

    let element = $(event.target),
        url     = element.attr('href'),
        params  = {}; 

        params = { mercadolibre_id: element.data('id'), 
                   name: element.data('name'), 
                   picture: element.data('picture'),
                 };

    let jqxhr = $.post( url, params, function( data ) {
        console.log(data);
    })
        .done(function() {
            alert( "second success" );
        })
        .fail(function() {
            alert( "error" );
        })
}
    function deleteProduct(event) {
     
    event.preventDefault();

    let element = $(event.target),
        url     = element.attr('href'),
        params  = {}; 

        params = { id: element.data('id')
                 };

    let jqxhr = $.post( url, params, function( data ) {
        console.log(data);
    })
        .done(function() {
            alert( "delete success" );
        })
        .fail(function() {
            alert( "error" );
        })
    }

    $('.addProduct').click(handleAjaxLink);
    $('.deleteProduct').click(deleteProduct);

})