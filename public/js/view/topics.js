import Form from "../components/form.js";

let MODAL_ID = '#create-topic-modal';
let SUBMIT_ID = '#create-topic-submit';
let FORM_ID = '#create-topic-form';

$(SUBMIT_ID).on('click', async () => {
    let form = $(FORM_ID)

    let isValid = await Form.xhrValidate(form);

    if(isValid){
        let newTopicView = await Form.xhrAction(form);

        $('#page-title-container').after(newTopicView);

        $(MODAL_ID).modal('hide');
    }
})