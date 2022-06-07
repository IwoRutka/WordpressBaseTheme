
<div id="success_message" class="alert alert-success" style="display: none;"></div>
<div id="error_message" class="alert alert-danger" style="display: none;"></div>

<form id="enquiry">
    <h2>Wyślij zapytanie</h2><br>


    <input type="hidden" name="registration" value="<?php the_field('registration');?>">

    <div class="mb-3">
        <div class="mb-3">
        <label class="form-label">Imię</label>
            <input type="text" name="fname" placeholder="First Name" class="form-control" required>
        </div>
        <div class="mb-3">
        <label class="form-label">Nazwisko</label>
            <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <div class="mb-3">
        <label class="form-label">Email</label>
            <input type="email" name="email" placeholder="Email Address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefon</label>
            <input type="tel" name="phone" placeholder="Phone" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
    <label class="form-label">Twoja wiadomość</label>
        <textarea name="enquiry" class="form-control" placeholder="Wpisz wiadomość" required></textarea>

    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-success">Wyślij zapytanie</button>

    </div>


</form>

<script>
(function($){
    $('#enquiry').submit( function(event){
        event.preventDefault();
        var endpoint = '<?php echo admin_url('admin-ajax.php');?>';
        var form = $('#enquiry').serialize();
        var formdata = new FormData;
        formdata.append('action', 'enquiry');
        formdata.append('nonce', '<?php echo wp_create_nonce('ajax-nonce');?>');
        formdata.append('enquiry', form);

        $.ajax(endpoint, {
            type:'POST',
            data:formdata,
            processData: false,
            contentType: false,
            success: function(res){
                $('#enquiry').fadeOut(200);
                $('#success_message').text('Zapytanie wysłane. Dziękujemy.').show();
                $('#enquiry').trigger('reset');
                // $('#enquiry').fadeIn(500);
            },
            error: function(err){
                alert(err.responseJSON.data);
            }
        })
    })
})(jQuery)

</script>