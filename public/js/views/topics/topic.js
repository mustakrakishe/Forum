import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

// index
const CREATE_TOPIC_MODAL = '#create-topic-modal';
const CREATE_FORM_ID = '#create-topic-form';
const TOPIC_DESCRIPTION = '#topic-description';
const TOPICS = "[name=topic]";

// show
const TOPIC_EDIT_LINK = 'a#topic-edit-link';
const TOPIC_UPDATE_FORM = '#update-topic-form';
const TOPIC_SHOW_COMPONENT = "#topic-show-component";
const TOPIC_EDIT_COMPONENT = "#topic-edit-component";

// index
$(document).on('submit', 'form#create-topic-form', tryStoreTopicHandler);
$(document).on('hidden.bs.modal', CREATE_TOPIC_MODAL, hideModalHandler);
$(document).on('input', 'textarea', function(){
        Textarea.resize(this);
    });

// show
$(document).on('click', TOPIC_EDIT_LINK, editTopicHandler);
$(document).on('submit', TOPIC_UPDATE_FORM, updateTopicHandler);
$(document).on('reset', TOPIC_UPDATE_FORM, cancelTopicEditHandler);

// index
async function tryStoreTopicHandler(event){
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
    Textarea.initSize(TOPIC_DESCRIPTION);
}

// Topic.show
async function editTopicHandler(event) {
    event.preventDefault();

    let link = event.currentTarget;
    
    let response = await $.get({
        url: $(link).attr('href'),
    });

    if(response.status === 1){
        $(TOPIC_SHOW_COMPONENT).after(response.view);
        $(TOPIC_SHOW_COMPONENT).attr('hidden', 'hidden');
    
        Textarea.resize('textarea');
    }
}

async function updateTopicHandler(event){
    event.preventDefault();

    let form = event.target;
        
    let response = await Form.xhrAction(form, true);

    if (response.status === 1) {
        $(TOPIC_EDIT_COMPONENT).replaceWith(response.view);
        $(TOPIC_SHOW_COMPONENT).remove();
    }
}

function cancelTopicEditHandler() {
    $(TOPIC_EDIT_COMPONENT).remove();
    $(TOPIC_SHOW_COMPONENT).removeAttr('hidden');
}