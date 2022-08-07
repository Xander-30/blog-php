<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncios;
use App\Blog;

class AnunciosController extends Controller
{
   
   /*public function traerAnuncios(){*/
  public function index(){
   
     $blog = Blog::all();
     $anuncios = Anuncios::all();

     return view("paginas.anuncios", array("anuncios"=>$anuncios,"blog"=>$blog));

   }


}



