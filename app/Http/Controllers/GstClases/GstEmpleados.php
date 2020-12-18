<?php

namespace App\Http\Controllers\GstClases;

use App\Models\Empleados;
use App\Models\EmpleadoRol;
use App\Models\Areas;
use App\Models\Roles;

class GstEmpleados
{
    public function create($data)
    {
        
        $empleado = new Empleados;


        $empleado->nombre =strtolower($data['nombre']);
        $empleado->email =strtolower($data['email']);
        $empleado->descripcion =strtolower($data['descripcion']);
        $empleado->sexo = $data['sexo']['0'];
        $empleado->boletin = $data['boletin'];
        $empleado->area_id = $data['area'];

        if(!$empleado->save()){
            return false;
        }

        foreach($data['rol'] as $roles){
            $rol= new EmpleadoRol;

            $rol->empleado_id = $empleado->id;
            $rol->rol_id = $roles;

           
            if(!$rol->save()){

                return false;
            }
        }

        
        return $empleado;
    }

    public function list()
    {
        return $empleados = Empleados::all();
    } 

    public function delete($id)
    {
        $empleado= Empleados::find($id);
        
        if(!$empleado->delete()){
            return false;

        }
        return true;
    }

    public function getEmpleado($id)
    {
      return  $empleado= Empleados::find($id);

    }
    public function getRoles(){

        return  $roles= Roles::all();

    }
    public function getRolEmpleado($id){
        $roles=[];
        $rol= EmpleadoRol::select('rol_id')
        ->where('empleado_id',$id)
        ->get();
         foreach($rol as $r){
             $roles[]=$r->rol_id;
         }
         return $roles;


    }

    public function update($data)
    {
        
        $empleado= Empleados::find($data['id']);
        $empleado->nombre =strtolower($data['nombre']);
        $empleado->email =strtolower($data['email']);
        $empleado->descripcion =strtolower($data['descripcion']);
        $empleado->sexo = $data['sexo']['0'];
        $empleado->boletin = $data['boletin'];
        $empleado->area_id = $data['area'];

        if(!$empleado->update()){
            return false;
        }

        EmpleadoRol::where("empleado_id",$empleado->id)->delete();

        foreach($data['rol'] as $roles){
            $rol= new EmpleadoRol;

            $rol->empleado_id = $empleado->id;
            $rol->rol_id = $roles;

           
            if(!$rol->save()){

                return false;
            }
        }
        
        return true;
    }
}