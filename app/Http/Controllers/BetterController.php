<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;
use App\Models\Horse;
use Validator;


class BetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$betters = Better::all();
        $betters = Better::orderBy('bid', 'desc')->get();
        return view('better.index', ['betters' => $betters]);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$horses = Horse::all();
        $horses = Horse::orderBy('name')->get();  //pagal varda 
        return view('better.create', ['horses' => $horses]);
 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
           'better_name' => ['required', 'min:3', 'max:64'],
           'better_surname' => ['required', 'min:3', 'max:64'],
           'better_bid' => ['required'],
        ],
        [
            'better_name.required' => 'Įveskite vardą.',
            'better_name.min' => 'Vardas turi būti ilgesnis nei 3 raidžių.',
            'better_name.max' => 'Vardas turi būti neilgesnis nei 64 raidžių.',
            'better_surname.required' => 'Įveskite pavardę.',
            'better_surname.min' => 'Pavardė turi būti ilgesnis nei 3 raidžių.',
            'better_surname.max' => 'Pavardė turi būti neilgesnis nei 64 raidžių.',
            'better_bid.required' => 'Įveskite statymo sumą.', 
        // 'author_surname.min' => 'mano zinute'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }   

        $better = new better;
        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bid = $request->better_bid;
        $better->horse_id = $request->horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'Sekmingai įrašytas.');

        //return redirect()->route('better.index');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        $horses = Horse::all();
        return view('better.edit', ['better' => $better, 'horses' => $horses]);
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {   
        $validator = Validator::make($request->all(),
        [
           'better_name' => ['required', 'min:3', 'max:64'],
           'better_surname' => ['required', 'min:3', 'max:64'],
           'better_bid' => ['required'],
        ],
        [
            'better_name.required' => 'Įveskite vardą.',
            'better_name.min' => 'Vardas turi būti ilgesnis nei 3 raidžių.',
            'better_name.max' => 'Vardas turi būti neilgesnis nei 64 raidžių.',
            'better_surname.required' => 'Įveskite pavardę.',
            'better_surname.min' => 'Pavardė turi būti ilgesnis nei 3 raidžių.',
            'better_surname.max' => 'Pavardė turi būti neilgesnis nei 64 raidžių.',
            'better_bid.required' => 'Įveskite statymo sumą.', 
        // 'author_surname.min' => 'mano zinute'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }   
        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bid = $request->better_bid;
        $better->horse_id = $request->horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'Sėkmingai pakeistas.');

        //return redirect()->route('better.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        
        $better->delete();
        return redirect()->route('better.index')->with('success_message', 'Sėkmingai ištrintas.');

       //return redirect()->route('better.index');

    }
}
