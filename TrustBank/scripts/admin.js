const form = document.getElementById("signupForm");
const adminnameError = document.getElementById("adminnameError");
const passwordError = document.getElementById("passwordError");
const bankcodeError = document.getElementById("bankcodeError");

form.addEventListener("submit", validateSignup);

function validateSignup(event) {
    const validAdminname = validateAdminname();
    const validPassword = validatePassword();
    const validBankcode = validateBankcode();

    if (!validAdminname || !validPassword || !validBankcode) {
        event.preventDefault();
    }
}

function validateAdminname() {
    const adminname = document.getElementById("adminname").value;

    if (adminname === "") {
        adminnameError.innerText = "Nome de administrador obrigatório!";
        return false;
    } else if (!adminname.match(/[a-zA-Z0-9]/)) {
        adminnameError.innerText = "O nome de administrador só pode conter letras e números.";
        return false;
    } else if (adminname.length < 6) {
        adminnameError.innerText = "O nome de administrador deve ter pelo menos 6 caracteres.";
        return false;
    } else {
        adminnameError.innerText = "";
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

function validateBankcode() {
    const bankcode = document.getElementById("bankcode").value;

    if (bankcode === "") {
        bankcodeError.innerText = "Código bancário obrigatório!";
        return false;
    } else if (bankcode.length !== 4 || !/^\d+$/.test(bankcode)) {
        bankcodeError.innerText = "O Código bancário deve conter exatamente 4 dígitos numéricos.";
        return false;
    } else {
        bankcodeError.innerText = "";
        return true;
    }
}
