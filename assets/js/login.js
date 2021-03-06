$('#txtCpf').mask('000.000.000-00');

if (document.getElementById('txtNascimento') != 'undefined')
    $('#txtNascimento').mask('00/00/0000');


let frmRegistro = document.getElementById('frmRegistro');
if(frmRegistro != null && frmRegistro != 'undefined'){
    frmRegistro.addEventListener('submit', (event) => {
        if(!validarCadastro()){
            event.preventDefault();
        }
    });
}


function validarCadastro(){
    if(!validaCPF(document.getElementById('txtCpf').value)){
        alert('CPF inválido!')
        return false;
    }

    let nome = document.getElementById('txtNome').value;
    if(nome.length < 5){
        alert('Nome inválido!')
        return false;
    }

    let email = document.getElementById('txtEmail').value;
    if(!/.+@\w+\..+/.test(email)){
        alert('E-mail inválido!')
        return false;
    }

    if(!validarData(document.getElementById('txtNascimento').value)){
        alert('Data inválida!')
        return false;
    }

    return true;
}

let frmLogin = document.getElementById('frmLogin');
if(frmLogin != null && frmLogin != 'undefined'){
    frmLogin.addEventListener('submit', (event) => {
        if(!validaCPF(document.getElementById('txtCpf').value)){
            alert('CPF inválido!')
            event.preventDefault();
        }
    });
}