<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container">
      <div>

        <h1>Register page</h1>
      </div>
                           {{-- url('api/register') --}}
    <form method="POST" action="{{url('api/register')}}">
        @csrf

    <div class="form-group">
          <label for=""></label>
          <input type="text"
            class="form-control" name="name" id="" aria-describedby="helpId" placeholder="name"/>
    
    </div>
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
</div>
</body>
</html>