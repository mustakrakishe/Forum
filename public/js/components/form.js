class Form{

    static action(formId, action = null, method = null){
        let form = $('#' + formId);

        let ajaxSettings = {
            url: action
                || $(form).attr('action'),

            method: method
                || $(form).attr('method')
                || 'get',

            data:{},
        };

        if(method === 'post' || method === 'put' || method === 'patch'){
            ajaxSettings.data = this.getFormData(form);
            console.log(ajaxSettings.data);
        }
        
        return $.ajax(ajaxSettings);
    }
    
    static getFormData(form){        
        let keyValuePairs = form.serializeArray();
        let formData = Object.fromEntries(keyValuePairs.map(field => {
            return [field.name, field.value];
        }));

        return formData;
    }
    
    static validate(formId){
        let form = $('#' + formId);
        let url = $(form).attr('validation');
    
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');

        this.action(formId, url, 'post')
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
}