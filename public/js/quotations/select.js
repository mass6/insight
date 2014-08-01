
jQuery( document ).ready( function( $ ) {

    $( '#form-select-request' ).on( 'submit', function() {

        //.....
        //show some spinner etc to indicate operation in progress
        //.....

        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "item_request": $( '#item_request_select' ).val()
            },
            function( data ) {
                //do something with data/response returned by server
                //console.log(data);

                if (data.success == true){
                    // set form elements value and visbility
                    document.getElementById('item_request').value = data.item_request;
                    document.getElementById('item_request_name').innerHTML = data.item_request_name;
                    document.getElementById('item_request_created').innerHTML = data.item_request_created;
                    var div = document.getElementById('form-container');
                    div.style.display = 'block';
                    document.getElementById('div_item_request_select').style.display = 'none';
                    var btn = document.getElementById('btn-add-quotation');
                    btn.style.display = 'none';
                    document.getElementById("selecthelper").style.visibility = "hidden";
                    var select = document.getElementById('item_request_select');
                    select.disabled = true;

                    // If selected Item Request contains attributes
                    if (data.attributes)
                    {
                        setAttributes(data.attributes);//
                    }
                }
            },
            'json'
        );

        //.....
        //do anything else you might want to do
        //.....

        //prevent the form from actually submitting in browser
        return false;
    } );

} );