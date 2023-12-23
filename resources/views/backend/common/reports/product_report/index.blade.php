@extends('backend.layouts.master')
@section('title', 'Product Report')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12  mb-10">

            <div class="card">
            <div class="border-top border-info">
                        <!--estimated annual area-->
                        <h3 class="text-center bg-info">Product Report</h3>
                        {!! Form::open(['route' => Request::segment(1) . '.productReportShow', 'method' => 'POST','class'=>'form']) !!}

                        <div class="row mx-auto">
                            <!-- form start -->
                           
                              <div class="form-group col-md-2">
                                <label for="start_date" class="form-control-label"> Start Date * </label>
                                {!! Form::date('start_date', null, ['class' => 'form-control','id' => 'start_date','required']) !!}

                            </div>
                            <div class="form-group col-md-2">
                                <label for="end_date" class="form-control-label"> End Date * </label>
                                {!! Form::date('end_date', date('Y-m-d'), ['class' => 'form-control','id' => 'end_date','required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                <label for="status" class="form-control-label"> Status * </label>
                                {!! Form::select('status', [3=>'All', 1=>'Active', 0=>'Deactive'],null, ['class' => 'form-control','id' => 'status','required']) !!}
                            </div>
                            <div class="form-group col-md-2">
                                <label for="status" class="form-control-label"> View As * </label>
                                <br>
                                    <label for="htmlview" class="form-control-label">
                                        <input type="radio"  name="previewtype" value="htmlview" checked id="htmlview">
                                        Html</label>
                                    <label for="pdfview" class="form-control-label">
                                        <input type="radio"  name="previewtype" value="pdfview" id="pdfview"> Pdf
                                    </label>

                            </div>
                            <div class="form-group  col-md-2">
                                <label for="search" class="form-control-label">&nbsp;</label>
                                <button type="submit" class="form-control btn btn-primary"> <i
                                        class='fas fa-search'></i>  Search</button>

                            </div>


                        </div>
                        </form>
                    </div>


                <!-- Card header -->

            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush
