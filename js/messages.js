var message_modal = document.getElementById('message_popup');
var message_modal_title = document.getElementById('message_title');
var message_span = document.getElementsByClassName('message_modal_close')[0];
var message_error = document.getElementById('message_modal_error_message');

var send_button = document.getElementById('modal_send');

function open_message(user_id, user_name)
{
    
    message_modal.style.display = "block";
    message_modal_title.innerHTML = "Message: " + user_name;
    message_error.style.display = "none";
    send_button.disabled = false;
    send_button.onclick = function() {
        send_button.disabled = true;
        send_message(user_id);
    };
}

function send_message(user_id)
{
    var subject = document.getElementById('user_subject');
    var content = document.getElementById('user_content');
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.addEventListener("load", messageCallback);
    xmlHttpRequest.open("GET", "./ajax/message.php?user=" + user_id + "&subject=" + subject.value + "&content=" + content.value.replace(/\r?\n/g, '<br />'));
    xmlHttpRequest.send();
}

function messageCallback(e)
{
    var status = e.target.status;
    var error = document.getElementById('message_modal_error_message');
    switch(status)
    {
        
        case 200:
        {
            error.innerHTML = "Your message has been sent.";
            error.style.color = "green";
            error.style.display = "block";
            message_span.onclick = function() {
                location.reload();
            };
            message_window.onclick = function(event)
            {
                if(event.target == message_modal)
                {
                    location.reload();
                }
            };
            break;
        }
        
        case 401:
        {
            error.innerHTML = "You must be logged in to message users.";
            error.style.display = "block";
            error.style.color = "#800000";
            break;
        }
        
        case 403:
        {
            error.innerHTML = "There is a server error.<br/>Please try again later.";
            error.style.display = "block";
            error.style.color = "#800000";
            break;
        }
 
    }
}

message_span.onclick = function() {
    
    message_modal.style.display = "none";
    
}

window.onclick = function(event) {
    
    if(event.target == message_modal)
    {
        message_modal.style.display = "none";
    }
    
}

