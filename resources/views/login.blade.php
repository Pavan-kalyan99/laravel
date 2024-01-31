@extends('layouts.main')
@section('main-section')
<h1 class="text-center">
CionLabs
</h1>
<div class="container">
  <div>

    <h1>Login page</h1>
  </div>
    <form method="POST" action="{{url('api/login')}}">
        @csrf

    <div class="form-group">
        <label for=""></label>
        <input type="email"
          class="form-control" name="email" id="" aria-describedby="helpId" placeholder="email"/>
  
  </div>
  <div class="form-group">
    <label for=""></label>
    <input type="password"
      class="form-control" name="password" id="" aria-describedby="helpId" placeholder="password"/>

</div>
<input type='submit'/>
</form>
<div>
  <a href="/">Back</a>
</div>
</div>
@endsection
