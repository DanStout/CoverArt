@if(session('message'))
    <div class="alert alert-{{session('message_type', 'success')}}">
        {{session('message')}}
    </div>
@endif

