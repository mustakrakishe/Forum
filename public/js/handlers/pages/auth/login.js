function handleAuth(){
    $('.errors').remove();

    let form = $('#auth');
    let url = $(form).attr('validationUrl');
    let data = getFormData(form);

    $.post({
        url: url,
        data: data,
    })
    .done(response => {
        if(response['status']){
            $(form).trigger('submit');
        }
        else if(response['message']){
            let messageBlock = $.parseHTML('<div class="errors mb-4 font-medium text-sm text-red-600"></div>');
            $(messageBlock).html(response['message']);
            $(form).before(messageBlock);
        }
        else if(response['errors']){
            $.each(response['errors'], (fieldName, fieldErrors) => {
                let ul = $.parseHTML('<ul class="errors mt-3 list-disc list-inside text-sm text-red-600"></ul>');
                fieldErrors.forEach(fieldError => {
                    let li = $.parseHTML('<li></li>');
                    $(li).html(fieldError);
                    $(ul).append(li);
                });
                
                $('#' + fieldName).after(ul);
            });
        }
    })
}