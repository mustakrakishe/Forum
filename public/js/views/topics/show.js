import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

const EDIT_TOPIC_FORM = '#edit-topic-form';
const UPDATE_TOPIC_FORM = '#update-topic-form';
const TOPIC_SHOW_COMPONENT = "#topic-show-component";
const TOPIC_EDIT_COMPONENT = "#topic-edit-component";
const TOPIC_DESCRIPTION_TEXTAREA = "#topic-description";

const CREATE_COMMENT_FORMS = 'form[name=create-comment-form]';
const STORE_COMMENT_FORMS = 'form[name=store-comment-form]';
const EDIT_COMMENT_LINKS = 'a[name=edit-comment-link]';
const UPDATE_COMMENT_FORMS = 'form[name=update-comment-form]';
const COMMENT_SUB_TREES = '[name=comment-sub-tree]';
const TOPIC_COMMENTS_CONTAINER = "#topic-comments-container"
const COMMENT_CONTAINERS = '[name=comment-container]';
const COMMENT_CONTENT = '[name=content]';
const ANSWERS_CONTAINERS = '[name=answers-container]'
const COMMENT_SHOW_MODE_CONTENTS = '[name=show-mode-content]'
const COMMENT_EDIT_MODE_CONTENTS = '[name=edit-mode-content]'
const DELETE_COMMENT_MODAL = '#delete-comment-modal';
const DELETE_COMMENT_FORM = 'form#delete-comment-form';

let commentToDeleteContainer = null;

$(document).on('submit', EDIT_TOPIC_FORM, editTopicHandler);
$(document).on('submit', UPDATE_TOPIC_FORM, updateTopicHandler);
$(document).on('reset', UPDATE_TOPIC_FORM, cancelTopicEditHandler);

$(document).on('submit', CREATE_COMMENT_FORMS, createCommentHandler);
$(document).on('submit', STORE_COMMENT_FORMS, storeCommentHandler);
$(document).on('reset', STORE_COMMENT_FORMS, cancelCommentCreateHandler);
$(document).on('click', EDIT_COMMENT_LINKS, editCommentHandler);
$(document).on('submit', UPDATE_COMMENT_FORMS, updateCommentHandler);
// $(document).on('reset', UPDATE_COMMENT_FORMS, cancelUpdateCommentHandler);
$(document).on('show.bs.modal', DELETE_COMMENT_MODAL, fillDeleteCommentModal);
$(document).on('submit', DELETE_COMMENT_FORM, deleteCommentHandler);

async function editTopicHandler(event) {
    event.preventDefault();

    let updateFormView = await Form.xhrAction(EDIT_TOPIC_FORM);

    $(TOPIC_SHOW_COMPONENT).after(updateFormView);
    $(TOPIC_SHOW_COMPONENT).attr('hidden', 'hidden');

    Textarea.resize(TOPIC_DESCRIPTION_TEXTAREA);
}

async function updateTopicHandler(event){
    event.preventDefault();

    let isValid = await Form.xhrValidate(UPDATE_TOPIC_FORM);

    if (isValid) {
        let updatedTopicView = await Form.xhrAction(UPDATE_TOPIC_FORM);
        $(TOPIC_EDIT_COMPONENT).after(updatedTopicView);
        $(TOPIC_EDIT_COMPONENT).remove();
        $(TOPIC_SHOW_COMPONENT).remove();
    }
}

function cancelTopicEditHandler() {
    $(TOPIC_EDIT_COMPONENT).remove();
    $(TOPIC_SHOW_COMPONENT).removeAttr('hidden');
}

async function createCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let currentSubTree = $(form).closest(COMMENT_SUB_TREES);

    let createFormDestination = $(currentSubTree).find(ANSWERS_CONTAINERS).first()
    if($(createFormDestination).length == 0){
        createFormDestination = TOPIC_COMMENTS_CONTAINER;
    }

    let createForm = await Form.xhrAction(form);
    
    $(document).find(':focus').trigger('blur');
    $(createFormDestination).prepend(createForm);
}

async function storeCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let isValid = await Form.xhrValidate(form);

    if(isValid){
        let createdCommentSubTree = await Form.xhrAction(form);

        let currentCommentContainer = $(form).closest(COMMENT_CONTAINERS)
        $(currentCommentContainer).replaceWith(createdCommentSubTree);
    }
}

function cancelCommentCreateHandler(event) {
    $(event.target).closest(COMMENT_CONTAINERS).remove();
}

async function editCommentHandler(event){
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');
    let showModeContent = $(link).closest(COMMENT_SHOW_MODE_CONTENTS);

    let editModeContent = await Form.xhrAction(null, url, 'get');
    
    $(showModeContent).attr('hidden', 'hidden');
    $(showModeContent).after(editModeContent);
}

async function updateCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let commentContentContainer = $(form).closest(COMMENT_CONTENT);

    // let isValid = await Form.xhrValidate(form);

    let isValid = true;
    if (isValid) {
        let showModeContent = await Form.xhrAction(form);

        $(commentContentContainer).find(COMMENT_EDIT_MODE_CONTENTS).first().remove();
        $(commentContentContainer).find(COMMENT_SHOW_MODE_CONTENTS).first().replaceWith(showModeContent);
    }


}

function fillDeleteCommentModal(event){
    let deleteButton = $(event.relatedTarget);
    let commentId = deleteButton.val();

    commentToDeleteContainer = $(deleteButton).closest(COMMENT_SUB_TREES);
    
    let deleteUrl = $(DELETE_COMMENT_FORM).attr('action');
    let commentIdPos = deleteUrl.lastIndexOf('/') + 1;
    let newDeleteUrl = deleteUrl.slice(0, commentIdPos) + commentId;
    $(DELETE_COMMENT_FORM).attr('action', newDeleteUrl);
}

async function deleteCommentHandler(event){
    event.preventDefault();

    await Form.xhrAction(DELETE_COMMENT_FORM);

    $(commentToDeleteContainer).remove();

    $(DELETE_COMMENT_MODAL).modal('toggle');
}