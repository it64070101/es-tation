function Check111() {
    let fnamecheck = document.getElementById("FnameInput").value;
    let lnamecheck = document.getElementById("LnameInput").value;
    let phonecheck = document.getElementById("phoneInput").value;
    let emailcheck = document.getElementById("emailInput").value;
    let passcheck = document.getElementById("passInput").value;
    let addcheck = document.getElementById("addInput").value;

    if (fnamecheck.length < 3 && fnamecheck.length > 50) {
        alert("Firstname must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (lnamecheck.length < 3 && lnamecheck.length > 50) {
        alert("Lastname must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (phonecheck.length < 9) {
        alert("Phone number must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (emailcheck.length < 15 && emailcheck.length > 100) {
        alert("Firstname must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (passcheck.length < 10) {
        alert("Password must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else if (addcheck.length < 30 && addcheck.length > 200) {
        alert("Address must be filled out");
        document.getElementById("signbut2").value = "2";
        return false;
    }
    else {
        document.getElementById("signbut2").value = "1";
    }
}
