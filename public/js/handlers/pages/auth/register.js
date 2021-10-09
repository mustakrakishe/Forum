function handleRegistration(){
    $('.invalid-feedback').remove();

    let form = $('#register-form');
    let url = $(form).attr('validation');
    let data = getFormData(form);

    $.post({
        url: url,
        data: data,
    })
    .done(response => {
        if(!response){
            $(form).trigger('submit');
        }
        else{
            $.each(response, (fieldName, fieldErrors) => {

                let container = $.parseHTML('<ul class="invalid-feedback d-block pl-3" role="alert"></ul>');

                fieldErrors.forEach(fieldError => {
                    $(container).append('<strong style="display: list-item">' + fieldError + '</strong>');
                });
                
                $('input[name=' + fieldName + ']').after(container);
            });
        }
    });
}