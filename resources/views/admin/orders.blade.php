@extends('admin.layout.layout')
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
              <li class="breadcrumb-item"><a href="#">Orders</a></li>
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
                <h3 class="card-title">Manage Orders</h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Order Number</th>
                      <th>Account Name</th>
                      <th>Item Name</th>
                      <th>Adopter's Name</th>
                      <th>Email Address</th>
                      <th>Created At</th>
                      <th>Qty</th>
                      <th>Shape</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @forelse ($orders as $c)
                            <tr>
                                <td><a href="#" id="{{ $c->order_id }}" class="viewData" data-toggle="modal" data-target="#modal-lg">{{ $c->order_number }}</a></td>
                                <td>{{ $c->account_name }}</td>
                                <td>{{ $c->product_name }}</td>
                                <td>{{ $c->adopter_name }}</td>
                                <td>{{ $c->mailing_email }}</td>
                                <td>{{ $c->created_at }}</td>
                                <td>{{ $c->qty }}</td>
                                <td>{{ $c->shape }}</td>
                                <td>${{ $c->price }}</td>
                                @if ($c->order_status == 'COMPLETED')
                                  <td><span class="text-success">{{ $c->order_status }}</span></td>
                                @elseif($c->order_status == 'PROCESSING')
                                  <td><span class="text-primary">{{ $c->order_status }}</span></td>
                                @else
                                  <td><span class="text-info">{{ $c->order_status }}</span></td>
                                @endif
                                
                                <td><button id="{{ $c->order_id }}" class="btn btn-xs btn-primary deleteBtn">delete</button></td>
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

<div class="modal fade" id="modal-lg" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="order_title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Adopter's Info</h3>
                  </div>
                  <div class="card-body">
                    <table class="table table-borderless table-sm">
                            <tr>
                              <td>Account Id</td>
                              <td><span id="account_id"></span></td>
                            </tr>

                            <tr>
                              <td>Account Name</td>
                              <td><span id="account_name"></span></td>
                            </tr>
                            <tr>
                              <td>Adopter's Name</td>
                              <td><span id="adopter_name"></span></td>
                            </tr>

                            <tr>
                              <td>Phone Number</td>
                              <td><span id="phone"></span></td>
                            </tr>
                            
                            <tr>
                              <td>Email</td>
                              <td><span id="email"></span></td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td><span id="address_a"></span></td>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Mailling Address</h3>
                  </div>
                  <div class="card-body">
                    <table class="table table-borderless table-sm">
                            <tr>
                              <td>Fullname</td>
                              <td><span id="mailing_name"></span></td>
                            </tr>

                            <tr>
                              <td>Street Address</td>
                              <td><span id="mailing_street_address"></span></td>
                            </tr>
                            <tr>
                              <td>City / State / Zip</td>
                              <td><span id="mailing_city_state_zip"></span></td>
                            </tr>

                            <tr>
                              <td>Phone Number</td>
                              <td><span id="phone1"></span></td>
                            </tr>
                            <tr>
                              <td>Notes</td>
                              <td><span id="mailing_note"></span></td>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <p><h4>Status: <span id="order_status" class="bg-success color-palette px-1"></span></h4></p>
                  
                </div>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
              <button type="button" class="btn btn-primary btn-lg" id="processBtn">PROCESS</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
