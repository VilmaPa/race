@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">LAŽYBININKAS</div>

               <div class="card-body">
                 <form method="POST" action="{{route('better.update',[$better])}}">
                 <div class="form-group">
                    <label>Lažybininko vardas</label>
                    <input type="text" class="form-control" name="better_name" value="{{old('better_name',$better->name)}}">
                    <small class="form-text text-muted">Name</small>
                </div>
                <div class="form-group">
                    <label>Lažybininko pavardė</label>
                    <input type="text" class="form-control" name="better_surname" value="{{old('better_surname',$better->surname)}}">
                    <small class="form-text text-muted">Surname</small>
                </div>
                <div class="form-group">
                    <label>Statymas</label>
                    <input type="text" class="form-control" name="better_bid" value="{{old('better_bid',$better->bid)}}">
                    <small class="form-text text-muted">Bid xx.xx EUR</small>
                </div>

       {{-- Name: <input type="text" name="better_name" value="{{old('better_name',$better->name)}}"> --}}
       {{-- Surname: <input type="text" name="better_surname" value="{{old('better_surname',$better->surname)}}"> --}}
       {{-- Bid: <input type="text" name="better_bid" value="{{old('better_bid',$better->bid)}}"> --}}
       <div class="form-group">
       <label>Žirgas</label>
       <select name="horse_id" class="form-control">
           @foreach ($horses as $horse)
               <option value="{{$horse->id}}" @if($horse->id == $better->horse_id) selected @endif>
                   {{$horse->name}} 
                </option>
           @endforeach
        </select>
        <small class="form-text text-muted">Please select horse.</small>
        </div>
       @csrf
       <button type="submit" class="btn btn-primary">EDIT</button>
</form>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection



