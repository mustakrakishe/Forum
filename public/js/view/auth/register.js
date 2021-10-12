import Form from "../../components/form.js";

let SUBMIT_ID = '#register-submit';
let FORM_ID = '#register-form';

$(SUBMIT_ID).on('click', async () => {
    let form = $(FORM_ID)

    let isValid = await Form.xhrValidate(form);

    if(isValid){
        $(FORM_ID).trigger('submit');
    }
})