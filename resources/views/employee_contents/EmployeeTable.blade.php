
@if (count($data) > 0)
    @php($min = 0)
    @foreach ($data as $employee)
        <tr ondblclick="$('#btnclick-{{ $employee->user_id }}').click();">
        <td>{{ $employee->user->created_at }}</td>
        <td>
            {{ App\Profile::getFullName($employee->user_id) }}
            <span class="pull-right">
                <i class="fas fa-dot-circle" id="status-{{ $employee->user_id }}"
                    {{ App\User::online($employee->user->user) ? 'title=Online' : 'title=Offline'  }}
                    style="
                        {{ App\User::online($employee->user->user) ? 'color: #23c6c8' : '' }}
                    ">
               </i> 
            </span>
        </td>
        <td>{{ $employee->user->email }}</td>
        <td></td>
        <td>
    		<button class="btn btn-sm btn-default" id="btnclick-{{ $employee->user_id }}" onclick="fetch('/manage/{{$employee->user_id}}', {
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
    <img src="..." style="display: none;" onerror='
        setInterval(function() {
            fetch("/user/misc/status/{{ $employee->user_id }}", {
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                }
            }).then(rep => rep.json()).then(json => {

                document.querySelector("#status-{{ $employee->user_id }}").style.color = 
                    json.online ? "#23c6c8" : "";

                document.querySelector("#status-{{ $employee->user_id }}").title = 
                    json.online ? "Online" : "Offline";

            });

        }, 10000+{{ $min += 1000 }});
    '>
    @endforeach

    <span id="modal-panel"></span>
@else
    <tr>
        <td colspan="5" align=center>No data</td>
    </tr>
@endif

