@extends('layout.admin.app')
@section('title', __('global.electronic.title'))

@section('breadcrumb')
<li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('datatable-css')
    @include('layout.admin.datatable-css')
@endsection

@section('datatable-js')
    @include('layout.admin.datatable-js')
@endsection

@section('content')

<div class="table-responsive">
    <table class="table table-striped data-table text-md-nowrap" width="100%">
        <thead>
            <tr>
                <th>{{__('global.id')}}</th>
                <th>{{__('global.electronic.page_name')}}</th>
                <th>{{__('global.electronic.reception_mail')}}</th>
                <th>{{__('global.slug')}}</th>
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
            // serverSide: true,
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
            ajax: "{{ url('/admin/electronic-services/json') }}",
            // scrollY:550,
            // scrollX:true,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'translation.title', name: 'translation.title'},
                {data: 'email', name: 'email'},
                {data: 'slug', name: 'slug'},
                {data: 'created_at', name: 'created_at'},
            ],
            columnDefs: [
                {
                    targets: 3,
                    render: function (data, type, row, meta) {
                        return "<a target='_blank' href='{{url('/')}}/"+data+"'><i class='fa-solid fa-up-right-from-square'></i> "+data+"</a>";
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row, meta) {
                        return data.substr(0, 10);
                    }
                },
                {
                    targets: 5,
                    render: function (data, type, row, meta) {
                        var edit = '<a href="{{ url('/admin/electronic-services') }}/'+row.id+'/edit" class="btn mb-1 btn-sm btn-info"><i class="fa-fw fas fa-pen-alt"></i></a>';
                        return edit;
                    }
                },
                
            ]
        });
    });
</script>
@endsection