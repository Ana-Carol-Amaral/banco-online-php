<?php

namespace app\controller;

use app\core\Controller;
use app\classes\Transacao;

class ContaController extends Controller
{
    private $transacao;
    public function __construct()
    {
        //Habilita segurança nesses módulos
        security();

        $this->transacao = new Transacao();
    }

    //#### VIEW ####
    public function home()
    {
        $this->view('interna/home');
    }

    public function saldo()
    {
        $this->view('interna/saldo', [
            'saldo' => $this->transacao->getSaldo()
        ]);
    }

    public function extrato()
    {
        $extrato = str_replace('*', '<br>', (new \app\classes\Extrato())->getExtrato());
        $this->view('interna/extrato', [
            'extrato' => $extrato
        ]);
    }

    public function deposito()
    {
        $this->view('interna/deposito', [
            'saldo' => (new \app\classes\Transacao())->getSaldo()
        ]);
    }

    public function saque()
    {
        $this->view('interna/saque');
    }

    //#### INTERNAL ####

    public function depositar(){
        $valor = filter_input(INPUT_POST, 'txtValor', FILTER_SANITIZE_STRING);
        
        if(trim($valor) == '' || !$valor || str_replace([',', '.'], '', $valor) <= 0){
            $this->view('interna/message', [
                'message' => 'O valor informado não pode ser depositado.'
            ]);
            return;
        }
        
        $this->transacao->depositar($valor);
    }

    public function sacar(){
        $valor = filter_input(INPUT_POST, 'txtValor', FILTER_SANITIZE_STRING);
        
        if(trim($valor) == '' || !$valor || str_replace([',', '.'], '', $valor) <= 0){
            $this->view('interna/message', [
                'message' => 'O valor informado não pode ser sacado.'
            ]);
            return;
        }
        
        $this->transacao->sacar($valor);
    }
}


