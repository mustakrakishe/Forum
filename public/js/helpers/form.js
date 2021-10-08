function getFormData(form){
    let keyValuePairs = form.serializeArray();
    let formData = Object.fromEntries(keyValuePairs.map(field => {
        return [field.name, field.value];
    }));

    return formData;
}