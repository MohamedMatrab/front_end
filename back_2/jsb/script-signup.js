function getPswd() {
    let pass = document.getElementById("pswd").value;
    return pass;
  }
  
  function getPswdConfirm() {
    let passC = document.getElementById("pswd-confirm").value;
    return passC;
  }
  
  function verifySimilar() {
    let pass = getPswd();
    let passC = getPswdConfirm();
    const password_similar = document.getElementById("password_similar");
    let color = "";
    let passwordSimilar = "";
    if (pass !== passC) {
      color = "red";
      passwordSimilar="passwords are not similar";
    }
    else{
      color=""
    }
  }
  
  function CheckPasswordStrength() {
    let password = getPswd();
    var password_strength = document.getElementById("password_strength");
  
    //if textBox is empty
    if (password.length == 0) {
      password_strength.innerHTML = "";
      return;
    }
  
    //Regular Expressions
    var regex = new Array();
    regex.push("[A-Z]"); //For Uppercase Alphabet
    regex.push("[a-z]"); //For Lowercase Alphabet
    regex.push("[0-9]"); //For Numeric Digits
    regex.push("[$@$!%*#?&]"); //For Special Characters
  
    var passed = 0;
  
    //Validation for each Regular Expression
    for (var i = 0; i < regex.length; i++) {
      if (new RegExp(regex[i]).test(password)) {
        passed++;
      }
    }
  
    //Validation for Length of Password
    if (passed > 2 && password.length > 8) {
      passed++;
    }
  
    //Display of Status
    var color = "";
    var passwordStrength = "";
    switch (passed) {
      case 0:
        break;
      case 1:
        passwordStrength = "Password is Weak.";
        color = "Red";
        break;
      case 2:
        passwordStrength = "Password is Good.";
        color = "darkorange";
        break;
      case 3:
        break;
      case 4:
        passwordStrength = "Password is Strong.";
        color = "Green";
        break;
      case 5:
        passwordStrength = "Password is Very Strong.";
        color = "darkgreen";
        break;
    }
    if (passwordStrength === "") {
      password_strength.style.display = "none";
    } else {
      password_strength.style.display = "block";
      password_strength.innerHTML = passwordStrength;
      password_strength.style.color = color;
    }
  }
  const input_password = document.getElementById("pswd");
  input_password.addEventListener("change", CheckPasswordStrength);