<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>Avatar</th>
            <td><img src="https://www.gravatar.com/avatar/64e1b8d34f425d19e1ee2ea7236d3028.jpg?s=80&d=mm&r=g" class="user-profile-image" /></td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td>{{ auth()->user()->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ auth()->user()->email }}</td>
        </tr>
        <tr>
            <th>Created_at</th>
            <td>{{ timezone()->convertToLocal(auth()->user()->created_at) }} ({{ auth()->user()->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>Last_updated</th>
            <td>{{ timezone()->convertToLocal(auth()->user()->updated_at) }} ({{ auth()->user()->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>
