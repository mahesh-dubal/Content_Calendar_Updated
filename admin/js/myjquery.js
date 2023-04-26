jQuery(document).ready(function($) {
    $('#my-custom-form').submit(function(e) {
        e.preventDefault();
        var form_data = $(this).serialize();
        console.log(form_data);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: form_data + '&action=my_form_submit',
            success: function(response) {
                $('#success-message').html(response);

            },
            
        });
    });
});



