class Form{

    static xhtAction(form, hasValidation = false){
        let submit = $(form).find(':submit').first();

        if(hasValidation){
            this.#formatWithErrors(form);
        }

        let url = $(form).attr('action');
        let method = $(form).attr('method');
        let data = $(form).serialize();

        return $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),
            success: (response) => {
                if(hasValidation && response){
                    this.#formatWithErrors(form, response);
                }
            },
        })
    }
    
    static #formatWithErrors(form, errors = []){
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');

        $.each(errors, (fieldName, fieldErrors) => {
            let ul = $.parseHTML('<ul class="invalid-feedback d-block pl-3" role="alert"></ul>');
            let li = $.parseHTML('<strong style="display: list-item"></strong>');

            fieldErrors.forEach(fieldError => {
                $(li).html(fieldError);
                $(ul).append(li);
            });

            let input = $(form).find('[name=' + fieldName + ']');
            $(input).addClass('is-invalid');
            $(input).after(ul);
        });
    }
}

export default Form;