 @extends('layouts.app')

 @section('content')
 <div class="container">
    <div class="row">
        <div class="card-body" id="app">
            <chat-app :user="{{ auth()->user() }}"></chat-app>
        </div>
    </div>
</div>
@endsection
