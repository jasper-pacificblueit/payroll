
@foreach($employees as $employee)
<tr>
	<td>{{ $employee->bio_id ? $employee->bio_id : $employee->id + 1000 }}</td>
	<td>{{ App\Profile::getFullName($employee->user_id) }}</td>
	<td>{{ number_format($employee->rates->monthly, 2) }}</td>
	<td>{{ $employee->rates->hourly }}</td>
	<td>{{ $employee->rates->overtime }}</td>
	<td>{{ $employee->rates->holiday }}</td>
	<td>{{ $employee->rates->nightdiff }}</td>
	<td></td>
</tr>
@endforeach
