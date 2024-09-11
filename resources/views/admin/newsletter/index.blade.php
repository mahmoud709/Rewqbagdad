@extends('layout.admin.app')
@section('title', __('global.newsletter.title'))

@section('breadcrumb')
<li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('datatable-css')
    @include('layout.admin.datatable-css')
@endsection

@section('datatable-js')
    @include('layout.admin.datatable-js')
@endsection

@section('style')
    <style>
        .tox.tox-tinymce-aux,
        .tox-fullscreen .tox.tox-tinymce-aux {
            z-index: 999999 !important;
        }
    </style>
@endsection

@section('content')

<div class="mb-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SendMail">
        {{ __('global.newsletter.send_to_all') }}
    </button>
</div>
  
<!-- Modal -->
<div class="modal fade" id="SendMail" tabindex="-1" aria-labelledby="SendMailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SendMailLabel">{{ __('global.newsletter.send_to_all') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>{{ __('global.newsletter.mail_title') }} <strong class="text-danger">*</strong></label>
                <input type="text" id="title" class="form-control mb-4" />

                <textarea class="form-control my-editor"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">{{ __('global.newsletter.close') }}</button>
                <button class="btn btn-primary btn-send-mail">{{ __('global.newsletter.btn_send_mail') }}</button>
            </div>
        </div>
    </div>
</div>


<div class="table-responsive">
    <table class="table table-striped data-table text-md-nowrap" width="100%">
        <thead>
            <tr>
                <th>{{__('global.id')}}</th>
                <th>{{__('global.email')}}</th>
                <th>{{__('global.newsletter.email_verified_at')}}</th>
                <th>{{__('global.created_at')}}</th>
                <th>{{__('global.actions')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@section('script')
<script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('/admin/editor/config.js') }}"></script>

<script>
    $(document).on('click','.btn-send-mail', function() {
        var content = tinyMCE.activeEditor.getContent();
        var title = $('#title').val();

        if (title == ''||title==null){
            return alert("{{__('global.newsletter.alert_empty_title')}}");
        }

        if (content == ''){
            return alert("{{__('global.newsletter.alert_empty')}}");
        }
        
        if( confirm("{{__('global.newsletter.alert_send')}}") ){
            $.ajax({
                type: 'post',
                url: "{{ url('/admin/newsletters') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    title: title,
                    content: content
                },
                beforeSend: function() {
                    $('.btn-send-mail').html('<i class="fas fa-sync fa-spin"></i>');
                },
            }).done(function(res) {
                if(res.status=='success'){
                    tinyMCE.activeEditor.setContent('');
                    $('.btn-send-mail').html("{{ __('global.newsletter.btn_send_mail') }}");
                    $('#title').val('');
                    Swal.fire({
                        position: 'top-center',
                        type: 'success',
                        html: "<span style='font-size:1.5em'>"+res.message+"</span>",
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                }
            });
        }

    });
 



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
            ajax: "{{ url('/admin/newsletters/json') }}",
            scrollY:550,
            scrollX:true,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'email', name: 'email'},
                {data: 'email_verified_at', name: 'email_verified_at'},
                {data: 'created_at', name: 'created_at'},
            ],
            columnDefs: [
                {
                    targets: [2,3],
                    render: function (data, type, row, meta) {
                        if( data == null || data == ''){
                            return '';
                        }else {
                            return data.substr(0, 10);
                        }
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row, meta) {
                        var del = '<form style="display:inline-block" action="{{url('/admin/newsletters')}}/'+row.id+'" method="post">@csrf {{ method_field('DELETE') }} <button onclick="if(confirm(`{{__("global.alert_delete")}}`)){return true;}else{return false;}" class="btn btn-sm mb-1 btn-danger"><i class="far fa-fw fa-trash-alt"></i></button></form>';
                        var btns = '';
                        @if(auth('admin')->user()->hasPermission('update-events') || auth('admin')->user()->is_superadmin)
                            btns += edit + ' ' ;
                         @endif
                        @if(auth('admin')->user()->hasPermission('delete-events') || auth('admin')->user()->is_superadmin)
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