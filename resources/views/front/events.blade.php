<div class="form-group">
    <label class="form-control bg-white-greding">
        <strong> {{__('front.events')}} </strong>
    </label>
    <div id="calendar"></div>
</div>

{{-- @php
    $events = \App\Models\Events::with('translation')->get();
@endphp --}}


@section('calendar')
<script>
    // var data = [];
    
    // // On Page Load Get Data From Current Month 
    // $.ajax({
    //     url: "{{url('get/events')}}",
    //     type: "post",
    //     data:{
    //         _token: "{{csrf_token()}}",
    //         month: new Date().getMonth()+1,
    //     }
    // }).done(function(res) {
    //     res.forEach(function (item, index) {
    //         data.push(
    //             {
    //                 eventName: item.name,
    //                 href: item.url,
    //                 color: 'green',
    //                 date: item.date,
    //             }
    //         );
    //     });
    //     var calendar = new Calendar('#calendar', data);
    // });


    AddNewEvent(new Date().getMonth()+1);
    


    function AddNewEvent(month) {
        var data = [];
        $.ajax({
            url: "{{url('get/events')}}",
            type: "post",
            data:{
                _token: "{{csrf_token()}}",
                month: month,
                local: "{{appLangKey()}}",
            }
        }).done(function(res) {
            res.forEach(function (item, index) {
                 data.push(
                     {
                        eventName: item.name,
                        href: '/event/'+item.url,
                        color: 'green',
                        date: item.date,
                     }
                 );
            });
            const container = document.querySelector('#calendar');
            removeAllChildNodes(container);
            var calendar = new Calendar('#calendar', data,month-1);
            
        });
    }
    
    function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}
</script>
@endsection