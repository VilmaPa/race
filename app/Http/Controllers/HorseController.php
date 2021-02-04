<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;


class HorseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r) {
        if('name' == $r->sort) {
            $horses = Horse::orderBy('name')->get();
        }elseif('wins' == $r->sort){
            $horses = Horse::orderBy('wins')->get();
        } else{
            $horses = Horse::all();  //betkokia tvarka
        }
    
        //$horses = Horse::all();  //betkokia tvarka
        //$horses = Horse::orderBy('name', 'desc')->get();  //pagal varda atvirksciai
        //$horses = Horse::orderBy('name')->get();  //pagal varda 
        //$horses = Horse::orderBy('wins')->get();  //pagal laimetas
       return view('horse.index', ['horses' => $horses]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');

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
           'horse_name' => ['required', 'min:3', 'max:64'],
           'horse_runs' => ['required'],
           'horse_wins' => ['required', 'max:horse_runs'],   // tikrina, kad skaicius laimetu nebutu didesnis nei dalivautu
           'horse_about' => ['required', 'min:3', 'max:2000'],
        ],
        [
            'horse_name.required' => 'Įveskite arklio vardą.',
            'horse_name.min' => 'Vardas turi būti ilgesnis nei 3 raidžių.',
            'horse_name.max' => 'Vardas turi būti neilgesnis nei 64 raidžių.',
            'horse_runs.required' => 'Įveskite dalivautų varžybų skaičių.',
            'horse_wins.required' => 'Įveskite laimėtų varžybų skaičių.',
            'horse_wins.max' => 'Laimėtų varžybų skaičių negali būti didesnis nei dalivautų.',
            'horse_about.required' => 'Įveskite žirgo aprašymą.', 
            'horse_about.min' => 'Žirgo aprašymas turi būti ilgesnis nei 3 raidžių.',
            'horse_about.max' => 'Žirgo aprašymas turi būti neilgesnis nei 2000 raidžių.',
           
        // 'author_surname.min' => 'mano zinute'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }   
        $horse = new horse;
        $horse->name = $request->horse_name;
        $horse->runs = $request->horse_runs;
        $horse->wins = $request->horse_wins;
        $horse->about = $request->horse_about;
        $horse->save();
        return redirect()->route('horse.index')->with('success_message', 'Sekmingai įrašytas.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horse.edit', ['horse' => $horse]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make($request->all(),
        [
           'horse_name' => ['required', 'min:3', 'max:64'],
           'horse_runs' => ['required'],
           'horse_wins' => ['required', 'max:horse_runs'],
           'horse_about' => ['required', 'min:3', 'max:2000'],
        ],
        [
            'horse_name.required' => 'Įveskite arklio vardą.',
            'horse_name.min' => 'Vardas turi būti ilgesnis nei 3 raidžių.',
            'horse_name.max' => 'Vardas turi būti neilgesnis nei 64 raidžių.',
            'horse_runs.required' => 'Įveskite dalivautų varžybų skaičių.',
            'horse_wins.required' => 'Įveskite laimėtų varžybų skaičių.',
            'horse_wins.max' => 'Laimėtų varžybų skaičių negali būti didesnis nei dalivautų.',
            'horse_about.required' => 'Įveskite žirgo aprašymą.', 
            'horse_about.min' => 'Žirgo aprašymas turi būti ilgesnis nei 3 raidžių.',
            'horse_about.max' => 'Žirgo aprašymas turi būti neilgesnis nei 2000 raidžių.',
           
        // 'author_surname.min' => 'mano zinute'
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }   
        $horse->name = $request->horse_name;
        $horse->runs = $request->horse_runs;
        $horse->wins = $request->horse_wins;
        $horse->about = $request->horse_about;
        $horse->save();
        return redirect()->route('horse.index')->with('success_message', 'Sėkmingai pakeistas.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        if($horse->horseBetters->count()){
            return redirect()->route('horse.index')->with('info_message', 'Trinti negalima, nes turi statymų.');
           // return 'Can not be deleted, becouse this horse has bids.';
        }
 
        $horse->delete();
        return redirect()->route('horse.index')->with('success_message', 'Sekmingai ištrintas.');
        ;
 
    }
}
