// function fills(query,field) {


//     var xmlhttp;
//     xmlhttp = new XMLHttpRequest();
    
//     xmlhttp.onload = function() {
   
//    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

//         let arr= JSON.parse(xmlhttp.responseText);
//         console.log(arr)
//         query=1;
//     } else {
//     document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
//     }
//     }
//     xmlhttp.open("POST", "fetch.php?field=" + field, false);
//     xmlhttp.send();

// }
$(document).ready(function(){
    // Country
    $("#assign").hide();
    $('#stem').change(function(){
        // console.log("hello")

        var val = $("select#stem").val();
    // console.log(val);

        // AJAX request
        $.ajax({
            url: 'fetch.php',
            type: 'post',
            data: {request: 1, user: val},
            dataType: 'text',
            success: function(response){
            // console.log("hello")
              img=JSON.parse(response)
              document.getElementById("selectuser").src =img['image'];
              document.getElementById("selectName").innerHTML =img['name'];
              document.getElementById("selectPosition").innerHTML =img['position'];
              document.getElementById("selectEmail").innerHTML =img['email'];
              $("#assign").show();

                
            }
        });
        
    });
    
});