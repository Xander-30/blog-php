<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Blog;

class BannerController extends Controller
{
    
    /*public function traerBanner(){*/

    public function index(){
        
        $blog = Blog::all();
        $banner = Banner::all();
        return view("paginas.banner", array("banner"=>$banner,"blog"=>$blog));
    }
}
