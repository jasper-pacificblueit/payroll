
@if (count($data) > 0)
    @foreach ($data as $employee)
    <tr>
        <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
        <td>{{ App\User::find($employee->user_id)->email }}</td>
        <td></td>
        <td></td>
        <td>
        	<div class="btn-group">
        		<button class="btn btn-xs btn-default">Manage</button>
        		<button class="btn btn-xs btn-danger">Remove</button>
        	</div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">No data</td>
    </tr>
@endif