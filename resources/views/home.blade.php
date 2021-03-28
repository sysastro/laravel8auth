<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <div class="col-md-12 mt-5">
    <div class="card">
      <div class="card-header">
        <h3>Dashboard</h3>
      </div>
      <div class="card-body">
        <h5>Selamat datang di halaman dashboard, <strong>{{ Auth::user()->name }}</strong>
          <a href="{{ route('logout') }}" class="btn btn-danger pull-right">Logout</a></h5>
        <h3>Users</h3>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
              <th scope="col">Created</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge badge-success">{{ isset($user->position) ? $user->position->status : '' }}</span></td>
                <td>{{ $user->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>