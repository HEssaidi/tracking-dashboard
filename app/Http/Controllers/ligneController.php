<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Kreait\Firebase;

use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;

use Kreait\Firebase\Database;

use Session;

class ligneController extends Controller
{
   
     
   public function index(Request $request){
   	$factory = (new Factory)->withServiceAccount(__DIR__.'/bus-tracer-firebase-adminsdk-ig91d-96489d99dc.json');
   	$ligne=[
                  'lib_ligne' => $request->input('lib_ligne'),
                  'provideRouteAlternatives' => 'true',
                  'travelMode' => 'DRIVING',
                  'color' => $request->input('color'),
                  'strokeWeight' => 5
            ]; 
            
       $database = $factory->createDatabase();
       $ref = $database->getReference("Ligne")->push($ligne);

        //created key while pushing 
        $just_created_route_key=$ref->getKey();

            //get selected stations 
            $stations[]="";
            $selected_stations=$request->input('selected_stations');
            //Session::put('select_stats', $selected_stations);
            //var_dump($request->input($selected_stations));

            
            $ref_ArrLign = $database->getReference("arretLigne");
             foreach($selected_stations as $station)
                {
                  //select request
                 $data=$database->getReference('Arrets')
                                ->orderByChild("libelle_arret")
                                ->startAt($station)
                                ->endAt($station);    
                  //get keys from selected stations            
                  foreach ($data->getValue() as $id_select_stat => $value) {
                     $arret_ligne=[
                                     'idA' => $id_select_stat,
                                     'idL' => $just_created_route_key,
                                     'hDep' => 0
                                   ];
                        //and push into a new entry into BD arret/ligne           
                       $ref_ArrLign->push($arret_ligne);
                  }
                }
  

return redirect()->to('routes')->with('arr_selected_stat', $selected_stations);


  
 // $ref = $database->getReference("Ligne")->push($ligne);

  //created key while pushing 
  //$just_created_key=$ref->getKey();
    
       

}


}