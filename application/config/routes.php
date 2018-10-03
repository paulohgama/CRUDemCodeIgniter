<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['usuario'] = 'Usuario/Mostrar';
$route['usuario/pega_dados'] = 'Usuario/PegaDados';
$route['usuario/subcategoria/(:num)'] = 'Usuario/Subcategoria';
$route['usuario/categoria'] = 'Usuario/Categoria';
$route['usuario/cadastrar'] = 'Usuario/Cadastro';
$route['usuario/salvar'] = 'Usuario/Salvar';
$route['usuario/editar/(:num)'] = "Usuario/Editar/$1";
$route['usuario/atualizar'] = "Usuario/Atualizar";
$route['usuario/excluir/(:num)'] = "Usuario/Excluir/$1";

$route['categoria'] = 'Categoria/Mostrar';
$route['categoria/pega_dados'] = 'Categoria/PegaDados';
$route['categoria/cadastrar'] = 'Categoria/Cadastro';
$route['categoria/salvar'] = 'Categoria/Salvar';
$route['categoria/editar/(:num)'] = "Categoria/Editar/$1";
$route['categoria/atualizar'] = "Categoria/Atualizar";
$route['categoria/excluir/(:num)'] = "Categoria/Excluir/$1";

$route['subcategoria'] = 'Subcategoria/Mostrar';
$route['subcategoria/pega_dados'] = 'Subcategoria/PegaDados';
$route['subcategoria/cadastrar'] = 'Subcategoria/Cadastro';
$route['subcategoria/salvar'] = 'Subcategoria/Salvar';
$route['subcategoria/editar/(:num)'] = "Subcategoria/Editar/$1";
$route['subcategoria/atualizar'] = "Subcategoria/Atualizar";
$route['subcategoria/excluir/(:num)'] = "Subcategoria/Excluir/$1";

$route['posts/criarpost'] = 'Posts/Criar';
$route['posts/usuario'] = 'Posts/Usuario';
$route['posts/pega_dados'] = 'Posts/PegaDados';
$route['posts/recortar'] = 'Posts/Recortar';
$route['posts'] = 'Posts/ListarPosts';
$route['posts/alterar'] = 'Posts/Atualizar';
$route['posts/editar/(:num)'] = 'Posts/Editar/$1s';
$route['posts/excluir/(:num)'] = 'Posts/Excluir/$1';
$route['posts/ver/(:num)'] = 'Posts/Ver/$1';