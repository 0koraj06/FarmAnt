function sendLogin()
{
    var userField = document.getElementById('username');
    var passField = document.getElementById('password');
    var loginMessage = document.getElementById('loginMessage');
    
    var loginFields = [userField, passField];
    var error = false;
    
    for (index = 0; index < loginFields.length; index++)
    {
        var field = loginFields[index];
        field.style.borderColor = "initial";
        if(!field.value)
        {
            field.style.borderColor = "#800000";
            loginMessage.style.color = "#800000";
            loginMessage.innerHTML = "Field " + field.id + " cannot be empty.";
            error = true;
            break;
        }
    }
    if(error)
        return;
    
    loginMessage.style.color = "green";
    loginMessage.innerHTML = "Sending login request...";
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.addEventListener("load", loginCallback);
    xmlHttpRequest.open("GET", "./ajax/login.php?username=" + userField.value + "&password=" + passField.value);
    xmlHttpRequest.send();
    
}

function loginCallback(e)
{
    if(!e.target.responseText)
    {
        document.getElementById('loginMessage').style.color = "#800000";
        document.getElementById('loginMessage').innerHTML = "Invalid username or password.";
        return;
    }
    document.getElementById('loginMessage').style.color = "green";
    document.getElementById('loginMessage').innerHTML = e.target.responseText;
    updateLogin();
}

function updateLogin()
{
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.addEventListener("load", loginRedirect);
    xmlHttpRequest.open("GET", "./ajax/updatelogin.php");
    xmlHttpRequest.send();
}

function loginRedirect(e)
{
    if(!e.target.responseText)
        return;
    setTimeout(function() {
        window.location.href = e.target.responseText;
    }, 1000);
}