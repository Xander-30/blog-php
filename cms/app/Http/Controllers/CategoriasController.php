<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Blog;

class CategoriasController extends Controller
{
    /*public function traerCategorias(){*/
      public function index(){

        $blog = Blog::all();
        $categorias = Categorias::all();

        return view("paginas.categorias", array("categorias"=>$categorias,"blog"=>$blog));
    }
}
