@extends('adopter.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Details</h3>
              </div>
              <!-- /.card-header -->


              <!-- form start -->
              
                <div class="card-body">
                  <div class="form-group">
                    <label for="admin_email">Email address</label>
                    <input class="form-control" id="admin_email" disabled value="{{ Auth::guard('adopter')->user()->email }}" readonly="" style="background-color:#666666">
                  </div>
                  
                  <div class="form-group">
                    <label for="admin_name">Name</label>
                    <input id="account" type="text" class="form-control" value="{{ Auth::guard('adopter')->user()->name }}" name="admin_name">

                  </div>

                  <div class="form-group">
                    <label for="admin_company">Company</label>
                    <input type="text" class="form-control" value="{{ Auth::guard('adopter')->user()->company }}" id="company" name="admin_company">

                  </div>

                  <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" value="{{ Auth::guard('adopter')->user()->mobile }}" class="form-control" id="mobile" name="admin_mobile">
                  
                  </div>

                  
            
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button id="update_details" class="btn btn-primary">Update</button>
                </div>
              
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">My Address</h3>
              </div>
              <!-- /.card-header -->

                  <div class="card-body">

                    @if (empty(Auth::guard('adopter')->user()->city))
                      <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Your address info is required when creating a tag for adopter. Please update your address now.
                      </div>
                    @endif
                    

                    <div class="form-group">
                      <label for="street">Stree Address</label>
                      <input id="street" type="text" class="form-control" value="{{ Auth::guard('adopter')->user()->street_address }}" name="street">
                    </div>

                    

                    <div class="form-group">
                      <label for="city">City</label>
                      <input type="text" class="form-control" value="{{ Auth::guard('adopter')->user()->city }}" id="city" name="city">
                    </div>

                    <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" value="{{ Auth::guard('adopter')->user()->state }}" class="form-control" id="state" name="state">
                    </div>
                  </div>

                  <div class="card-footer">
                    <button id="update_address" class="btn btn-primary">Update My Address</button>
                  </div>

              
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection