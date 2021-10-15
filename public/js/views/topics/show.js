import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let EDIT_FORM_ID = '#edit-topic-form';
let UPDATE_FORM_ID = '#update-topic-form';
let SHOW_COMPONENT_ID = "#topic-show-component";
let EDIT_COMPONENT_ID = "#topic-edit-component";

Textarea.resize('textarea');
$(document).on('submit', EDIT_FORM_ID, editTopicHandler);
$(document).on('submit', UPDATE_FORM_ID, updateTopicHandler);
$(document).on('reset', UPDATE_FORM_ID, cancelEditHandler);

async function editTopicHandler(event) {
    event.preventDefault();

    let updateFormView = await Form.xhrAction(EDIT_FORM_ID);

    $(SHOW_COMPONENT_ID).after(updateFormView);
    $(SHOW_COMPONENT_ID).attr('hidden', 'hidden');

    Textarea.resize('textarea');
}

async function updateTopicHandler(event) {
    event.preventDefault();

    let isValid = await Form.xhrValidate(UPDATE_FORM_ID);

    if (isValid) {
        let updatedTopicView = await Form.xhrAction(UPDATE_FORM_ID);
        $(EDIT_COMPONENT_ID).after(updatedTopicView);
        $(EDIT_COMPONENT_ID).remove();
        $(SHOW_COMPONENT_ID).remove();

        Textarea.resize('textarea');
    }
}

function cancelEditHandler() {
    $(EDIT_COMPONENT_ID).remove();
    $(SHOW_COMPONENT_ID).removeAttr('hidden');
    
    Textarea.resize('textarea');
}