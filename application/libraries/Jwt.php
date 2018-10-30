<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jwt {

	public function decode($jwt) {
		$tks = explode('.', $jwt);
		if (count($tks) != 3) {
			return FALSE;
		}
		list($header64, $payload64, $signature64) = $tks;
		$header = json_decode($this->urlsafeB64Decode($header64));
		$payload = json_decode($this->urlsafeB64Decode($payload64));

		if ( $header === null || $payload === null ) {
			return FALSE;
		}

		$signature = $this->urlsafeB64Decode($signature64);
		if ($signature !== $this->sign($header64, $payload64)) {
			return FALSE;
		}
		return (array)$payload;
	}

	public function encode($payload) {
		$segments = array();

		$header = array(
			'typ' => 'jwt',
			'alg' => 'HS256'
		);

		$header =    $this->urlsafeB64Encode(json_encode($header));
		$payload =   $this->urlsafeB64Encode(json_encode($payload));
		$signature = $this->urlsafeB64Encode($this->sign($header,$payload));

		return "$header.$payload.$signature";
	}

	public function sign($header, $payload) {
		return hash_hmac('sha256', $header.".".$payload, JWT_KEY, TRUE);
	}

	public function urlsafeB64Decode($input) {
		$remainder = strlen($input) % 4;
		if ($remainder !== 0) {
			$padlen = 4 - $remainder;
			$input .= str_repeat('=', $padlen);
		}
		return base64_decode(strtr($input, '-_', '+/'));
	}

	public function urlsafeB64Encode($input) {
		return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
	}
}

