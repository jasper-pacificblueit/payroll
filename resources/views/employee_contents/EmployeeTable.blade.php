
@if (count($data) > 0)
    @php($min = 0)
    @foreach ($data as $employee)
    <tr ondblclick="$('#btnclick-{{ $employee->user_id }}').click();" id="emrow-{{ $employee->user_id }}">
        <td>{{ $employee->user->created_at }}</td>
        <td>
            <a href="/profile/{{ $employee->user->user }}">
            {{ App\Profile::getFullName($employee->user_id) }}
            </a>
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
        <td>{{ $employee->user->position()->title }}</td>
        <td id="excludedcolumn">
    		<button class="btn btn-xs btn-default" id="btnclick-{{ $employee->user_id }}" onclick="this.disabled = true; fetch('/manage/{{$employee->user_id}}', {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(rep => rep.text()).then(html => {

                document.getElementById('modal-panel').innerHTML = html;
                $('#manage').modal('toggle');

            })">Manage</button>
            <img src="..." style="display: none;" onerror='
            setInterval(function() {

                    fetch("/user/misc/status/{{ $employee->user_id }}", {
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        }
                    }).then(rep => rep.json()).then(json => {

                        try {

                        document.querySelector("#status-{{ $employee->user_id }}").style.color = 
                            json.online ? "#23c6c8" : "";

                        document.querySelector("#status-{{ $employee->user_id }}").title = 
                            json.online ? "Online" : "Offline";

                        } catch (e) {};

                    }).catch(e => e);

            }, 5*60000+{{ $min += 1000 }});
            '>
        </td>
    </tr>
    <!-- split -->
    @endforeach
@endif

