<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Inicia o processo de configuração para o envio do email
$config['protocol']    = 'smtp';
$config['smtp_port']   = 587;
$config['smtp_host']   = 'smtp.gmail.com';
$config['smtp_user']   = 'sosunb.contato@gmail.com';
$config['smtp_pass']   = 'sosunbgmail';
$config['validate']    = TRUE;
$config['smtp_crypto'] = "tls";
$config['mailtype']    = 'html';
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";