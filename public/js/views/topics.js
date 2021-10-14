import Form from "../components/form.js";

let MODAL_ID = '#create-topic-modal';
let FORM_ID = '#create-topic-form';
let PAGE_TITLE_ID = '#page-title-container';

let isValid = false
let form = $(FORM_ID);

$(form).on('submit', async (event) => {
    if(!isValid){
        event.preventDefault();
        isValid = await Form.xhrValidate(form);
        if(isValid){
            $(form).trigger('submit');
        }
    }
    else{
        let newTopicView = await Form.xhrAction(form);
        $(PAGE_TITLE_ID).after(newTopicView);
        $(MODAL_ID).modal('hide');
    }
})