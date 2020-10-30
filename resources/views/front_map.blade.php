@extends('layouts.map')

@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <!--div id="map" style="position: relative;overflow: hidden;margin-top: 0px;height: 850px">
    </div-->
     
<div class="container-fluid">
    <div class="row">
      <!--bus map -->
       <div id="map" style="position: relative;overflow: hidden;margin-top: 0px;">
        </div>

    </div>
    <div class="row">
       <div id="content">

        <div  class="col-md-6">
           <div class="form">
                <div class="note" style="margin-top: 20px; margin-bottom: 20px;">
                    <h2>Ajout des arrêts de bus</h2>
                </div>

                <form class="form-content" method="GET" action="{!! url('arret_bus') !!}">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <input type="text" class="form-control" name="libelle_arret" placeholder="Libelle d'arrêt de bus" value="" size="50"/>
                   </div>
                   <div class="form-group">
                     <input type="text" class="form-control"  name="lat" placeholder="lat" value=""/>
                   </div>
                    <div class="form-group">
                     <input type="text" class="form-control"  name="long" placeholder="long" value=""/>
                   </div>
                    <button type="submit" name="sub_arret" class="btn btn-primary" style="margin-top: 20px;font-family:sans-serif;font-size:12px;border-top-width: 0px;padding-top: 10px;padding-left: 15px;padding-right: 15px;padding-bottom: 10px;">Submit</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form">
                <div class="note" style="margin-top: 20px; margin-bottom: 20px;">
                    <h2>Ajout des lignes de bus</h2>
                </div>

                <form class="form-content" method="GET" action="{!! url('ligne') !!}">
                  {{ csrf_field() }}
                  <div class="form-group">
                     <input type="text" class="form-control"  name="lib_ligne" placeholder="Libelle de la ligne" value=""/>
                   </div>
                   <div class="form-group">
                        <h4 style="font-family:sans-serif;font-size:12px;">sélectionner les arrets de bus de cette ligne</h4>
                          <select multiple="multiple" class="form-control" name="selected_stations[]">
                              @foreach ($lib_arrets as $item)
                           <option>{{ $item }}</option>
                          @endforeach
                          </select>
                    </div>
                   <div class="form-group">
                     <input type="text" class="form-control"  name="color" placeholder="Couleur" value=""/>
                   </div> 
                    <button type="submit" name="sub_ligne" class="btn btn-primary" style="margin-top: 20px;font-family:sans-serif;font-size:12px;border-top-width: 0px;padding-top: 10px;padding-left: 15px;padding-right: 15px;padding-bottom: 10px;">Submit</button>
                </form>
            </div>

        </div>
          
    </div>


    </div>  

</div>


@endsection