function Checkreg() {
    let fnamecheck = document.getElementById("FnameInput").value;
    let lnamecheck = document.getElementById("LnameInput").value;
    let phonecheck = document.getElementById("phoneInput").value;
    let emailcheck = document.getElementById("emailInput").value;
    let passcheck = document.getElementById("passInput").value;
    let addcheck = document.getElementById("addInput").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    if (fnamecheck.length == 0) {
        alert("Firstname must be filled out!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (fnamecheck.length < 3) {
        alert("Firstname too short!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (fnamecheck.length > 50) {
        alert("Firstname too long!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (lnamecheck.length == 0) {
        alert("Lastname must be filled out!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (lnamecheck.length < 3) {
        alert("Lastname too short!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (lnamecheck.length > 50) {
        alert("Lastname too long!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (phonecheck.length != 10) {
        alert("Invalid Phone Number!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (emailcheck.length == 0) {
        alert("Email must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (!emailcheck.match(validRegex)) {
        alert("Invalid Email!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    // else if (emailcheck.length < 15) {
    //     alert("Email too short!");
    //     document.getElementById("signbut2").value = "2";
    //     return false;
    // }
    // else if (emailcheck.length > 100) {
    //     alert("Email too long!");
    //     document.getElementById("signbut2").value = "2";
    //     return false;
    // }
    else if (passcheck.length == 0) {
        alert("Password must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (passcheck.length < 10) {
        alert("Password too short!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (addcheck.length == 0) {
        alert("Address must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (addcheck.length < 30) {
        alert("Address too short!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (addcheck.length > 200) {
        alert("Address too long!");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else {
        document.getElementById("signbut2").value = "1";
    }
}


function Check222() {

    let form1 = document.getElementById('dateForm');
    let fnamecheck = document.getElementById("fname2").value;
    let lnamecheck = document.getElementById("lname2").value;
    let phonecheck = document.getElementById("phone2").value;
    let emailcheck = document.getElementById("email2").value;
    let addcheck = document.getElementById("address2").value;
    let checkrad = document.querySelector('input[name="payment"]:checked');
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;


    if (fnamecheck.length == 0) {
        alert("Firstname must be filled out!");
        form1.action = 'checkout.php';
        // form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (fnamecheck.length < 3) {
        alert("Firstname too short!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (fnamecheck.length > 50) {
        alert("Firstname too long!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (lnamecheck.length == 0) {
        alert("Lastname must be filled out!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (lnamecheck.length < 3) {
        alert("Lastname too short!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (lnamecheck.length > 50) {
        alert("Lastname too long!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (phonecheck.length != 10) {
        alert("Invalid Phone Number!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (emailcheck.length == 0) {
        alert("Email must be filled out");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (!emailcheck.match(validRegex)) {
        alert("Invalid Email!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    // else if (emailcheck.length < 15) {
    //     alert("Email too short!");
    //     form1.action = 'checkout.php';
    //     document.getElementById("checkout1").value = "2";
    //     return false;
    // }
    // else if (emailcheck.length > 100) {
    //     alert("Email too long!");
    //     form1.action = 'checkout.php';
    //     document.getElementById("checkout1").value = "2";
    //     return false;
    // }
    else if (addcheck.length == 0) {
        alert("Address must be filled out");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (addcheck.length < 30) {
        alert("Address too short!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (addcheck.length > 200) {
        alert("Address too long!");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else if (checkrad == null) {
        alert("Payment must be filled out");
        form1.action = 'checkout.php';
        document.getElementById("checkout1").value = "2";
        return false;
    }
    else {
        alert("Thank For Purchase!");
        // form1.action = 'complete.php';
        // window.location.href = "complete.php" ;
        // return false;
        form1.action = 'complete.php';
        document.getElementById("checkout1").value = "1";
    }
}
