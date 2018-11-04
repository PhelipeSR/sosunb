<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Saida {

	protected $CI;
	private $dados = NULL;
	private $erro  = FALSE;
	private $msg_erro   = NULL;

	public function __construct(){
		$this->CI = &get_instance();
	}

	public function set_dados($value) {
		$this->dados = $value;
	}
	public function set_erro($value) {
		$this->erro = TRUE;
		if (is_array($value)) {
			$this->msg_erro = $value;
		}else{
			$this->msg_erro .= '<p class="m-0">'.$value.'</p>';
		}
	}

	public function retorno() {
		$this->CI->output
				->set_content_type('application/json')
				->set_output(json_encode(array(	'dados'    => $this->dados,
												'erro'     => $this->erro,
												'msg_erro' => $this->msg_erro,
		)));
	}
}
