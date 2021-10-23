import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let CREATE_TOPIC_MODAL = '#create-topic-modal';
let CREATE_FORM_ID = '#create-topic-form';
let TOPICS = "[name=topic]";

$(document).on('submit', 'form#create-topic-form', tryCreateTopic);
$(document).on('hidden.bs.modal', CREATE_TOPIC_MODAL, hideModalHandler);
$(document).on('input', 'textarea', function(){
        Textarea.resize(this);
    });

async function tryCreateTopic(event){
    event.preventDefault();

    let form = event.target;
    
    let response = await Form.xhrAction(form, true);

    if(response.status === 1){
        
        $(TOPICS).first().before(response.view);
        $(CREATE_TOPIC_MODAL).modal('hide');
    }
}

function hideModalHandler(){
    Form.reset(CREATE_FORM_ID);
    Textarea.initSize('textarea');
}