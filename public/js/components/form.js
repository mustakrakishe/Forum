class Form{
    
    static formatWithErrors(form, errors){
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