@extends('layout.admin.app')
@section('title', __('global.center_member.title'))

@section('breadcrumb')
<li class="breadcrumb-item">@yield('title')</li>
<li class="breadcrumb-item"><a href="{{ url('/admin/center-team/create') }}">{{__('global.center_member.add_new')}}</a></li>
@endsection

@section('datatable-css')
    @include('layout.admin.datatable-css')
@endsection

@section('datatable-js')
    @include('layout.admin.datatable-js')
@endsection

@section('content')
<form action="{{url('/admin/center-team/update/description')}}" class="row mb-2" method="post">@csrf
    <div class="col-md-6 mb-2">
        <label for="">{{ __('global.book_team.description_page') }} ({{ LangNative('ar') }}) <b class="text-danger">*</b></label>
        <textarea name="description_ar" required maxlength="900" class="form-control" rows="3">{{old('description_ar',$teamSetting->description_ar)}}</textarea>
    </div>
    <div class="col-md-6 mb-2">
        <label for="">{{ __('global.book_team.description_page') }} ({{ LangNative('en') }}) <b class="text-danger">*</b></label>
        <textarea name="description_en" required maxlength="900" class="form-control" rows="3">{{old('description_en',$teamSetting->description_en)}}</textarea>
    </div>

    <div class="col-md-12 text-center">
        <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-secondary">{{__('global.btn_update')}}</button>
        <a class="btn btn-success" href="{{ url('/admin/center-team/create') }}">{{__('global.center_member.add_new')}}</a>
    </div>

    
</form>
{{-- <div class="mb-2">
    <a class="btn btn-secondary" href="{{ url('/admin/center-team/create') }}">{{__('global.center_member.add_new')}}</a>
</div> --}}

<div class="table-responsive">
    <table class="table table-striped data-table text-md-nowrap" width="100%">
        <thead>
            <tr>
                <th>{{__('global.id')}}</th>
                <th>{{__('global.center_member.name')}}</th>
                <th>{{__('global.center_member.job_title')}}</th>
                <th>{{__('global.center_member.email')}}</th>
                <th>{{__('global.created_at')}}</th>
                <th>{{__('global.actions')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        var table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 1, 'desc' ]],
            dom: 'lBfrtip',
            buttons: {
                buttons: [
                    { extend: 'copyHtml5', text: '{{__("global.copy")}}', className: 'btn btn-sm'},
                    { extend: 'excelHtml5', text: '{{__("global.excel")}}', className: 'btn btn-sm'},
                    { extend: 'print', text: '{{__("global.print")}}', className: 'btn btn-sm'}
                ]
            },
            lengthMenu: [[10,25,50,100, -1],[10,25,50,100, "{{__('global.view_all')}}"],],
            @if(app()->getLocale()=='ar')
            language: {"url": "{{ url('/admin/assets/plugins/datatable/Arabic.json') }}"},
            @endif
            ajax: "{{ url('/admin/center-team/json') }}",
            scrollY:550,
            scrollX:true,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'translation.name', name: 'translation.name'},
                {data: 'translation.job_title', name: 'translation.job_title'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
            ],
            columnDefs: [
                {
                    targets: 4,
                    render: function (data, type, row, meta) {
                        return data.substr(0, 10);
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, row, meta) {
                        var edit = '<a href="{{ url('/admin/center-team') }}/'+row.id+'/edit" class="btn mb-1 btn-sm btn-info"><i class="fa-fw fas fa-pen-alt"></i></a>';
                        var del = '<form style="display:inline-block" action="{{url('/admin/center-team')}}/'+row.id+'" method="post">@csrf {{ method_field('DELETE') }} <button onclick="if(confirm(`{{__("global.alert_delete")}}`)){return true;}else{return false;}" class="btn btn-sm mb-1 btn-danger"><i class="far fa-fw fa-trash-alt"></i></button></form>';
                        var btns = '';
                        @if(auth('admin')->user()->hasPermission('edit-centerTeam') || auth('admin')->user()->is_superadmin)
                            btns += edit + ' ' ;
                         @endif
                        @if(auth('admin')->user()->hasPermission('delete-centerTeam') || auth('admin')->user()->is_superadmin)
                            btns += del;
                        @endif
                   
                        return btns;
                    }
                },
                
            ]
        });
    });
</script>
@endsection