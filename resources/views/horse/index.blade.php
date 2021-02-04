@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ŽIRGŲ SĄRAŠAS</div>

               <div class="card-body">
               <a href="{{route('horse.index', ['sort'=>'name'])}}">Pagal vardą</a>
               <a href="{{route('horse.index', ['sort'=>'wins'])}}">Pagal laimėtų bėgimų sk.</a>
               <a href="{{route('horse.index')}}">Valyti filtrą</a>
               <hr>
                 @foreach ($horses as $horse)
  <a href="{{route('horse.edit', [$horse])}}">{{$horse->name}} {{$horse->runs}} {{$horse->wins}} </a> 
  {{-- {!!$horse->about!!} jei noreciau kazkur atvaizduoti formatuota teksta --}}
  <form method="POST" action="{{route('horse.destroy', [$horse])}}">
   @csrf
   <button type="submit">DELETE</button>
  </form>
  <br>
@endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection




