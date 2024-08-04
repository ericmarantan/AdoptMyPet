@extends('adopter.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Order New ID Tag for Adopter</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order New ID Tag</li>
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
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">ID Tag Setup</h3>
              </div>
              <!-- /.card-header -->


              <!-- form start -->
              
                <div class="card-body">

                <div class="form-group" style="text-align:center">
                    <h6><i class="nav-icon fas fa-shopping-bag"></i> Order Number: <span id="order_id">@php echo $numbers @endphp </span></h6>


                    <!-- <select name="product_list" id="product_list" class="form-control">
                      @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->product_name }} - ${{ $item->product_price }}</option>
                      @endforeach
                    </select> -->
                </div>

              <div class="row">
                <div class="col-md-6">
                  
                  <div class="callout callout-info">
                      <div class="form-group">
                          <h5>Adopter's Address <small>(Mailing Information)</small></h5>
                      </div>

                      <div class="form-group">
                          <label for="mailing_adopter_name">Full Name</label>
                          <input id="mailing_adopter_name" type="text" class="form-control">
                      </div>


                      <div class="form-group">
                          <label for="adopter_email">Email Address</label>
                          <input id="mailing_email" type="email" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="Street">Street Address</label>
                          <input id="mailing_street_address" type="text" class="form-control" placeholder="50th St">
                      </div>

                      <div class="form-group">
                          <label for="City">City, State, Zip</label>
                          <input id="mailing_city_state" type="text" class="form-control" placeholder="San Diego, California 92029">
                      </div>
                      <div class="form-group">
                          <label for="City">Note</label>
                          <textarea class="form-control" id="mailing_note" placeholder="Any special instructions for mail"></textarea>
                      </div>
                  </div> 

                </div>

                <div class="col-md-6">

                  <div class="callout callout-info">
                      <div class="form-group">
                          <h5>Back of Tag <small>(Adopter's Information)</small></h5>
                      </div>

                      <div class="form-group">
                          <label for="adopter_name">Adopter's Name / Pet Name</label>
                          <input id="adopter_name" type="text" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="phone">Phone Number</label>
                          <input id="phone" type="text" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="Street">Street Address</label>
                          <input id="street" type="text" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="City">City, State</label>
                          <input id="city" type="text" class="form-control">
                      </div>

                      <div class="form-group">
                          <h5>Custom Options <small>(Shape)</small></h5>
                      </div>
                      <div class="row">
                        <!-- <div class="col-md-6">
                          <div class="form-group">
                              <label for="color">Color</label>
                              <select name="color" id="color" class="form-control">
                              <option selected disabled="disabled">Color</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Purple">Purple</option>
                              </select>
                          </div>

                        </div> -->
                        <div class="col-md-6">
                          <div class="form-group">
                                <label for="shape">Shape</label>
                                <select name="shape" id="shape" class="form-control">
                                <option selected disabled="disabled">Select Tag Shape</option>
                                <option value="Heart">Heart</option>
                                <option value="Bone">Bone</option>
                              </select>
                            </div>

                        </div>
                      </div>
                  </div>

                </div>
              </div>
                
                 
            
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   
                  <div class="d-flex flex-row justify-content-between">
                    
                    <button id="order_btn" class="btn btn-primary">Order Now</button>
                    <div style="font-size: 24px;">
                        Total $<span id="total_price">5.00</span>
                    </div>

                  </div>

                </div>
              
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Actual Tag Info</h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-12 idtag">
                            <h4 class="text-center">FRONT TAG</h4>
                            <div class="adopter">
                              <div style="margin-top: 80px; line-height: 18px; font-weight: bold;">
                              <span id="accountId" style="display:none">{{ Auth::guard('adopter')->user()->id }}</span>
                                <span id="company_name">{{ Auth::guard('adopter')->user()->company }}</span><br />
                                <span id="company_street">{{ Auth::guard('adopter')->user()->street_address }}</span><br />
                                <span id="company_city">{{ Auth::guard('adopter')->user()->city }}, {{ Auth::guard('adopter')->user()->state }}</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-12 idtag">
                            <h4 class="text-center">BACK TAG</h4>
                            <div class="adopter">
                              <div style="margin-top: 80px; line-height: 18px; font-weight: bold;">
                                <span id="line1">Adopter's Name</span><br />
                                <span id="line2">Phone Number</span><br />
                                <span id="line3">Street Address</span><br />
                                <span id="line4">City, State</span>
                              </div>
                               
                            </div>
                        </div>
                    </div>
                    
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