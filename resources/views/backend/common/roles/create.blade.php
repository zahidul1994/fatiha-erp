@extends('backend.layouts.master')
@section('title', 'Create Role')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-4">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Role Create</p>
                        <a href="{{route(Request::segment(1).'.roles.index')}}"
                            class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h5> @include('partial.formerror')</h5>
                        <form role="form" action="{{route(Request::segment(1).'.roles.store')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Role Name" required autofocus>
                                </div>

                                <div class="form-group">
                                    <h3>Permissions</h3>
                                    <p class="bg-primary pl-3 p-2">
                                        <input type="checkbox" id="checkAll"> <span class="text-light text-bold">By a
                                            click you can select all </span>
                                    </p>

                                    <table class="table table-responsive w-100 d-block d-md-table">
                                        <thead>
                                            <tr>
                                                <th>List </th>
                                                <th>Action </th>
                                                <th>Create </th>
                                                <th>Action </th>
                                                <th>Edit </th>
                                                <th>Action </th>
                                                <th>Delete </th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>


                                        <tbody>

                                            <?php $i = 0; ?>
                                            @if(count(Helper::Permissions())>0)
                                            @foreach(Helper::Permissions() as $value)
                                            @can($value->name)
                                            <?php
                                      $originalString = $value->name;

                                      // Split the string into words
                                      $words = explode('-', $originalString);

                                      // Get the last word
                                      $lastWord = ucwords($words[0].' '.$words[1]);               ?>

                                            <?php $i++; if($i==5){ $i =1; ?>
                                            <tr>
                                                <?php } ?>

                                                <td>{{ ucwords($value->name) }}</td>
                                                <td id="group_1">
                                                    <div class="form-check form-switch">
                                                        {{ Form::checkbox('permission[]', $value->name, false,
                                                        array('class' => 'form-check-input group_1')) }}

                                                    </div>
                                                </td>
                                                @endcan
                                                @endforeach


                                                @else
                                                <h3 class="text-danger">No Permission List found</h3>
                                                @endif

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


</script>
@endpush