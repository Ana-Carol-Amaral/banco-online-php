<?php

namespace app\controller;

use app\core\Controller;

class loginController extends Controller
{
    //#### VIEW ####
    public function login()
    {
        $this->view('externa/login');
    }

    /**
     * Carrega a view para cadastrar um usuário
     *
     * @return void
     */
    public function cadastro()
    {
        $this->view('externa/cadastro');
    }

    /**
     * Carrega a view para cadastrar um usuário
     *
     * @return void
     */
    public function negado()
    {
        $this->view('externa/message',[
            'message' => 'Você precisa fazer o login para acessar essa página.'
        ]);
    }



    //#### INTERNAL ####
    public function auth()
    {
        $cpf = filter_input(INPUT_POST, 'txtCpf', FILTER_SANITIZE_STRING);
        
        if(!validaCPF($cpf)){
            $this->view('externa/message', [
                'message' => 'CPF inválido!'
            ]);
            return;
        }

        $dirPath = DATA_PATH . '/' . trataCPF($cpf);
        if(!is_dir($dirPath)){
            $this->view('externa/message', [
                'message' => 'CPF não encontrado!'
            ]);
            return;
        }
        
        $filename = $dirPath . '/dados.txt';
        $data = json_decode(ler($filename));
        //Se estiver OK{
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['cpf'] = trataCPF($data->cpf);
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        setcookie('user_name', $data->nome, time() + 3600, '/');
        header('Location: ' . BASE . '?url=home');
        //}
    }

    public function register()
    {
        $formData = (object) [
            'nome' => filter_input(INPUT_POST, 'txtNome', FILTER_SANITIZE_STRING),
            'cpf' => filter_input(INPUT_POST, 'txtCpf', FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_EMAIL),
            'nascimento' => filter_input(INPUT_POST, 'txtNascimento', FILTER_SANITIZE_STRING),
            'dataCadastro' => date('d/m/Y H:i:s')
        ];

        //dd($formData);
        if (!$this->validate($formData)) {
            $this->view('externa/message', [
                'message' => 'Formulário inválido!'
            ]);
            return;
        }

        $dirPath = DATA_PATH . '/' . trataCPF($formData->cpf);

        if(is_dir($dirPath)){
            $this->view('externa/message', [
                'message' => 'O CPF informado já se encontra cadastrado.'
            ]);
            return;
        }

        criarDiretorio($dirPath);

        $path = $dirPath . '/dados.txt';

        gravar($path, json_encode($formData));
    
        $this->view('externa/message', [
            'message' => 'Cliente cadastrado com sucesso!'
        ]);
    }

    private function validate($formData)
    {
        if(!validaCPF($formData->cpf)){
            return false;
        }
    
        if(strlen($formData->nome) < 5){
            return false;
        }
    
        if(!preg_match('/.+@\w+\..+/', $formData->email)){
            return false;
        }
    
        if(!preg_match('/(\d){2}\/(\d){2}\/(\d){4}/', $formData->nascimento)){
            return false;
        }


        return true;
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['logado'])) {
            session_destroy();
        }

        header('Location: ' . BASE);
    }
}
