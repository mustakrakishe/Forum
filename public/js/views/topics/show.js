import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

let EDIT_TOPIC_FORM_ID = '#edit-topic-form';
let UPDATE_TOPIC_FORM_ID = '#update-topic-form';
let SHOW_COMPONENT_ID = "#topic-show-component";
let EDIT_COMPONENT_ID = "#topic-edit-component";

let CREATE_COMMENT_FORMS_NAME = 'form[name=create-comment-form]';
let COMMENT_COUNT_BLOCK_ID = '#comment-count';

$(document).on('submit', EDIT_TOPIC_FORM_ID, editTopicHandler);
$(document).on('submit', UPDATE_TOPIC_FORM_ID, updateTopicHandler);
$(document).on('reset', UPDATE_TOPIC_FORM_ID, cancelEditHandler);
$(document).on('submit', CREATE_COMMENT_FORMS_NAME, createCommentHandler);

async function editTopicHandler(event) {
    event.preventDefault();

    let updateFormView = await Form.xhrAction(EDIT_TOPIC_FORM_ID);

    $(SHOW_COMPONENT_ID).after(updateFormView);
    $(SHOW_COMPONENT_ID).attr('hidden', 'hidden');

    Textarea.resize('textarea#topic-description');
}

async function updateTopicHandler(event) {
    event.preventDefault();

    let isValid = await Form.xhrValidate(UPDATE_TOPIC_FORM_ID);

    if (isValid) {
        let updatedTopicView = await Form.xhrAction(UPDATE_TOPIC_FORM_ID);
        $(EDIT_COMPONENT_ID).after(updatedTopicView);
        $(EDIT_COMPONENT_ID).remove();
        $(SHOW_COMPONENT_ID).remove();
    }
}

function cancelEditHandler() {
    $(EDIT_COMPONENT_ID).remove();
    $(SHOW_COMPONENT_ID).removeAttr('hidden');
}

async function createCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let createCommentView = await Form.xhrAction(form);
    $(COMMENT_COUNT_BLOCK_ID).after(createCommentView);
}