import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let UPDATE_FORM = '#update-topic-form';
let SHOW_COMPONENT_ID = "#topic-show-component";
let EDIT_COMPONENT_ID = "#topic-edit-component";

$(document).on('click', 'a#topic-edit-link', editTopicHandler);
$(document).on('submit', UPDATE_FORM, updateTopicHandler);
$(document).on('reset', UPDATE_FORM, cancelEditHandler);
$(document).on('input', 'textarea', function(){
    Textarea.resize(this);
});

async function editTopicHandler(event) {
    event.preventDefault();

    let link = event.currentTarget;
    
    let response = await $.get({
        url: $(link).attr('href'),
    });

    if(response.status === 1){
        $(SHOW_COMPONENT_ID).after(response.view);
        $(SHOW_COMPONENT_ID).attr('hidden', 'hidden');
    
        Textarea.resize('textarea');
    }
}

async function updateTopicHandler(event) {
    event.preventDefault();

    let form = event.target;
    
    let response = await Form.xhrAction(form, true);

    if (response.status === 1) {
        $(EDIT_COMPONENT_ID).replaceWith(response.view);
        $(SHOW_COMPONENT_ID).remove();
    }
}

function cancelEditHandler() {
    $(EDIT_COMPONENT_ID).remove();
    $(SHOW_COMPONENT_ID).removeAttr('hidden');
}