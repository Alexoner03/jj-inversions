<?php

namespace App\Http\Controllers;

use App\Mail\PromoMail;
use App\Models\Investment;
use App\Models\InvestmentState;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investors = Investor::all();
        
        return Inertia::render('Investors/Index', [
            'investors' => $investors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Investors/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'string|required|min:3',
            'last_name' => 'string|required|min:3',
            'email' => 'email|required|unique:investors,email',
            'dni' => 'string|required|unique:investors,dni',
            'phone' => 'required|unique:investors,phone',
        ]);

        Investor::create($fields);

        return redirect()->route('investor.index')->with('flash','El Inversionista ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Investor $investor)
    {
        // $investor->load('investments','investments.state');

        $investments = Investment::with('state')->where([
            ['investment_state_id','<>',3],
            ['investor_id','=',$investor->id]
        ])
        ->orderBy('created_at','desc')
        ->get();

        $states = InvestmentState::all();

        return Inertia::render('Investors/Detail',[
            'investor' => $investor,
            'investments' => $investments,
            'states' => $states
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function edit(Investor $investor)
    {
        return Inertia::render('Investors/Edit',[
            'investor' => $investor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investor $investor)
    {
        $fields = $request->validate([
            'name' => 'string|required|min:3',
            'last_name' => 'string|required|min:3',
            'email' => 'email|required|unique:investors,email,'.$investor->id,
            'dni' => 'string|required|unique:investors,dni,'.$investor->id,
            'phone' => 'numeric|required|unique:investors,phone'.$investor->id,
        ]);

        $investor->update($fields);

        return redirect()->route('investor.index')->with('flash','El Inversionista ha sido actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investor $investor)
    {
        $investor->delete();
        return redirect()->route('investor.index')->with('flash','El Inversionista ha sido eliminado');
    }


    /**mailing methods */

    public function mailingIndex(){
        return Inertia::render('Investors/Mailing',[
            "investors" => Investor::all()
        ]);
    }

    public function mailing(Request $request){

        $fields = $request->validate([
            'title' => 'string|required',
            'first_paragraph' => 'string|required|max:255',
            'second_paragraph' => 'string|nullable|max:255',
            'investors' => 'array|required'
        ]);

        if(!isset($fields['second_paragraph'])){
            $fields['second_paragraph'] = "";
        }
        
        if($fields["investors"][0] === 'all'){
            $investors = Investor::all();

            foreach ($investors as $investor) {
                Mail::to($investor->email)->queue(new PromoMail($fields['title'],$fields['first_paragraph'],$fields['second_paragraph']));
            }
        }else{

            foreach ($fields["investors"] as $investor_id) {

                $investor = Investor::find($investor_id);

                if($investor){
                    Mail::to($investor->email)->queue(new PromoMail($fields['title'],$fields['first_paragraph'],$fields['second_paragraph']));
                }
                
            }    

        }

        return redirect()->route('investor.index')->with('flash','correos enviados');
    }
}
