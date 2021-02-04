@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ŽIRGAS</div>

               <div class="card-body">
                 <form method="POST" action="{{route('horse.store')}}">
   Name: <input type="text" name="horse_name" value="{{old('horse_name')}}">
   Runs: <input type="text" name="horse_runs" value="{{old('horse_runs')}}">
   Wins: <input type="text" name="horse_wins" value="{{old('horse_wins')}}">
   About: <textarea name="horse_about" value="{{old('horse_about')}}"></textarea>
   @csrf
   <button type="submit">ADD</button>
</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection



