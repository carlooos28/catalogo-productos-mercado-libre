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
console.log(params)
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
    $('.addProduct').click(handleAjaxLink);

})