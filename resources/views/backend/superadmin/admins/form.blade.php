


    <div class="form-group">
        <label for="name" class="form-control-label">Full Name (Owner) * </label>
        {!! Form::text('name', null, ['id' => 'name','class' => 'form-control','required',
        ]) !!}
        @if ($errors->has('name')) <span class="text-danger alert">{{ $errors->first('name') }}</span> @endif
    </div>


    <div class="form-group">
        <label for="package" class="form-control-label">Package * </label>
        {!! Form::select('package',$package,null, ['id' => 'phone','class' => 'form-control select2','required'
        ]) !!}
        @if ($errors->has('phone')) <span class="text-danger alert">{{ $errors->first('package') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="phone" class="form-control-label">phone * </label>
        {!! Form::tel('phone',null, ['id' => 'phone','class' => 'form-control','required'
        ]) !!}
        @if ($errors->has('phone')) <span class="text-danger alert">{{ $errors->first('phone') }}</span> @endif
    </div>
    <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Image (Profile)  [300*300]
            </a>
        </span>
        {!! Form::text('image', null, ['id' => 'thumbnail', 'class' => 'form-control', 'readonly','required','style'=>'height:40px']) !!}
        @if ($errors->has('image'))
        <span class="text-danger alert">{{ $errors->first('image') }}</span>
        @endif
        <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>
    <div class="form-group">
        <label for="email" class="form-control-label">Email * </label>
        {!! Form::email('email', null, ['id' => 'email','class' => 'form-control','required',
        ]) !!}
        @if ($errors->has('email')) <span class="text-danger alert">{{ $errors->first('email') }}</span> @endif
    </div>
    @if (Request::segment(3)=='create')
    <div class="form-group">
        <label for="password" class="form-control-label">Password * </label>
        {!! Form::password('password', ['id' => 'password','class' => 'form-control','required'
        ]) !!}
        @if ($errors->has('password')) <span class="text-danger alert">{{ $errors->first('password') }}</span> @endif
    </div>
@else
    <div class="form-group">
        <label for="password" class="form-control-label">Password </label>
        {!! Form::password('password', ['id' => 'password','class' => 'form-control'
        ]) !!}
        @if ($errors->has('password')) <span class="text-danger alert">{{ $errors->first('password') }}</span> @endif
    </div>
@endif

    <div class="form-group">
        <label for="gender" class="form-control-label">Gender * </label>
        {!! Form::select('gender',['Male'=>'Male','Female'=>'Female','Other'=>'Other'], null, ['id' => 'gender','class'
        => 'form-control select2','required',
        ]) !!}
        @if ($errors->has('gender')) <span class="text-danger alert">{{ $errors->first('gender') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="company_name" class="form-control-label">Compnay Name * </label>
        {!! Form::text('company_name', null, ['id' => 'company_name','class' => 'form-control','required',
        ]) !!}
        @if ($errors->has('company_name')) <span class="text-danger alert">{{ $errors->first('company_name') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="invoice_slug" class="form-control-label">Invoice Slug (3 Letter) * </label>
        {!! Form::text('invoice_slug', null, ['id' => 'invoice_slug','class' => 'form-control','required',
        ]) !!}
        @if ($errors->has('invoice_slug')) <span class="text-danger alert">{{ $errors->first('invoice_slug') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="package_start_date" class="form-control-label">Package Start Date (Be Carefully Change) * </label>
        {!! Form::date('package_start_date', date('Y-m-d')?:null, ['id' => 'package_start_date','class' => 'form-control','required',
        ]) !!}
        @if ($errors->has('package_start_date')) <span class="text-danger alert">{{ $errors->first('package_start_date') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="web_address" class="form-control-label">Web Address </label>
        {!! Form::text('web_address', null, ['id' => 'web_address','class' => 'form-control'
        ]) !!}
        @if ($errors->has('web_address')) <span class="text-danger alert">{{ $errors->first('web_address') }}</span> @endif
    </div>
    <div class="form-group">
        <label for="company_address" class="form-control-label">Company Address * </label>
        {!! Form::textarea('company_address', null, ['id' => 'company_address','class' => 'form-control','required','rows'=>2
        ]) !!}
        @if ($errors->has('company_address')) <span class="text-danger alert">{{ $errors->first('company_address') }}</span> @endif
    </div>

    @if (Request::segment(3)=='create')
    <div class="form-group">
        <label for="roles" class="form-control-label">Select Role * </label>
        {!! Form::select('roles',$roles,null, ['id' => 'roles','class' => 'form-control select2','placeholder'=>'Select
        Role','required'
        ]) !!}
        @if ($errors->has('roles')) <span class="text-danger alert">{{ $errors->first('roles') }}</span> @endif
    </div>
    @else
    <div class="form-group">
        <label for="roles" class="form-control-label">Update Role * </label>
        {!! Form::select('roles',$roles, $userRole, ['id' => 'roles','class' => 'form-control
        select2','placeholder'=>'Select Role','required'
        ]) !!}
        @if ($errors->has('roles')) <span class="text-danger alert">{{ $errors->first('roles') }}</span> @endif
    </div>
    @endif

    <div class="input-group">
        <span class="input-group-btn">
            <a id="company_logo" data-input="thumbcompany_logo" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Company Logo  [150*150]
            </a>
        </span>
        {!! Form::text('company_logo', null, ['id' => 'thumbcompany_logo', 'class' => 'form-control', 'readonly','style'=>'height:40px']) !!}
        @if ($errors->has('company_logo'))
        <span class="text-danger alert">{{ $errors->first('company_logo') }}</span>
        @endif
        <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>

    <div class="form-group">
        <label for="description" class="form-control-label">About Compnay and Owner Information </label>
        {!! Form::textarea('description', null, [
        'id' => 'description',
        'class' => 'form-control',
        'rows' => 2,
        ]) !!}
        @if ($errors->has('description'))
        <span class="text-danger alert">{{ $errors->first('description') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label for="status" class="form-control-label">Status * </label>
        {!! Form::select('status',[1=>'Active',0=>'In-Active'],null, ['id' => 'status','class' => 'form-control select2','required'
        ]) !!}
        @if ($errors->has('status')) <span class="text-danger alert">{{ $errors->first('status') }}</span> @endif
    </div>
</div>
