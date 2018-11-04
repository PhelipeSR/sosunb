<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation{

	public function edit_unique($str, $field) {
		sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
		return isset($this->CI->db)
			? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0)
			: FALSE;
	}

	public function valid_telephone_br($str, $field){
		if(!preg_match('/^\([0-9]{2}\) (?:[0-9][0-9]{1}|[1-5]{1})[0-9]{3}-[0-9]{4}$/', $str)){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function valid_cpf($str){
		$cpf = preg_replace('/[^0-9]/', '', (string) $str);
		// Verifica se nenhuma das sequências invalidas abaixo foi digitada
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
			return FALSE;
		}else {
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++)
					$d += $cpf{$c} * (($t + 1) - $c);
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d){
					return FALSE;
				}
			}
			return TRUE;
		}
	}

}