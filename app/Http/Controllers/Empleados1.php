<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GstClases as GstClases;
use App\Models\Datos;





class Empleados1 extends Controller
{
    public function inicio()
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $data['roles'] = $GstEmpleados->getRoles();
        $data['areas'] = $GstEmpleados->getAreas();

        return view('inicio',$data);
    }

    public function listaCoindencia()
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $phone_data = $GstEmpleados->getPhonesData();
        $coincidencias=[];
        $file = fopen('../storage/app/black-list.csv', 'r');
        while (($line = fgetcsv($file ,1000, ";")) !== FALSE){

           
           $coincidencias[] =array_intersect($phone_data,$line);
          
        }  
     
        fclose($file);   
        $result=array_shift($coincidencias); 
        $data['phones']=$coincidencias;

        foreach($data['phones'] as $phone){
            if(empty($phone)){
                return redirect("/archivo")->withErrors(["La tabla está vacía."]);

            }
        }
        
        if(!$GstEmpleados->deletePhones($data)){
            return redirect("/archivo")->withErrors(["No se eliminaron los télefonos el archivo."]);

        }

            

        

               
        return view('listaCoinciden',$data);
    }

    public function descargarArchivo(Request $request)
    {
        $fileName = 'lista.csv';
        $data = Datos::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('phone', 'message');

        $callback = function() use($data, $columns) {
            
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $task) {
                if(is_numeric($task->phone)){
                    
                    $row['phone'] = $task->phone;
                    $row['message'] = $task->message;
                    fputcsv($file, array($row['phone'], $row['message']));      

                }
                            
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

        
    }
 
    public function listaMalos()
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $data['phones']=$GstEmpleados->getPhonesData();

        
        return view('listaMalos',$data);
    }

    public function archivo()
    {
        
        return view('archivo');
    }

    public function listar()
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $lista['lista'] = $GstEmpleados->list();

        return view('listar',$lista);
    }
    public function uploadFile(Request $request)
    {
        $fname = $_FILES['sel_file']['name'];
        echo 'Cargando nombre del archivo: '.$fname.' <br>';
        $chk_ext = explode(".",$fname);
       
      
        if(strtolower(end($chk_ext)) == "csv")
        {
            //si es correcto, entonces damos permisos de lectura para subir
            $filename = $_FILES['sel_file']['tmp_name'];
   
            $handle = fopen($filename, "r");
             
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
            {
              
                $datos = new Datos;
                $datos->phone = $data[0];
                $datos->message = $data[1];

                if(!$datos->save()){
                    return false;
                }

            }
            fclose($handle);
            
            return redirect("/archivo")->with('success',"Se subió el archivo con éxito.");
        } 
        else
        {
            return redirect("/archivo")->withErrors(["No se pudo subir el archivo."]);
        } 
    }

     public function registroProcess(Request $request)
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $validate = $request->validate([
            'nombre'=>'required|min:3|max:255',
            'email'=>'required|email|max:255',
            'area'=>'required',
            'descripcion'=>'required',
            'rol'=>'required',
            'sexo'=>'required',



           
        ]);

        $empleado['nombre']= trim(strtolower($request->input('nombre')));
        $empleado['email']= trim(strtolower($request->input('email')));
        $empleado['descripcion']= trim(strtolower($request->input('descripcion')));
        $empleado['sexo']= $request->input('sexo');
        $empleado['boletin']= $request->input('boletin');
        $empleado['rol']= $request->input('rol');
        $empleado['area']= $request->input('area');


        if(!$GstEmpleados->create($empleado)){
            return redirect("/")->withErrors(["No se pudo crear el empleado"]);
        }

        return redirect("/")->with('success',"Se creó el empleado con éxito");

            
    }
    public function deleteProcess($id)

    {
        $GstEmpleados = new GstClases\GstEmpleados;
        if(!$GstEmpleados->delete($id)){
            return redirect("/")->withErrors(["No se pudo eliminar el empleado"]);

        }

        return redirect("/")->with('success'," Se eliminó el empleado con éxito");

    }

    public function editar($id)
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $data['empleado'] = $GstEmpleados->getEmpleado($id);
        $data['roles'] = $GstEmpleados->getRoles();
        $data['areas'] = $GstEmpleados->getAreas();
        $data['rol'] = $GstEmpleados->getRolEmpleado($id);

        

        return view('editar',$data);
    }

    public function modificarProcess(Request $request)
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $validate = $request->validate([
            'nombre'=>'required|min:3|max:255',
            'email'=>'required|email|max:255',
            'area'=>'required',
            'descripcion'=>'required',
            'rol'=>'required',
            'sexo'=>'required',           
        ]);
        $empleado['id']= trim(strtolower($request->input('id')));
        $empleado['nombre']= trim(strtolower($request->input('nombre')));
        $empleado['email']= trim(strtolower($request->input('email')));
        $empleado['descripcion']= trim(strtolower($request->input('descripcion')));
        $empleado['sexo']= $request->input('sexo');
        $empleado['boletin']= $request->input('boletin');
        $empleado['rol']= $request->input('rol');
        $empleado['area']= $request->input('area');


        if(!$GstEmpleados->update($empleado)){
            return redirect("/")->withErrors(["No se pudo actualizar el empleado"]);

        }

        return redirect("/editar/".$empleado['id'])->with('success',"Se actualizó el empleado con éxito");

            
    }

}