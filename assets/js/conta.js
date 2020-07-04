var frmDeposito = document.getElementById('frmDeposito');
if(frmDeposito != null && typeof frmDeposito != 'undefined'){
    frmDeposito.addEventListener('submit', (event) => {
        
        let valor = getById('txtValor');
        
        if(!validaDinheiro(valor)){
            alert('Informe o valor corretamente.');
            event.preventDefault();
        }
    });
}

var frmSaque = document.getElementById('frmSaque');
if(frmSaque != null && typeof frmSaque != 'undefined'){
    frmSaque.addEventListener('submit', (event) => {
        let valor = getById('txtValor');
        let saldo = getById('txtSaldo');
        let tempValor = valor.replace(/[.,]/g, '');

        if(!validaDinheiro(valor) || tempValor <= 0) {
            alert ('Informe o valor para o saque.');
            event.preventDefault();        
        }

        if(!validaDinheiro(saldo)){
            alert('Saldo inválido!')
            event.preventDefault();        
        }

        let tempSaldo = saldo.replace(/[.,]/g, '');
    
        if(tempValor > tempSaldo){
            alert('Saldo insuficiente.');
            event.preventDefault();        
        }
    })
}