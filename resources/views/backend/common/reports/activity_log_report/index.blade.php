@extends('backend.layouts.master')
@section('title', 'Activity Log Report')
@push('css')
<link href="{{ asset('backend/assets/select2/css/select2.min.css') }}" rel="stylesheet" />

<style>

    .select2-selection__choice {
        background-color: var(--bs-gray-200);
        border: none !important;
        font-size: 12px;
        font-size: 0.85rem !important;
    }


</style>
@endpush
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12  mb-10">

            <div class="card">
            <div class="border-top border-info">
                        <!--estimated annual area-->
                        <h3 class="text-center bg-info">Activity Log Report</h3>
                        {!! Form::open(['route' => Request::segment(1) . '.activityLogReportShow', 'method' => 'POST','class'=>'form']) !!}

                        <div class="row mx-auto">
                            <!-- form start -->
                              <div class="form-group col-md-3">
                                <label for="user_id" class="form-control-label"> Select User * </label>
                                 <select name="user_id" id="select2" class="form-control" required>
                                    @if (@Auth::user()->user_type=="Admin")
                                    <option value="{{Auth::id()}}">{{@Auth::user()->name}}</option>
                                    @endif
                                    @foreach (Helper::getEmployes(Auth::id()) as $info)
                                      <option value="{{$info->id}}">{{$info->name}}</option>
                                    @endforeach

                                </select>

                            </div>
                              <div class="form-group col-md-2">
                                <label for="start_date" class="form-control-label"> Start Date * </label>
                                {!! Form::date('start_date', null, ['class' => 'form-control','id' => 'start_date','required']) !!}

                            </div>
                            <div class="form-group col-md-2">
                                <label for="end_date" class="form-control-label"> End Date * </label>
                                {!! Form::date('end_date', date('Y-m-d'), ['class' => 'form-control','id' => 'end_date','required']) !!}
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
<script src="{{ asset('backend/assets/select2/js/select2.min.js') }}"></script>
<script>
    $('#select2').select2();
 </script>
@endpush
