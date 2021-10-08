function handleRegistration(){
    $('.errors').remove();

    let form = $('#registration');
    let url = $(form).attr('validationUrl');
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
                let ul = $.parseHTML('<ul class="errors mt-3 list-disc list-inside text-sm text-red-600"></ul>');
                fieldErrors.forEach(fieldError => {
                    $(ul).append('<li>' + fieldError + '</li>');
                });
                
                $('#' + fieldName).after(ul);
            });
        }
    });
}