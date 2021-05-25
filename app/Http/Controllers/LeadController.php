<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('store');   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Lead::orderBy('created_at','desc')->get();

        return Inertia::render('Leads/Index',[
            'leads' => $leads
        ]);
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
            'phone' => 'numeric|digits:9|regex:/^[9]{1}[0-9]{8}$/',
            'mail' => 'email|required',
            'message' => 'nullable|string|max:255',
        ]);

        Lead::create($fields);

        return response()->json([
            'message' => 'Gracias por contactarnos, nos comunicaremos en breve.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('lead.index')->with('flash','se eliminó el contacto');
    }
}
