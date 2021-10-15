import Form from "../../components/form.js";
import resize from "../../components/textarea.js";

let MODAL_ID = '#create-topic-modal';
let CREATE_FORM_ID = '#create-topic-form';
let PAGE_TITLE_ID = '#page-title-container';
let TEXTAREA_ID = '#topic-description';

$(CREATE_FORM_ID).on('submit', async (event) => {
    event.preventDefault();

    let isValid = await Form.xhrValidate(CREATE_FORM_ID);

    if(isValid){
        let newTopicView = await Form.xhrAction(CREATE_FORM_ID);

        $(PAGE_TITLE_ID).after(newTopicView);
        
        $(MODAL_ID).modal('hide');
    }
})

$(TEXTAREA_ID).on('input', function(){
    resize(this);
})