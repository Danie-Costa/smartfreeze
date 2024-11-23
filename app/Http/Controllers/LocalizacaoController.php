<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class LocalizacaoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function cidadesPorEstado($estadoId, Request $request)
    {
        $cidades = City::where('state_id', $estadoId)->get();
        return response()->json($cidades);
    }

}
