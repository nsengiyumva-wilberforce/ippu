
<div class="">
    <div class="">
        <div class="form-group ">
            {{ Form::label('name', __('Lead Stage Name'),['class'=>'form-label']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-12">
            {{ Form::label('pipeline_id', __('Pipeline'),['class'=>'form-label ']) }}
            {{ Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control select2 form-select','required'=>'required')) }}
        </div>
    </div>
</div>

