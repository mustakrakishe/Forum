import Form from "../../components/form.js";
import * as Textarea from "../../components/textarea.js";

const TOPIC_COMMENTS_CONTAINER = "#topic-comments-container"
const COMMENT_CREATE_FORMS = 'form[name=create-comment-form]';
const COMMENT_STORE_FORMS = 'form[name=store-comment-form]';
const COMMENT_EDIT_LINKS = 'a[name=edit-comment-link]';
const COMMENT_UPDATE_FORMS = 'form[name=update-comment-form]';
const COMMENT_SUB_TREES = '[name=comment-sub-tree]';
const COMMENT_CONTAINERS = '[name=comment-container]';
const COMMENT_CONTENT = '[name=content]';
const ANSWERS_CONTAINERS = '[name=answers-container]'
const COMMENT_SHOW_MODE_CONTENTS = '[name=show-mode-content]'
const COMMENT_EDIT_MODE_CONTENTS = '[name=edit-mode-content]'
const COMMENT_DELETE_MODAL = '#delete-comment-modal';
const COMMENT_DELETE_FORM = 'form#delete-comment-form';

let commentToDeleteContainer = null;

$(document).on('submit', COMMENT_CREATE_FORMS, createCommentHandler);
$(document).on('submit', COMMENT_STORE_FORMS, storeCommentHandler);
$(document).on('reset', COMMENT_STORE_FORMS, cancelCommentCreateHandler);
$(document).on('click', COMMENT_EDIT_LINKS, editCommentHandler);
$(document).on('submit', COMMENT_UPDATE_FORMS, updateCommentHandler);
$(document).on('reset', COMMENT_UPDATE_FORMS, cancelEditCommentHandler);
$(document).on('show.bs.modal', COMMENT_DELETE_MODAL, fillDeleteCommentModal);
$(document).on('submit', COMMENT_DELETE_FORM, deleteCommentHandler);

async function createCommentHandler(event){
    event.preventDefault();

    let form = event.target;
    let currentSubTree = $(form).closest(COMMENT_SUB_TREES);

    let createFormDestination = $(currentSubTree).find(ANSWERS_CONTAINERS).first();
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

function cancelEditCommentHandler(event){
    let form = event.target;

    let commentContentContainer = $(form).closest(COMMENT_CONTENT);
    $(commentContentContainer).find(COMMENT_EDIT_MODE_CONTENTS).first().remove();
    $(commentContentContainer).find(COMMENT_SHOW_MODE_CONTENTS).first().removeAttr('hidden');

}

function fillDeleteCommentModal(event){
    let deleteButton = $(event.relatedTarget);
    let commentId = deleteButton.val();

    commentToDeleteContainer = $(deleteButton).closest(COMMENT_SUB_TREES);
    
    let deleteUrl = $(COMMENT_DELETE_FORM).attr('action');
    let commentIdPos = deleteUrl.lastIndexOf('/') + 1;
    let newDeleteUrl = deleteUrl.slice(0, commentIdPos) + commentId;
    $(COMMENT_DELETE_FORM).attr('action', newDeleteUrl);
}

async function deleteCommentHandler(event){
    event.preventDefault();

    await Form.xhrAction(COMMENT_DELETE_FORM);

    $(commentToDeleteContainer).remove();

    $(COMMENT_DELETE_MODAL).modal('toggle');
}