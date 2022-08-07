<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opiniones;
use App\Blog;

class OpinionesController extends Controller
{
    /*public function traerOpiniones(){*/
      public function index(){

      $blog = Blog::all();
      $opiniones = Opiniones::all();
      
      return view("paginas.opiniones", array("opiniones"=>$opiniones,"blog"=>$blog));

    }


}
