function validation(){    
    x = document.getElementById("email").value
    y = document.getElementById("checkbox").checked
    z = document.getElementById("err")
    z.innerHTML = "";
    if (x != ""){
        if (x.match("^.+\@.+\.(co)$")){
            z.innerHTML = "We are not accepting subscriptions from Colombia emails";
            return false;
        }
        else if (!(x.match("^.+\@.+[.][a-z][a-z][a-z]$"))) {
            z.innerHTML = "Please provide a valid e-mail address";
            return false;        
        }        
        else if (!(y)){
            z.innerHTML = "You must accept the terms and conditions";
            return false;
        }
        else {
            return true;
        }
    }
    else {
        z.innerHTML = "Email address is required";
        return false;
    }   
}