<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'form_validation', 'template','upload','image_lib');
$autoload['drivers'] = array();
$autoload['helper'] = array('url');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('categoria_model', 'subcategoria_model', 'user_model', 'posts_model');
