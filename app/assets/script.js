const formLogin = document.getElementById("form-login")
const formNewUser = document.getElementById("form-new-user")

// Calcular a força da senha
function forceSenha() {
    var senha = document.getElementById('password').value
    var force = 0

    if ((senha.length >= 6) && (senha.length <= 7)) {
        force += 10;
    } else if (senha.length > 7) {
        force += 25;
    }

    if ((senha.length >= 6) && (senha.match(/[a-z]+/))) {
        force += 10;
    }

    if ((senha.length >= 7) && (senha.match(/[A-Z]+/))) {
        force += 20;
    }

    if ((senha.length >= 8) && (senha.match(/[@#$%;*]+/))) {
        force += 25;
    }

    if (senha.match(/([1-9]+)\1{1,}/)) {
        force -= 25;
    }
    verForce(force)
}

function verForce(force) {
    // Imprime a força da senha
    if (force < 30) {
        document.getElementById("msgViewStrength").innerHTML = "<p style='color: #f00;'>Senha Fraca</p>";
    } else if ((force >= 30) && (force < 50)) {
        document.getElementById("msgViewStrength").innerHTML = "<p style='color: #ff8c00;'>Senha Média</p>";
    } else if ((force >= 50) && (force < 69)) {
        document.getElementById("msgViewStrength").innerHTML = "<p style='color: #7cfc00;'>Senha Boa</p>";
    } else if (force >= 70) {
        document.getElementById("msgViewStrength").innerHTML = "<p style='color: #008000;'>Senha Forte</p>";
    } else {
        document.getElementById("msgViewStrength").innerHTML = "";
    }
}

// Compara as senhas para inserir um usuário
function compareSenhas(){
    let senha = document.getElementById('password').value;
    let confirma = document.getElementById('confirmPass').value;

    if (senha === confirma) {
        document.getElementById("msgConfirmPass").innerHTML = ""
        return true;
    } else {
        document.getElementById("msgConfirmPass").innerHTML = "<p style='color: red;'>❌ As senhas não coincidem.</p>"
        return false;
    }
}

// Verificação da senha e seus atributos
function checkSenha(password){
    // Verificar se o campo senha possui 6 caracteres
    if (password.length < 6) {
        e.preventDefault();
        document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
        return;
    }

    // Verificar se o campo senha não possui números repetidos
    if (password.match(/([1-9]+)\1{1,}/)) {
        e.preventDefault();
        document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A senha não deve ter número repetido!</p>";
        return;
    }

    // Verificar se o campo senha possui letras
    if (!password.match(/[A-Za-z]/)) {
        e.preventDefault();
        document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A senha deve ter pelo menos uma letra!</p>";
        return;
    } else {
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
}

// Formulário de login
if(formLogin) {
    formLogin.addEventListener('submit', async(e)=> {
        var user = document.getElementById('user').value
        var senha = document.getElementById('password').value

        if (user === "") {
            e.preventDefault()
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        if (senha === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    })
}

// Formulário de um novo usuário
if (formNewUser) {
    formNewUser.addEventListener('submit', async(e)=> {
        var nome = document.getElementById('nome').value
        var email = document.getElementById('email').value
        var senha = document.getElementById('password').value
        var confirm = document.getElementById('confirmPass').value

        if (nome === "") {
            e.preventDefault()
            document.getElementById('msg').innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        if (email === "") {
            e.preventDefault()
            document.getElementById('msg').innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo e-mail!</p>";
            return;
        }

        if (senha === "") {
            e.preventDefault()
            document.getElementById('msg').innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

        if (confirm === "") {
            e.preventDefault()
            document.getElementById('msg').innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo confirmar senha!</p>";
            return;
        }

        // verifica se as senha conhecidem
        if(!compareSenhas()){
            e.preventDefault()
            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>As senhas não são identicas!</p>";
            return
        }
        
        checkSenha(senha)
    })
}