<?php
    abstract class user_data{
        protected $agencia='';
        protected $conta='';
        protected $nome='';
        protected $saldo='';

    public function __construct($agencia, $conta, $nome, $sado){
        $this->agencia = $agencia;
        $this->conta = $conta;
        $this->nome = $nome;
        $this->saldo = $sado;
        }
    }
    
    class details_user_data extends user_data {
        public function getdetalhes(){
            return "Agencia : {$this->agencia}| Conta: {$this->conta}| Nome: {$this->nome}| Saldo: {$this->saldo}<br />";
        }
    }

    class ADM_conta extends details_user_data{
        public function deposito($deposito){
            $this->saldo += $deposito;
            echo "Deposito de: {$deposito} foi aprovado| Saldo atual: {$this->saldo}<br />";
        }
        public function saque ($saque){
            if($this->saldo >= $saque){
                $this->saldo -= $saque;
                return "Saque de: {$saque} foi aprovado| Saldo atual: {$this->saldo}<br />";
            }else{
                return "Saque de: {$saque} nao foi aprovado| Saldo atual: {$this->saldo}<br />";
            }
        }
        public function transferencia($valor_transferir, $agencia = '', $conta = ''){
            if(empty($agencia)){
                return "A transferencia nao pode ser executada por falta de nao ter agencia destinatario";
            }elseif(empty($conta)){
                return "A transferencia nao pode ser executada por falta de nao ter conta destinatario";
            }elseif($valor_transferir == 0){
                return "Nao pode transferir nao pode ser zero| Saldo atual: {$this->saldo}<br />";
            }elseif($this->saldo >= $valor_transferir){
                $this->saldo -= $valor_transferir;
                return "A transferencia de: {$valor_transferir} foi aprovado para a agencia: {$agencia} e conta: {$conta}| Saldo atual: {$this->saldo}<br />";
            }else{
                return "A transferencia de: {$valor_transferir} nao foi aprovado para a agencia: {$agencia} e conta: {$conta}| Saldo atual: {$this->saldo}<br />";
            }
        }
        }  
    $conta=new ADM_conta('015','084287','Miguel Angels',5000.00);
    echo $conta->getdetalhes();
    echo $conta->deposito(1000);
    echo $conta->saque(300);
    echo $conta->getdetalhes();
    echo $conta->transferencia(0,'103','084756')
?>