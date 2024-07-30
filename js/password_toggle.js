/* toggle-password */
var state = false;
function eyeToggle (){
    if (state) {
        document.getElementById("inputPassword").setAttribute("type", "password");
        document.getElementById("eye1").style.color='#666666';
        state = false;
    }
    else {
        document.getElementById("inputPassword").setAttribute("type", "text");
        document.getElementById("eye1").style.color='rgb(90, 139, 141)';
        state = true;
    }
}

var stateUpdate = false;
function eyeToggleUpdate (){
    if (stateUpdate) {
        document.getElementById("updatePassword").setAttribute("type", "password");
        document.getElementById("eyeUpdate").style.color='#666666';
        stateUpdate = false;
    }
    else {
        document.getElementById("updatePassword").setAttribute("type", "text");
        document.getElementById("eyeUpdate").style.color='rgb(90, 139, 141)';
        stateUpdate = true;
    }
}

var stateOld = false;
function eyeToggleOld (){
    if (stateOld) {
        document.getElementById("oldPassword").setAttribute("type", "password");
        document.getElementById("eyeOld").style.color='#666666';
        stateOld = false;
    }
    else {
        document.getElementById("oldPassword").setAttribute("type", "text");
        document.getElementById("eyeOld").style.color='rgb(90, 139, 141)';
        stateOld = true;
    }
}

var stateConfirm = false;
function eyeToggleConfirm (){
    if (stateConfirm) {
        document.getElementById("passwordConfirm").setAttribute("type", "password");
        document.getElementById("eyeConfirm").style.color='#666666';
        stateConfirm = false;
    }
    else {
        document.getElementById("passwordConfirm").setAttribute("type", "text");
        document.getElementById("eyeConfirm").style.color='rgb(90, 139, 141)';
        stateConfirm = true;
    }
}