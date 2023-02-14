const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
outgoing_id = form.querySelector(".outgoing_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "insert.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            // let data = xhr.response;
            // console.log(data);
            //   inputField.value = "";
              scrollToBottom();
              document.getElementById("sendit").value="";

          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr1 = new XMLHttpRequest();
    xhr1.open("POST", "getchat.php", true);
    xhr1.onload = ()=>{
      if(xhr1.readyState === XMLHttpRequest.DONE){
          if(xhr1.status === 200){
            let data = xhr1.response;
            console.log(data);
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr1.send("incoming_id="+incoming_id+"&outgoing_id="+outgoing_id);
}, 1000); // 1000 ms time

function scrollToBottom(){
    // chatBox.scrollTop = chatBox.scrollHeight;
  }
  