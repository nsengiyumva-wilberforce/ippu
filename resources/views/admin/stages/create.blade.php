
<div class="modal-bdy">
    <div class="rw">
        <div class="form-group cl-12">
            {{ Form::label('name', __('Stage Name'),['class'=>'form-label']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-12">
            {{ Form::label('pipeline_id', __('Pipeline'),['class'=>'form-label ']) }}
            {{ Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control form-select select2','required'=>'required')) }}
        </div>
    </div>
</div>

