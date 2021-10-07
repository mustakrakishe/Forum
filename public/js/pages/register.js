function handleRegistration(event){
    event.preventDefault();
    $('.errors').remove();

    let form = event.target;
    let validationUrl = $(form).attr('validation');
    let actionUrl = $(form).attr('action');
    // let data = new FormData(form);
    let data = getFormData($(form));

    $.post({
        url: validationUrl,
        data: data,
    })
    .done(() => {
        // location = actionUrl;
    })
    .fail(response => {
        console.log('fail');
        let errors = response.responseJSON.errors;
        
        for(let fieldName in errors){
            let fieldErrorMessages = errors[fieldName];
            let ulClassName = fieldName + '-errors';

            $('#' + fieldName).after('<ul class="' + ulClassName + ' errors mt-3 list-disc list-inside text-sm text-red-600"></ul>');
            
            fieldErrorMessages.forEach(fieldErrorMessage => {
                $('.' + ulClassName).append('<li>' + fieldErrorMessage + '</li>');
            });
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