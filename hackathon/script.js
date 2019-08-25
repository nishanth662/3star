function validate(){

    let name = document.getElementById("demo").value;
    let phone = document.getElementById("demo1").value;
    let email = document.getElementById("demo2").value;
    let password = document.getElementById("demo3").value;
    let password = document.getElementById("demo4").value;
    
    if(name.value.length == 0 || email.value.length == 0 || phone.value.length == 0 || password.value.length == 0)
        alert("all field should be inserted");
    if(email.indexof(".") == -1 )
        alert("invalid email");
    if(phone.value.length != 10)
        alert("phone invalid");
    if(password.value.length < 8)
        alert("password invalid");
}