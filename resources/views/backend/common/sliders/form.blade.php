<div class="col-md-12">
    <div class="form-group">
        <label for="link_text" class="form-control-label">Button Text * </label>
        {!! Form::text('link_text', null, ['id' => 'link_text', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('link_text'))
            <span class="text-danger alert">{{ $errors->first('link_text') }}</span>
        @endif
    </div>
   
    <div class="form-group">
        <label for="link" class="form-control-label">Button Link * </label>
        {!! Form::text('link', null, ['id' => 'link', 'class' => 'form-control', 'required']) !!}
        @if ($errors->has('link'))
            <span class="text-danger alert">{{ $errors->first('link') }}</span>
        @endif
    </div>

    
    <div class="input-group">
        <span class="input-group-btn">
          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i>  Image [1686X548] *
          </a>
        </span>
        {!! Form::text('image', null, ['id' => 'thumbnail', 'class' => 'form-control', 'required','readonly','style'=>'height:40px']) !!}
        @if ($errors->has('image'))
        <span class="text-danger alert">{{ $errors->first('image') }}</span>
      @endif
    <img id="holder" style="margin-top:15px;max-height:100px;">
    </div>
   

    
</div>
