<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'mount' => 'numeric|required|min:1',
            'percentage' => 'numeric|required|min:1',
            'investor_id' => 'numeric|required|exists:investors,id',
            'time_cant' => 'numeric|min:1|required',
            'time_type' => 'string|required|in:months,years'
        ]);

        $fields['ended_at'] = now()->add($fields['time_type'],$fields['time_cant']);

        unset($fields['time_cant'],$fields['time_type']);

        Investment::create($fields);

        return redirect()->route('investor.show',['investor' => $request->investor_id])->with('flash','La inversión ha sido registrada');
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        $fields = $request->validate([
            'mount' => 'numeric|required|min:1',
            'percentage' => 'numeric|required|min:1',
            'investment_state_id' => 'numeric|required|exists:investment_states,id'
        ]);

        $investment->update($fields);

        return redirect()->route('investor.show',['investor' => $investment->investor_id])->with('flash','La inversión ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        $investment->investment_state_id = 3;
        $investment->save();

        return redirect()->route('investor.show',['investor' => $investment->investor_id])->with('flash','La inversión ha sido eliminada');

    }
}
