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


var stateUpdate = false;
function eyeToggleUpdate_inactive (){
    if (stateUpdate) {
        document.getElementById("updatePassword_inactive").setAttribute("type", "password");
        document.getElementById("eyeUpdate_inactive").style.color='#666666';
        stateUpdate = false;
    }
    else {
        document.getElementById("updatePassword_inactive").setAttribute("type", "text");
        document.getElementById("eyeUpdate_inactive").style.color='rgb(90, 139, 141)';
        stateUpdate = true;
    }
}