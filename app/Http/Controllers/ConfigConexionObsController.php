<?php

namespace App\Http\Controllers;

use App\Models\ConfigConexionObs;
use Illuminate\Http\Request;

class ConfigConexionObsController extends Controller
{
    public function index()
    {
        $config = ConfigConexionObs::all();

        return view('ajustes.obs.index', compact('config'));
    }

    public function storeLocal(Request $request)
    {
        $validatedData = $request->validate([
            'ip_local'      => ['required', 'ip'],
        ]);

        try {
            $configIP = new ConfigConexionObs;
            $configIP->ip = $request->ip_local;
        
            if($configIP->save()) {
                return back()->with('success', 'IP configurado correctamente!');
            }

            return back()->with('warning', 'No se pudo agregar el IP, Intente de nuevo.');

        } catch (\Throwable $th) {
             return back()->with('error', 'Hubo un error al agregar el IP.');
        }

    }

    public function storeRemota(Request $request)
    {
        $validatedData = $request->validate([
            'ip_remota'      => ['required', 'ip'],
        ]);

        try {

            $config = ConfigConexionObs::all();

            if(!$config) {
                return back()->with('warning', 'Primero debe de establecer el IP local.');
            }


            $configIP = new ConfigConexionObs;
            $configIP->ip = $request->ip_remota;
        
            if($configIP->save()) {
                return back()->with('success', 'IP configurado correctamente!');
            }

            return back()->with('warning', 'No se pudo agregar el IP, Intente de nuevo.');

            
            //return back()->with('warning', 'Primero debe de establecer la direccioón IP Local.');

        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al agregar el IP.');
        }

    }

    public function updateLocal(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ip_local'      => ['required', 'ip'],
        ]);

        try {
            $configIP = ConfigConexionObs::find($id);
            $configIP->ip = $request->ip_local;
        
            if($configIP->save()) {
                return back()->with('success', 'IP Local actualizado correctamente!');
            }

            return back()->with('warning', 'No se pudo actualizar el IP, Intente de nuevo.');

        } catch (\Throwable $th) {
             return back()->with('error', 'Hubo un error al actualizar el IP.');
        }
    }

    public function updateRemote(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ip_remota'      => ['required', 'ip'],
        ]);

        try {
            $configIP = ConfigConexionObs::find($id);
            $configIP->ip = $request->ip_remota;
        
            if($configIP->save()) {
                return back()->with('success', 'IP Remota actualizado correctamente!');
            }

            return back()->with('warning', 'No se pudo actualizar el IP, Intente de nuevo.');

        } catch (\Throwable $th) {
             return back()->with('error', 'Hubo un error al actualizar el IP.');
        }
    }

    public function getIPAddress()
    {
        $config = ConfigConexionObs::all();

        if($config) {
            return $config;
        } else {
           
            return [];
        }
    }
}
