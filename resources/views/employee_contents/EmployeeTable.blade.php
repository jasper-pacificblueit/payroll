
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
        		<button class="btn btn-xs btn-danger" 
                    onclick="
                    fetch('/employee/{{ $employee->user_id }}', {
                        method: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        }
                    });
                    
                    EmployeeSelect(document.getElementById('DepartmentSelector').value);
                ">
                    Remove
                </button>
        	</div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">No data</td>
    </tr>
@endif