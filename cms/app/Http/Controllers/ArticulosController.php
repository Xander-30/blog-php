<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulos;
use App\Blog;

class ArticulosController extends Controller
{
   /* public function traerArticulos(){*/
        public function index(){

        $blog = Blog::all();
        $articulos = Articulos::all();

        return view("paginas.articulos", array("articulos"=>$articulos,"blog"=>$blog));
    }
}
