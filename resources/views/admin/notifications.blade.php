@if (Session::has('notifications'))
    @php
    $notification = Session::get('notifications');
    @endphp

    <div class="alert alert-{{$notification['type']}} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-{{$notification['type']=='error'?'warning':'check'}}"></i> {{ucfirst($notification['type'])}}</h4>
        {{ $notification['message'] }}
    </div>
@endif