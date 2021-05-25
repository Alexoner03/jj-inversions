<?php

namespace App\Http\Controllers;

use App\Mail\PromoMail;
use App\Models\Calculator;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class CalculatorController extends Controller
{
    public function index(){
        return Inertia::render('Calculator/Index',[
            'calculator' => Calculator::where('id',1)->first()
        ]);
    }

    public function update(Request $request,Calculator $calculator){
        
        $fields = $request->validate([
            'value' => 'numeric|required|min:1'
        ]);

        $calculator->update($fields);

        return redirect()->route('calculator.index')->with('flash','Valor Actualizado');
    }

    //para los potenciales clientes
    public function showCalculator(){
        return view('iframes.calc');
    }

    public function storeComunication(Request $request){
        $fields = $request->validate([
            'name' => 'string|required|min:3',
            'email' => 'email|required',
            'phone' => 'numeric|digits:9|regex:/^[9]{1}[0-9]{8}$/',
            'monto' => 'numeric|min:1',
            'acepto' => 'accepted|required',
        ]);
        
        Lead::create([
            'name' => $fields['name'],
            'phone' => $fields['phone'],
            'mail' => $fields['email'],
            'message' => "Contacto desde calculadora, el monto que desea invertir es de : {$fields['monto']}",
        ]);

        $calculator = Calculator::where('id',1)->first();

        $retribucion = sprintf('%.2f', $fields['monto'] + (($fields['monto'] * $calculator->value) / 100));

        Mail::to($fields['email'])->send(
            new PromoMail(
                'Resultado de Calculadora',
                "<br>Gracias por comunicarte con nosotros. <br> <span style=\"font-size : 24px\"><strong>Tu retribución en un año será de {$retribucion} USD</strong></span>",
                "Unete a nuestra red de inversores!"
            )
        );

        return redirect()->route('calculadora.index')->with('success','Gracias por contactarte te enviamos la información a tu correo. serás redirigido a la pagina principal en...');
    }
}
