@extends('admin.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active">Manage Accounts</li>
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
                <h3 class="card-title">List of Accounts</h3>
              </div>
              <!-- /.card-header -->

              @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              @endif
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              @endif

              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Account</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Company</th>
                      <th>Type</th>
                      <th>Created</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @forelse ($accounts as $c)
                            <tr>
                                <td>{{ $c->id }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->mobile }}</td>
                                <td>{{ $c->company }}</td>
                                <td>{{ $c->type }}</td>
                                <td>{{ $c->created_at }}</td>
                                <td>

                                @if ($c->status=='1')
                                <span class="badge badge-primary">ACTIVE</span>
                                @else
                                <span class="badge badge-danger">INACTIVE</span>
                                @endif
                                

                                </td>
                                <td>
                                <!-- <button type="button" class="btn btn-info btn-flat btn-xs"><i class="fas fa-eye"></i></button> -->
                                <button id="{{ $c->id }}" type="button" data-toggle="modal" data-target="#modal-info" class="btn btn-secondary btn-flat btn-xs edit"><i class="fas fa-edit"></i></button>
                                <button id="{{ $c->id }}" type="button" class="btn btn-danger btn-flat btn-xs delete"><i class="fas fa-trash"></i></button>
                                </td>
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


  <div class="modal fade" id="modal-info" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title"><span id="adp_name"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div id="account_data"></div>
                <br />
                <div class="frmo col-md-3">
                  <label for="">Update Status</label>
                    <select name="updateStat" id="updateStat" class="form-control form-control-sm">
                      <option value="1">ACTIVE</option>
                      <option value="0">INACTIVE</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light" id="updater">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

@endsection

