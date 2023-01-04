<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistroFormRequest;

class RegistroController extends Controller
{
    public function create(Request $request)
    {
        $message = "";
        return view('registro.create', compact('message'));
    }

    public function store(RegistroFormRequest $request)
    {
        $data = $request->except('_token');
        $data['password'] = Hash::make($data['password']);
        $usuario = User::create($data);

        Auth::login($usuario);

        return redirect()->route('listar_series');        
    }
}
