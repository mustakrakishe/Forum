function handleCancel(cancelBtn){
    let dialogBox = $(cancelBtn).closest('[role=dialog]');
    dialogBox.remove();
}