jQuery(function ($) {

    function addProduct(event) {     

        let element = $(event.target),
            url     = element.attr('href'),
            params  = {}; 

            params = { mercadolibre_id: element.data('id'), 
                       name: element.data('name'), 
                       picture: element.data('picture'),
                     };

        let jqxhr = $.post( url, params, function( data ) {
            listProduct();
            alert( "Product Agregado!" );
        })
            .fail(function() {
                alert( "error" );
            })
    }

    function deleteProduct(event) {

        let element = $(event.target),
            url     = element.attr('href'),
            params  = {}; 

            params = { id: element.data('id') };

        let jqxhr = $.post( url, params, function( data ) {
            listProduct();
            alert( "Producto Eliminado!" );
        })
            .fail(function() {
                alert( "error" );
            })
    }

    function listProduct() {

        let url = "index.php?r=product%2Flist";

        let jqxhr = $.get( url, function( data ) { 
           
            $('table > tbody').empty();

            let dataTable = "";

            for (item in data.productList) {

                dataTable += `<tr>
                                <td>
                                    ${data.productList[item]._id.$id}
                                </td>                           
                                <td>
                                    ${data.productList[item].mercadolibre_id}
                                </td>
                                <td>
                                    ${data.productList[item].name}
                                </td>
                                <td>
                                    <img class="img-responsive rounded" src=${data.productList[item].picture} >                                    
                                </td>
                                <td>                                    
                                    <button class="btn btn-danger deleteProduct" href="/index.php?r=product%2Fdelete" data-id=${data.productList[item]._id.$id}>Eliminar</button>
                                </td>
                            </tr>`
            }

            $('table > tbody').html(dataTable);

        })
            .fail(function() {
                alert( "error" );
            })
    }

    $(document).on("click", ".addProduct", function(e) {
        e.preventDefault();
        addProduct(e);
    })

    $(document).on("click", ".deleteProduct", function(e) {
        e.preventDefault();
        deleteProduct(e);
    })

})