function xhrValidateForm(formId){
    let form = $('#' + formId);

    $(form).find('.invalid-feedback').remove();
    $(form).find('.is-invalid').removeClass('is-invalid');

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
                let ul = $.parseHTML('<ul class="invalid-feedback d-block pl-3" role="alert"></ul>');
                let li = $.parseHTML('<strong style="display: list-item"></strong>');

                fieldErrors.forEach(fieldError => {
                    $(li).html(fieldError);
                    $(ul).append(li);
                });

                let input = $(form).find('input[name=' + fieldName + ']');
                $(input).addClass('is-invalid');
                $(input).after(ul);
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