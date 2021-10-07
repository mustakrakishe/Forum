function handleRegistration(event){
    $('.errors').remove();

    let form = $('#registration');
    // let data = new FormData(form);
    let url = $(form).attr('validationUrl');
    let data = getFormData($(form));

    $.post({
        url: url,
        data: data,
    })
    .done(() => {
        $(form).trigger('submit');
    })
    .fail(response => {
        console.log('fail');
        let errors = response.responseJSON.errors;
        
        for(let fieldName in errors){
            let fieldErrorMessages = errors[fieldName];
            
            let ul = $.parseHTML('<ul class="errors mt-3 list-disc list-inside text-sm text-red-600"></ul>');
            fieldErrorMessages.forEach(fieldErrorMessage => {
                $(ul).append('<li>' + fieldErrorMessage + '</li>');
            });
            
            $('#' + fieldName).after(ul);
        }
    })
}

function getFormData(form){
    let keyValuePairs = form.serializeArray();
    let formData = Object.fromEntries(keyValuePairs.map(field => {
        return [field.name, field.value];
    }));

    return formData;
}