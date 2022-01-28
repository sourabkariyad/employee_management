@extends('layouts.admin')

@section('content')

    <!-- Main content -->
    <div class="content" style="margin-top: 10px;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit Employee</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/edit-employee" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <label>Name</label>
                        <input type="text" name="name" required="required" class="form-control" value="{{ $employee->name}}">

                        <label>Email</label>
                        <input type="email" name="email" required="required" class="form-control" value="{{ $employee->email}}" disabled>

                        <label for="country">Designation</label>
                        <select class="form-control task-dropdown" name="designation" required>
                            <option value="">Select Task</option>
                            @foreach ($designations as $designation) 
                                <option value="{{$designation->id}}" {{ ($designation->id == $employee->desig_id)? "selected" : "" }}>
                                {{$designation->designation}}
                                </option>
                            @endforeach
                        </select>

                        <label for="photo">Photo</label><br>
                        @if($employee->photo != "")
                            <img src="{{asset('/thumbnails/'.$employee->photo)}}" width="70"><br><br>
                        @endif

                        <input type="file" name="photo" value=""><br>

                        <input type="hidden" name="id" value="{{ $employee->id}}">
                        <input type="submit" name="add_btn" class="btn btn-primary float-right" value="Update">
                    </form>
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
