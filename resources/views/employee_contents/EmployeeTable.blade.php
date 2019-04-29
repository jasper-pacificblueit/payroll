
@if (count($data) > 0)
    @foreach ($data as $employee)
    <tr>
        <td>{{ App\User::find($employee->user_id)->id }}</td>
        <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
        <td>{{ App\User::find($employee->user_id)->email }}</td>
        <td></td>
        <td>
    		<button class="btn btn-sm btn-default" onclick="fetch('/manage/{{$employee->user_id}}', {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(rep => rep.text()).then(html => {

                document.getElementById('modal-panel').innerHTML = html;
                $('#manage').modal('toggle');

            })">Manage</button>
    		<button class="btn btn-sm btn-danger" 
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
        </td>
    </tr>
    @endforeach

    <span id="modal-panel"></span>
@else
    <tr>
        <td colspan="5">No data</td>
    </tr>
@endif

