<?php

namespace App\Http\Controllers;

use App\Arret;
use Illuminate\Http\Request;


use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class ArretController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //public STATIC $count = 0;
    public function index(Request $request)
    {
        

        $factory = (new Factory)->withServiceAccount(__DIR__.'/bus-tracer-firebase-adminsdk-ig91d-96489d99dc.json');
         
         $database = $factory->createDatabase();
 
          $arret_bus=[
                  'libelle_arret' => $request->input('libelle_arret'), ////////////////////////////////////
                  'lat' => $request->input('lat'), 
                  'long' => $request->input('long')
            ];

         //insert into route_bus collection 
       $ref = $database->getReference("Arrets")->push($arret_bus);
       


       //get all generated ids from DB 
        $keys_arrets[]="";
        $data__keys=$database->getReference('Arrets')->getChildKeys();
        foreach($data__keys as $id)
          { 
             $keys_arrets[]=$id;
         }



       //getting different stations from arret database
         $ref = $database->getReference("Arrets");   //need here !!!!!!!!!!!!!!!!!
       $ref->orderByChild('libelle');
       $values = $ref->getValue();
         $lib_arrets[]="";
        foreach($values as $a)
          {   
             foreach($a as $b=>$c)
               {
                
                 if ($b=="libelle_arret"){
                    $lib_arrets[] = $c;
                }
        
               }
          }
 return view('front_map', compact('lib_arrets'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arret  $arret
     * @return \Illuminate\Http\Response
     */
    public function show(Arret $arret)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arret  $arret
     * @return \Illuminate\Http\Response
     */
    public function edit(Arret $arret)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arret  $arret
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arret $arret)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arret  $arret
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arret $arret)
    {
        //
    }
}
