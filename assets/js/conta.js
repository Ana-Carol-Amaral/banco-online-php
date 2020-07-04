let frmDeposito = document.getElementById('frmDeposito');
if(frmDeposito != null && frmDeposito != 'undefined'){
    frmDeposito.addEventListener('submit', (event) => {
        if(!validaDinheiro(valor)){
            alert('Informe o valor corretamente.');
            event.preventDefault();
        }
    });
}