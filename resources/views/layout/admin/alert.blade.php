@if( $errors->all() )
    @foreach ($errors->all() as $message)
        <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
    @endforeach
@endif

@if( session('success') )
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        Swal.fire({
            position: 'top-center',
            type: 'success',
            html: "<span style='font-size:1.5em'>{{ session('success') }}</span>",
            showConfirmButton: true,
            confirmButtonText: 'Ok'
        })
    </script>
@endif

@if( session('error') )
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        Swal.fire({
            type: 'error',
            html: "<span style='font-size:1.5em'>{{ session('error') }}</span>",
            showConfirmButton: true,
            confirmButtonText: 'Ok'
        });
    </script>
@endif