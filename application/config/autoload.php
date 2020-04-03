<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'pagination');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','html','form', 'download', 'file');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('m_condicao', 'M_usuario', 'M_paciente');
