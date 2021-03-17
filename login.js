function checkLogin(){
    var email = document.forms["myForm"]["email"].value;
    var password = document.forms["myForm"]["Password"].value;

    if (email.length<1) {
        document.getElementById('error-email').textContent =  "*** Please Enter Your Email";
    }

    if (password.length<1) {
        document.getElementById('error-password').textContent = "*** Please Enter Your Password ";
    }

    if(email.length < 1 || password.length < 1){
        return false;
    }
}