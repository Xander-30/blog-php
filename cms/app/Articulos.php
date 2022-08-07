<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table = 'articulos';

        /*======INNER DESDE EL MODELO======*/

        public function Categorias(){


            /*se utiliza la funcion belongTo*/
            return $this->belongsTo('App\Categorias','id_cat','id_categoria');
            /*instanciame el modelo categoria y buscame relacion entre estos 2 campos*/
        }
}
