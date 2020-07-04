<?php

namespace app\classes;
use app\classes\Extrato;

class Transacao
{
    private $path;
    private $saldo;

    public function __construct()
    {
        $cpf = $_SESSION['cpf'] ?? null;

        $this->path = DATA_PATH . '/' . trataCPF($cpf) . '/saldo.txt';
        if(file_exists($this->path))
            $this->saldo = ler($this->path);
        else
            gravar($this->path, '0', 'w+');
    }

    public function depositar($valor){
        $soma = (number_format(validarDinheiro($valor) + $this->saldo, 2, '.', ''));   
        gravar($this->path, $soma);
        //Texto para o extrato
        $mensagemExtrato = 'Deposito de:<span style="color: green"> R$' .validarDinheiro($valor) . '</span>*';
        (new Extrato())->setExtrato($mensagemExtrato);

        header('Location: ' . BASE . '?url=saldo');
    }

    public function getSaldo(){
        return $this->saldo;
    }
}
