@extends('layouts.admin')

@section('content')

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee List</h3>
                 <a href="/new-employee" class="btn btn-primary float-right"> Add Employee <i class="fa fa-plus" aria-hidden="true"></i></a>
              </div>
              <!-- /.card-header -->
                <div class="card-body">

                  @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close float-right" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                  @endif

                  @if(!$employees->isEmpty())
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Desination</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>

                        @foreach($employees as $employee)
                          <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td><img src="{{asset('/thumbnails/'.$employee->photo)}}"></td>
                            <td>{{ $employee->designation->designation }}</td>
                            <td>
                                <a href="{{route('edit-employee',$employee->id)}}"><i class="fas fa-edit"></i></a>
                                <a href="{{route('delete-employee',$employee->id)}}"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                        @endforeach

                      </tbody>
                    </table>
                  @else
                      No records
                  @endif

                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->

          </div>
      
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
