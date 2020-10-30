<?php

namespace App\Http\Controllers;

use App\ligne as ligne;
use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

use Session;
class arretligneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factory = (new Factory)->withServiceAccount(__DIR__.'/bus-tracer-firebase-adminsdk-ig91d-96489d99dc.json');
         
         $database = $factory->createDatabase();


        $arr_selected_stat=session()->get('arr_selected_stat');    //getted from firebase as a session 
        //print_r($arr_selected_stat);
         $Coords[]="";
        foreach ($arr_selected_stat as $key) {
            //select request
                 $data=$database->getReference('Arrets')
                                ->orderByChild("libelle_arret")
                                ->startAt($key)
                                ->endAt($key);    
                  //get keys from selected stations            
                  //print_r($data->getValue());
                  foreach ($data->getValue() as $id_select_stat => $value) {
                              foreach ($value as $key => $val) {
                                if ($key<>"libelle_arret"){
                                  $Coords[]=$val;
                                }
                              }
                  }
                }

                print_r($Coords);
                return view('front_map', compact('Coords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        



       // return redirect('/map');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ligne  $ligne
     * @return \Illuminate\Http\Response
     */
    public function show(ligne $ligne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ligne  $ligne
     * @return \Illuminate\Http\Response
     */
    public function edit(ligne $ligne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ligne  $ligne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ligne $ligne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ligne  $ligne
     * @return \Illuminate\Http\Response
     */
    public function destroy(ligne $ligne)
    {
        //
    }
}
