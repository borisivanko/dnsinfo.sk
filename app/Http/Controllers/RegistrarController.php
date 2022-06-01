<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrarController extends Controller
{
    public function viewRegistrars(Request $request)
    {
        $column = $request->input('column');
        $direction = $request->input('direction');

        $search = $request->input('search');

        $search ? $registrars = DB::TABLE('registrars')
            ->orWhere('registrar_id', 'like', "%${search}%")
            ->orWhere('company', 'like', "%${search}%")
            ->orWhere('street_name', 'like', "%${search}%")
            ->orWhere('city_name', 'like', "%${search}%")
            ->orWhere('contact_phone', 'like', "%${search}%")
            ->orWhere('contact_email', 'like', "%${search}%")
            : $registrars = DB::table('registrars');

        return $column && $direction
            ? view('registrars_list', ['registrars' => $registrars->orderBy($column, $direction)->paginate(20)])
            : view('registrars_list', ['registrars' => $registrars->paginate(20)]);
    }

    public function viewRegistrar(Request $request, $id)
    {
        return view('registrar_detail', [
            'registrar' => DB::table('registrars')->where('registrar_id', $id)->first(),
            'domains' => DB::table('domains')->where('registrant_id', '=', $id)->paginate(20),
        ]);
    }
}
