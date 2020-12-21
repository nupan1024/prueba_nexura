<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GstClases as GstClases;



class Empleados1 extends Controller
{
    public function inicio()
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $data['roles'] = $GstEmpleados->getRoles();
        $data['areas'] = $GstEmpleados->getAreas();

        return view('inicio',$data);
    }

    public function listar()
    {
        $GstEmpleados = new GstClases\GstEmpleados;
        $lista['lista'] = $GstEmpleados->list();

        return view('listar',$lista);
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