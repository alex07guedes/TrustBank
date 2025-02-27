const form = document.getElementById("signupForm");
const usernameError = document.getElementById("usernameError");
const passwordError = document.getElementById("passwordError");
const nameError = document.getElementById("nameError");
const nifError = document.getElementById("nifError");


form.addEventListener("submit", validateSignup);

function validateSignup(event) {
    const validUsername = validateUsername();
    const validPassword = validatePassword();
    const validName = validateName();
    const validNif = validateNif();
 
    if (!validUsername || !validPassword || !validName || !validNif ) {
        event.preventDefault();
    }
}


function validateUsername() {
  const username = document.getElementById("username").value;

  if (username === "") {
    usernameError.innerText = "Nome de utilizador obrigatório!";
    return false;
  } else if (!username.match(/[a-zA-Z0-9]/)) {
    usernameError.innerText = "O nome de utilizador só pode conter letras e números.";
    return false;
  } else if (username.length < 6) {
    usernameError.innerText = "O nome de utilizador deve ter pelo menos 6 caracteres.";
    return false;
  } else {
    usernameError.innerText = "";
    return true;
  }
}

function validatePassword() {
  const password = document.getElementById("password").value;

  if (password === "") {
    passwordError.innerText = "Palavra-passe obrigatória!";
    return false;
  } else if (!password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]/)) {
    passwordError.innerText = "A palavra-passe deve conter pelo menos um caracter especial.";
    return false;
  } else if (password.length < 8) {
    passwordError.innerText = "A palavra-passe deve ter pelo menos 8 caracteres.";
    return false;
  } else {
    passwordError.innerText = "";
    return true;
  }
}

function validateName() {
  const name = document.getElementById("name").value;

  if (name === "") {
    nameError.innerText = "Nome completo obrigatório!";
    return false;
  } else if (name.length < 15) {
    nameError.innerText = "O nome completo deve ter pelo menos 15 caracteres.";
    return false;
  } else {
    nameError.innerText = "";
    return true;
  }
}

function validateNif() {
  const nif = document.getElementById("nif").value;

  if (nif === "") {
    nifError.innerText = "Número do NIF obrigatório!";
    return false;
  } else if (nif.length !== 9 || !nif.match(/[0-9]/)) {
    nifError.innerText = "O NIF deve conter exatamente 9 dígitos numéricos.";
    return false;
  } else {
    nifError.innerText = "";
    return true;
  }
}

