<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administradores;
use App\Blog;
use Illuminate\Support\Facades\Hash;

class AdministradoresController extends Controller
{
    //public function traerAdministradores(){
     
    /*========================================
      Muestra todos los registros de mi tabla
    =========================================*/

        /*se llama index porq es un metodo :Get*/

      public function index(){
        
        $blog = Blog::all();

         /*metodo all(traeme toda la info que encuentres es como el fetchall())*/
         /*instanciacion de la clase Blog*/
        $administradores = Administradores::all();

        return view("paginas.administradores", array("administradores"=>$administradores,"blog"=>$blog));

  }
     /*========================================
      Muestra un solo registro
    =========================================*/
        public function show($id){
            
            //traeme la info , buscala por el id y recorrela con el get
            $administradores = Administradores::where("id", $id)->get();
            $blog = Blog::all();

            if(count($administradores) != 0){  /*cuenta si tiene info*/

                /*retorname a la vista y que el array me bote un mensaje exitoso */
                 return view("paginas.administradores", array("status"=>200,"administradores"=>$administradores,"blog"=>$blog));

            }else{
                    /*en caso de que traiga un id que no exista*/
                 return view("paginas.administradores", array("status"=>404,"blog"=>$blog));
            }

     }

 /*========================================
      Editar un registro---Muestra un solo registro
    =========================================*/

      public function update($id, Request $request){

       // Recoger datos
       $datos = array("name"=>$request->input("name"),
       
                       "email"=>$request->input("email"),
                       "password_actual"=>$request->input("password_actual"),
                       "rol"=>$request->input("rol"),
                       "imagen_actual"=>$request->input("imagen_actual"));

       
      
      //para guardar la nueva contraseña 
      $password = array("password"=>$request->input("password"));
      $foto = array("foto"=>$request->file("foto"));

         // Validar los datos
        // https://laravel.com/docs/5.7/validation
      if(!empty($datos)){

           $validar = \Validator::make($datos,[

            'name' => "required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
            'email' => 'required|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i'

           ]);   
              

          /*si password no viene vacio osea si la cambia*/
          if($password["password"] != ""){

            $validarPassword = \Validator::make($password,[

                  "password" => "required|regex:/^[0-9a-zA-Z]+$/i"

              ]);

             /*sino pasa la prueba de la contraseña */
           if($validarPassword->fails()){

                return redirect("/administradores")->with("no-validacion", "");

              }else{

                $nuevaPassword = Hash::make($password['password']);

              }
              
      }else{

        $nuevaPassword = $datos["password_actual"];
      }


           /*si cambia la foto*/
          if($foto["foto"] != ""){

             $validarFoto = \Validator::make($foto,[

                  "foto" => "required|image|mimes:jpg,jpeg,png|max:2000000"

          ]);

              if($validarFoto->fails()){

                  return redirect("/administradores")->with("no-validacion", "");

              }

        }

        //sino llegan bien los datos
        if($validar->fails()){

               return redirect("/administradores")->with("no-validacion", "");

        }else{

        if($foto["foto"] != ""){

          if(!empty($datos["imagen_actual"])){

            if($datos["imagen_actual"] != "img/administradores/admin.png"){ 

              unlink($datos["imagen_actual"]);

    }

}

        $aleatorio = mt_rand(100,999);  

        $ruta = "img/administradores/".$aleatorio.".".$foto["foto"]->guessExtension();

        move_uploaded_file($foto["foto"], $ruta);

        }else{

          $ruta =  $datos["imagen_actual"];
        }


        $datos = array("name" => $datos["name"],
                       "email" => $datos["email"],      
                       "password" => $nuevaPassword,
                       "rol" => $datos["rol"],
                       "foto" => $ruta);

        $administrador = Administradores::where('id', $id)->update($datos);

        return redirect("/administradores")->with("ok-editar", "");


      }
       //si los datos vienen vacios
    }else{

      return redirect("/administradores")->with("error", "");


    }


  }
   /*=============================================
    Eliminar un registro
    =============================================*/

    public function destroy($id, Request $request){

      $validar = Administradores::where("id", $id)->get();
           
           /*preguntar si no viene vacio y diferenet a 1 con esto no eliminaremos el primer registro*/
      if(!empty($validar) && $id != 1){

          unlink($validar[0]["foto"]);

          $administrador = Administradores::where("id",$validar[0]["id"])->delete();

          //return redirect("/administradores")->with("ok-eliminar", "");

        //Responder al AJAX de JS
        return "ok";
      
      }else{

        return redirect("/administradores")->with("no-borrar", "");
   
      }

    }

}