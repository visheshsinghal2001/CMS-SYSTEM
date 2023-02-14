function final() {
    let a = document.getElementById("taskname1").value;
    let b = document.getElementById("desc").value;
    let c = document.getElementById("dead").value;
    let d = document.getElementById("stem").value;
    let e = document.getElementById("error");
    if (a == "" || b == "" || c == "" || d == ""  ) {
        e.innerHTML = "Please enter valid data";
    }
    else if ((new Date(c)).getTime() - (new Date()).getTime() < 100)
        e.innerHTML = "Please enter valid data";

    else {
        document.getElementById("contact").submit();
    }
}
function completed(a){
    let dig=document.getElementById("done")
    if(a==0){
        dig.innerHTML="Task assign failure";
        dig.classList.remove("hidden");
        dig.classList.add("error");

    }
    else{
        dig.innerHTML="Task assigned !!";
        dig.classList.remove("hidden");
        dig.classList.add("success");
    }
}