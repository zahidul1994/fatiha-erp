@extends('backend.layouts.master')
@section('title', 'Edit Role')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-4">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Role Update</p>
                            <a href="{{route(Request::segment(1).'.roles.index')}}" class="btn btn-primary btn-sm ms-auto"><i class="fa fa-backward"> </i>  Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h5> @include('partial.formerror')</h5>
                            {!! Form::model($role, [
                                'route' => [Request::segment(1) . '.roles.update', $role->id],
                                'method' => 'PATCH',
                                'files' => true,
                            ]) !!}
                            <label for="oldname" class="form-label">Name *</label>
                            <div class="input-group">
                                {!! Form::text('name', rtrim($role->name,$role->admin_id), ['id' => 'name', 'class' => 'form-control  mb-1']) !!}
                            </div> 
                            <table  class="table  table-hover">
                                <thead>
                                    <h3>Permissions</h3>
                                    <tr>
                                       <th>List </th>
                                       <th>Create </th>
                                       <th>Edit </th>
                                       <th>Delete </th>
                                      </tr>
                                    <p class="bg-primary pl-3 p-2">
                                        <input type="checkbox" id="checkAll"> <span class="text-light text-bold">By a click you can select all </span>
                                    </p>
                                  
                                     
                                </thead>
                                <tbody>
                                  @if(count(Helper::Permissions())>0)
                                  
                                    <?php $i = 0; ?>
                                  @foreach(Helper::Permissions() as $value)
                                  @can($value->name)  
                                                                                   
                                  <?php $i++; if($i==5){ $i =1; ?>   
                                      <tr>
					<?php } ?>
                                 
                                   <td id="group_1">
                                   {{ $value->name }}
                                    <div class="form-check form-switch">
                                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-check-input')) }}
                                         
                                      </div>
                                    </td>
                                
                                  @endcan
                                  @endforeach
                                 
                                  @else
                                 <h3 class="text-danger">No Permission List  found</h3>
                                 @endif
                                            
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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


