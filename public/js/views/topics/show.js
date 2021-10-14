import Form from "../../components/form.js";

let EDIT_FORM_ID = '#edit-topic-form';
let UPDATE_FORM_ID = '#update-topic-form';
let SHOW_COMPONENT_ID = "#topic-show-component";
let EDIT_COMPONENT_ID = "#topic-edit-component";
let CANCEL_EDIT_BTN_ID = "#cancel-edit-button";

$(EDIT_FORM_ID).on('submit', (event) => {
    event.preventDefault();
    editTopicHandler(EDIT_FORM_ID, SHOW_COMPONENT_ID, UPDATE_FORM_ID, EDIT_COMPONENT_ID, CANCEL_EDIT_BTN_ID);
});

async function editTopicHandler(editFormId, showComponentId, updateFormId, editComponentId, cancelEditBtnId){
    let updateFormView = await Form.xhrAction(editFormId);
    $(showComponentId).after(updateFormView);
    $(showComponentId).attr('hidden', 'hidden');
    
    $(updateFormId).on('submit', (event) => {
        event.preventDefault();
        updateTopicHandler(editFormId, showComponentId, updateFormId, editComponentId);
    });

    $(cancelEditBtnId).on('click', () => {
        cancelEditHandler(editComponentId, showComponentId);
    });
}

async function updateTopicHandler(editFormId, showComponentId, updateFormId, editComponentId){
    let fakeDescription = $(updateFormId).find('[name=fake-description]').html();
    let description = fakeDescription ? fakeDescription.trim() : '';

    $(updateFormId).find('[name=description]').val(description);

    let isValid = await Form.xhrValidate(updateFormId);
    
    if(isValid){
        let updatedTopicView = await Form.xhrAction(updateFormId);
        $(editComponentId).after(updatedTopicView);
        $(editComponentId).remove();
        $(showComponentId).remove();
        
        $(editFormId).on('submit', (event) => {
            event.preventDefault();
            editTopicHandler(editFormId, showComponentId, updateFormId, editComponentId);
        });
    }
}

function cancelEditHandler(editComponentId, showComponentId){
    $(editComponentId).remove();
    $(showComponentId).removeAttr('hidden');
}