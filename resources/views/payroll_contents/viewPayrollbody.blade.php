@php( $employees = \App\Employee::all())

@foreach ($employees as $employee)
    <tr>
        <td><input type="checkbox" checked></td>
        <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
        
        <td>asdasdsad</td>
        <td>asdasdsad</td>
        <td>{{$start}}</td>
        <td>{{$end}}</td>
        
        
    </tr>
@endforeach