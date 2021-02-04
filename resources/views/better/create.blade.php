@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">PAVADINIMAS</div>

               <div class="card-body">
                 <form method="POST" action="{{route('better.store')}}">
   Name: <input type="text" name="better_name" value="{{old('better_name')}}">
   Surname: <input type="text" name="better_surname" value="{{old('better_surname')}}">
   Bid: <input type="text" name="better_bid" value="{{old('better_bid')}}">
   <select name="horse_id">
       @foreach ($horses as $horse)
           <option value="{{$horse->id}}">{{$horse->name}}</option>
       @endforeach
</select>
   @csrf
   <button type="submit">ADD</button>
</form>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection

