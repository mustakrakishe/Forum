import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let MODAL_ID = '#create-topic-modal';
let CREATE_FORM_ID = '#create-topic-form';
let PAGE_TITLE_ID = '#page-title-container';

$(CREATE_FORM_ID).on('submit', tryCreateTopic);
$(MODAL_ID).on('hidden.bs.modal', hideModalHandler);
$(document).on('input', 'textarea', function(){
    Textarea.resize(this);
});

async function tryCreateTopic(event){
    event.preventDefault();

    let form = event.target;
    
    let response = await Form.xhtAction(form, true);

    console.log(typeof(response));
    console.log(response);
    
    // $(PAGE_TITLE_ID).after(newTopicView);
    // $(MODAL_ID).modal('hide');
}

function hideModalHandler(){
    Form.reset(CREATE_FORM_ID);
    Textarea.initSize('textarea');
}