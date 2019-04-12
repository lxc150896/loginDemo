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


{{-- @if (Session::has('success'))
<div class="notify" id="notify-success" data="{{ Session::get('success') }}">
</div>
@elseif (Session::has('unccess'))
<div class="notify" id="notify-unsuccess" data="{{ Session::get('unsuccess') }}">
</div>
@endif --}}

{{-- <table>
    <tr>
        <th>name</th>
        <th>email</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    @if (!empty ($arrUser))
    @foreach ($arrUser as $user)
    <tr id="user-{{ $user->id }}">
        <td id="name-ajax{{ $user->id }}">{{ $user->name }}</td>
        <td id="email-ajax{{ $user->id }}">{{ $user->email }}</td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{ $user->id }}">Edit</button></td>
        <td><button type="button" value="{{ $user->id }}" class="btn btn-danger" onclick="deleteUser(this)">Delete</button></td>
    </tr>

    <div id="myModal{{ $user->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit user</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="editUser{{ $user->id }}">
                    @csrf
                    <input id="user-name{{ $user->id }}" type="text" name="name" class="form-control" value="{{ $user->name }}">
                    <input id="user-email{{ $user->id }}" type="email" name="email" class="form-control" value="{{ $user->email }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="text-user{{ $user->id }}" class="btn btn-info" value="{{ $user->id }}" onclick="editUser(this)">Edit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</table> --}}