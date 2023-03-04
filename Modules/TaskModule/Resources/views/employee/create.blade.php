@extends('commonmodule::layouts.master')

@section('title')
    Add New
@endsection

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-dark fw-bolder my-1 fs-2">Employees</h1>
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{url('employees')}}" class="text-gray-600 text-hover-primary">Employees</a>
                </li>
                <li class="breadcrumb-item text-gray-600"><a href="#!">Add New</a></li>
            </ul>
        </div>
    </div>

          <!--begin:::Tab content-->
          <div class="tab-content" id="myTabContent">
              <!--begin:::Tab pane-->
              <div class="tab-pane fade show active" id="individual_client" role="tabpanel">
                  <div class="card pt-4 mb-6 mb-xl-9">
                      <!--begin::Card header-->
                      <div class="card-body pt-0">

                      <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <form  action="{{url('employees')}}"  method="POST" class="needs-validation" novalidate  enctype="multipart/form-data">
                              @csrf
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom04">Choose Company</label>
                                            <select name="company_id"   class="form-select" required>
                                                <option value="">Choose Company</option>
                                                @foreach($findAllCompanys as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('company_id'))
                                                @include('commonmodule::includes.error',['errors'=>$errors->toArray(),'filed'=>'company_id'])
                                            @endif
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Name</label>
                                        <input name="name" value="{{ old('name') }}" class="form-control" id="validationCustom01" placeholder="Name" value="Mark" required>
                                        <div class="invalid-feedback">

                                        </div>
                                        @if ($errors->has('name'))
                                          @include('commonmodule::includes.error',['errors'=>$errors->toArray(),'filed'=>'name'])
                                        @endif

                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Email</label>
                                        <input name="email" type="email" value="{{ old('email') }}" class="form-control" id="validationCustom01" placeholder="Email" value="Mark" required>
                                        <div class="invalid-feedback">

                                        </div>
                                        @if ($errors->has('email'))
                                          @include('commonmodule::includes.error',['errors'=>$errors->toArray(),'filed'=>'email'])
                                        @endif
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Password</label>
                                        <input name="password" type="password" value="{{ old('password') }}" class="form-control" id="validationCustom01" placeholder="Password" value="Mark" required>
                                        <div class="invalid-feedback">

                                        </div>
                                        @if ($errors->has('password'))
                                          @include('commonmodule::includes.error',['errors'=>$errors->toArray(),'filed'=>'password'])
                                        @endif
                                    </div>


                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Logo</label>
                                        <input class="form-control image" name="image" type="file">
                                        <div class="invalid-feedback">

                                        </div>
                                        @if ($errors->has('image'))
                                            @include('commonmodule::includes.error',['errors'=>$errors->toArray(),'filed'=>'image'])
                                        @endif
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('default.png') }}"  style="width: 100px;height: 100px" class="img-thumbnail image-preview" alt="">
                                    </div>


                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>


                      </div>
                  </div>
              </div>
          </div>

@stop

@section('js')
    <script  src="{{ asset('dashboard/js/forms/bootstrap_validation/bs_validation_script.js')}}" ></script>
    <script>

        // image preview
        $(".image").change(function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        });
    </script>
@endsection
