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
        let valor = getById('txtSaldo');
    
        if(!validaDinheiro(valor)) {
            alert ('Informe o valor para o saque.');
        }

        if(!validaDinheiro(saldo)){
            alert('Saldo inválido!')
        }

        let tempValor = valor.replace(/[.,]/g, '');
        let tempSaldo = saldo.replace(/[.,]/g, '');
    
        if(tempValor > saldo){
            alert('');
        }
        console.log(tempValor + ' - ' + tempSaldo);

        event.preventDefault();
    })
}