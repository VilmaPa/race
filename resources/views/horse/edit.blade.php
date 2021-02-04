@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>

               <div class="card-body">
                 <form method="POST" action="{{route('horse.update',[$horse->id])}}">
                 <div class="form-group">
                    <label>Arklio vardas</label>
                    <input type="text" class="form-control" name="horse_name" value="{{old('horse_name', $horse->name)}}">
                    <small class="form-text text-muted">Name</small>
                </div>
                <div class="form-group">
                    <label>Dalivautos varžybos</label>
                    <input type="text" class="form-control" name="horse_runs" value="{{old('horse_runs', $horse->runs)}}">
                    <small class="form-text text-muted">Runs</small>
                </div>
                <div class="form-group">
                    <label>Laimėtos varžybos</label>
                    <input type="text" class="form-control" name="horse_wins" value="{{old('horse_wins', $horse->wins)}}">
                    <small class="form-text text-muted">Wins</small>
                </div>
                <div class="form-group">
                    <label>Žirgo aprašymas</label>
                    <textarea name="horse_about" class="form-control" id="default" cols="30" rows="10">  {{$horse->about}}  </textarea>
                    {{-- <textarea name="horse_about" class="form-control" id="summernote"></textarea> --}}
                    <small class="form-text text-muted">About</small>
                </div>
                {{-- kai uzsikraus puslapis ant sio laukelio paleisti summer --}}
                <script>
                    $(document).ready(function() {
                    $('#summernote').summernote();
                    });
                </script>


   {{-- Name: <input type="text" name="horse_name" value="{{old('horse_name', $horse->name)}}"> --}}
   {{-- Runs: <input type="text" name="horse_runs" value="{{old('horse_runs', $horse->runs)}}"> --}}
   {{-- Wins: <input type="text" name="horse_wins" value="{{old('horse_wins', $horse->wins)}}"> --}}
   {{-- About: <textarea name="horse_about" value="{{old('horse_about', $horse->about)}}"></textarea> --}}
   @csrf
   <button type="submit">EDIT</button>
</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection



