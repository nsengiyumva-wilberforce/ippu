@extends('layouts.app')
@section('page-title')
    {{__('Manage Leads')}} @if($pipeline) - {{$pipeline->name}} @endif
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('css/summernote/summernote-bs4.css')}}">
@endpush
@push('script-page')
    <script src="{{asset('css/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>
@endpush
@section('breadcrumb')
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Leads</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Leads</li>
        </ol>
    </div>

</div>
@endsection

@section('content')
<div class="text-end mb-3">
        <a href="{{ route('leads.index') }}" data-bs-toggle="tooltip" title="{{__('Kanban View')}}" class="btn btn-sm btn-primary">
            <i class="ri-grid-fill"></i>
        </a>
        <a href="#" data-size="lg" data-url="{{ route('leads.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create New User')}}" class="btn btn-sm btn-primary">
            <i class="ri-add-fill"></i>
        </a>
    </div>
    @if($pipeline)
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Subject')}}</th>
                                    <th>{{__('Stage')}}</th>
                                    <th>{{__('Users')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($leads) > 0)
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <td>{{ $lead->name }}</td>
                                            <td>{{ $lead->subject }}</td>
                                            <td>{{  !empty($lead->stage)?$lead->stage->name:'-' }}</td>
                                            <td>
                                                @foreach($lead->users as $user)
                                                    <a href="#" class="btn btn-sm mr-1 p-0 rounded-circle">
                                                        <img alt="image" data-toggle="tooltip" title="{{$user->name}}" @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif class="rounded-circle " width="25" height="25">
                                                    </a>
                                                @endforeach
                                            </td>
                                            @if(Auth::user()->type != 'Client')
                                                <td class="Action">
                                                    <span>
                                                    @can('view lead')
                                                            @if($lead->is_active)
                                                                <div class="action-btn bg-warning ms-2">
                                                                <a href="{{route('leads.show',$lead->id)}}" class="mx-3 btn btn-sm d-inline-flex align-items-center"  data-size="xl" data-bs-toggle="tooltip" title="{{__('View')}}" data-title="{{__('Lead Detail')}}">
                                                                    <i class="las la-eye text-white"></i>
                                                                </a>
                                                            </div>
                                                            @endif
                                                        @endcan
                                                        @can('edit lead')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="{{ route('leads.edit',$lead->id) }}" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-title="{{__('Lead Edit')}}">
                                                                    <i class="las la-edit text-white"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('delete lead')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['leads.destroy', $lead->id],'id'=>'delete-form-'.$lead->id]) !!}
                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="las la-trash text-white"></i></a>

                                                                {!! Form::close() !!}
                                                             </div>

                                                        @endif
                                                    </span>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="font-style">
                                        <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
