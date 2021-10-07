function handleRegistration(event){
    event.preventDefault();

    let form = event.target;
    let url = $(form).attr('action');
    // let data = new FormData(form);
    let data = getFormData($(form));

    $.post({
        url: url,
        data: data,
    })
    .done(response => {
        let res = JSON.parse(response)
        console.log('done');
        console.log(res);
    })
    .fail(response => {
        console.log('fail');
        let errors = response.responseJSON.errors;
        
        errors.forEach((errors, fieldNmae) => {
            console.log("fieldNmae:");
        })
    })
}

function getFormData(form){
    let keyValuePairs = form.serializeArray();
    let formData = Object.fromEntries(keyValuePairs.map(field => {
        return [field.name, field.value];
    }));

    return formData;
}