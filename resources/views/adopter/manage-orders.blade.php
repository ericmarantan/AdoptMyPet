@extends('adopter.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active">Manage Orders</li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">List of Orders</h3>
              </div>
              <!-- /.card-header -->


              <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Order Number</th>
                      
                      <th>Item Name</th>
                      <th>Adopter's Name</th>
                      <th>Email Address</th>
                      <th>Created At</th>
                      <th>Qty</th>
                      <th>Shape</th>
                      <th>Price</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                        @forelse ($orders as $c)
                            <tr>
                                <td><a href="#" id="{{ $c->order_id }}" class="viewData" data-toggle="modal" data-target="#modal-sm">{{ $c->order_number }}</a></td>
                                
                                <td>{{ $c->product_name }}</td>
                                <td>{{ $c->adopter_name }}</td>
                                <td>{{ $c->mailing_email }}</td>
                                
                                <td>{{ $c->created_at }}</td>
                                <td>{{ $c->qty }}</td>
                                <td>{{ $c->shape }}</td>
                                <td>${{ $c->price }}</td>
                                <td>{{ $c->order_status }}</td>
                            </tr>
                        @empty
                            <tr>
                              <td colspan="5">No, record found yet..</td>
                            </tr>
                        @endforelse
                    
                    
                  </tbody>
                </table>
                <span id="info"></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (left) -->
          <!-- right column -->
   
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

