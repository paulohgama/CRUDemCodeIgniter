<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['usuario'] = 'Usuario/Mostrar';
$route['usuario/cadastrar'] = 'Usuario/Cadastro';
$route['usuario/editar/(:num)'] = "Usuario/Editar/$1";
$route['usuario/atualizar'] = "Usuario/Atualizar";
$route['usuario/excluir/(:num)'] = "Usuario/Excluir/$1";

$route['categoria'] = 'Categoria/Mostrar';
$route['categoria/cadastrar'] = 'Categoria/Cadastro';
$route['categoria/salvar'] = 'Categoria/Salvar';
$route['categoria/editar/(:num)'] = "Categoria/Editar/$1";
$route['categoria/atualizar'] = "Categoria/Atualizar";
$route['categoria/excluir/(:num)'] = "Categoria/Excluir/$1";

$route['subcategoria'] = 'Subcategoria/Mostrar';
$route['subcategoria/cadastrar'] = 'Subcategoria/Cadastro';
$route['subcategoria/editar/(:num)'] = "Subcategoria/Editar/$1";
$route['subcategoria/atualizar'] = "Subcategoria/Atualizar";
$route['subcategoria/excluir/(:num)'] = "Subcategoria/Excluir/$1";
