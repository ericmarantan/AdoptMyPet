@extends('adopter.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PENDING</span>
                <span class="info-box-number">
                {{$pending}}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PROCESSING</span>
                <span class="info-box-number">{{$processing}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">COMPLETED</span>
                <span class="info-box-number">{{$completed}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL</span>
                <span class="info-box-number">{{$totalCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Adopter's Name</th>
                      <th>Email Address</th>
                      <th>Status</th>
                      <th>Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($orders as $c)
                            <tr>
                                <td><a href="#" id="{{ $c->order_id }}" class="viewData" data-toggle="modal" data-target="#modal-sm">{{ $c->order_number }}</a></td>
                                <td>{{ $c->adopter_name }}</td>
                                <td>{{ $c->mailing_email }}</td>
                                @if ($c->order_status == 'COMPLETED')
                                  <td><span class="text-success">{{ $c->order_status }}</span></td>
                                @elseif($c->order_status == 'PROCESSING')
                                  <td><span class="text-primary">{{ $c->order_status }}</span></td>
                                @else
                                  <td><span class="text-info">{{ $c->order_status }}</span></td>
                                @endif
                                <td>{{ $c->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                              <td colspan="5"><small>No record found yet...</small></td>
                            </tr>
                        @endforelse
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="/adopter/order-new-tag" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="/adopter/manage-orders" class="btn btn-sm btn-secondary float-right">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            
            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                 
                  @forelse ($orders as $c)
                     <li class="item">
                     <div class="product-img">
                      <img src="{{ url('admin/images/idtag.png') }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{ $c->adopter_name }}
                        <span class="badge badge-warning float-right">${{ $c->price }}</span></a>
                      <span class="product-description">
                      {{ $c->product_name }} - {{ $c->adopter_name }}
                      </span>
                    </div>
                               
                     </li>
                  @empty
                            <li><small>No, record found yet..</small></li>
                  @endforelse

                  
                  
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection