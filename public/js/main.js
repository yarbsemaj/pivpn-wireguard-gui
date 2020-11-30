//Extend Jquery
jQuery.each( [ "put", "delete" ], function( i, method ) {
    jQuery[ method ] = function( url, data, callback, type ) {
        if ( jQuery.isFunction( data ) ) {
            type = type || callback;
            callback = data;
            data = undefined;
        }

        return jQuery.ajax({
            url: url,
            type: method,
            dataType: type,
            data: data,
            success: callback
        });
    };
});

$(()=>{
    $('#addProfileFrom').submit((e)=>{
        e.preventDefault();
        let name = $('#profileName').val();
        modalLoad('#add-profile')
        $.post( "/profile", { 'name': name})
            .done(()=>{
                window.location.href= `/profile/${name}?new=1`
            })
            .fail((data)=>{
                modalFinish('#add-profile')
                $('#profileNameValidation')
                    .html(data.responseJSON.message || data.responseJSON.consoleOutput)
                    .fadeIn()
            });
    });

    $('#remove-profile #submit').click((e)=>{
        console.log(e);
        let name = $(e.target).data('profile')
        modalLoad('#remove-profile')
        $.delete( `/profile/${name}`)
            .done(()=>{
                window.location.href= `/?removed=${name}`;
            })
            .fail((data)=>{
                modalFinish('#remove-profile')
                alert(data.responseJSON.message || data.responseJSON.consoleOutput);
            });
    });
})

function modalLoad(modal){
    $(modal+' #submit').hide();
    $(modal+' #loading').show();
}

function modalFinish(modal){
    $(modal+' #submit').show();
    $(modal+' #loading').hide();
}
