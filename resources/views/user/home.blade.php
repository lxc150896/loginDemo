
<a href="{{ asset('logout') }}">logout</a>
<table style="width:100%">
    <tr>
        <th>name</th>
        <th>email</th> 
    </tr>
    @foreach ($arrUser as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>sua</td>
        <td>xoa</td>
    </tr>
    @endforeach
</table>