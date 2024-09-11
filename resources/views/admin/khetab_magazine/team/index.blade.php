@extends('layout.admin.app')
@section('title', __('global.khetab_magazine.team.title'))

@section('breadcrumb')
<li class="breadcrumb-item">@yield('title')</li>
<li class="breadcrumb-item"><a href="{{ url('/admin/khetab-magazine-team/create') }}">{{__('global.khetab_magazine.team.add')}}</a></li>
@endsection

@section('datatable-css')
    @include('layout.admin.datatable-css')
@endsection

@section('datatable-js')
    @include('layout.admin.datatable-js')
@endsection

@section('content')

<div class="mb-2">
    <a class="btn btn-secondary" href="{{ url('/admin/khetab-magazine-team/create') }}">{{__('global.khetab_magazine.team.add_new')}}</a>
</div>

<div class="table-responsive">
    <table class="table table-striped data-table text-md-nowrap" width="100%">
        <thead>
            <tr>
                <th>{{__('global.sort')}}</th>
                <th>{{__('global.khetab_magazine.team.name')}}</th>
                <th>{{__('global.khetab_magazine.team.job_title')}}</th>
                <th>{{__('global.khetab_magazine.team.email')}}</th>
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
            order: [[ 0, 'desc' ]],
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
            ajax: "{{ url('/admin/khetab-magazine-team/json') }}",
            scrollY:550,
            scrollX:true,
            columns: [
                {data: 'sort', name: 'sort'},
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
                        var edit = '<a href="{{ url('/admin/khetab-magazine-team') }}/'+row.id+'/edit" class="btn mb-1 btn-sm btn-info"><i class="fa-fw fas fa-pen-alt"></i></a>';
                        var del = '<form style="display:inline-block" action="{{url('/admin/khetab-magazine-team')}}/'+row.id+'" method="post">@csrf {{ method_field('DELETE') }} <button onclick="if(confirm(`{{__("global.alert_delete")}}`)){return true;}else{return false;}" class="btn btn-sm mb-1 btn-danger"><i class="far fa-fw fa-trash-alt"></i></button></form>';
                        var btns = '';
                        @if(auth('admin')->user()->hasPermission('edit-khetabmagazinemteam') || auth('admin')->user()->is_superadmin)
                            btns += edit + ' ' ;
                         @endif
                        @if(auth('admin')->user()->hasPermission('delete-khetabmagazinemteam') || auth('admin')->user()->is_superadmin)
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