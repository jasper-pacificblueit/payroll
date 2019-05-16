@if ($type == "rates")
	@foreach($employees as $employee)
	<tr>
		<td>{{ $employee->bio_id ? $employee->bio_id : $employee->id + 1000 }}</td>
		<td>{{ App\Profile::getFullName($employee->user_id) }}</td>
		<td>{{ number_format($employee->rates->monthly, 2) }}</td>
		<td>{{ $employee->rates->hourly }}</td>
		<td>{{ $employee->rates->overtime }}</td>
		<td>{{ $employee->rates->holiday }}</td>
		<td>{{ $employee->rates->nightdiff }}</td>
		<td>
			<button class="btn btn-xs btn-success">Edit</button>
		</td>
	</tr>
	@endforeach
@endif

@if ($type == "deductions")
	@foreach($employees as $employee)
	<tr>
		<td>{{ $employee->bio_id ? $employee->bio_id : $employee->id + 1000 }}</td>
		<td>{{ App\Profile::getFullName($employee->user_id) }}</td>
		<td>{{ $employee->deductions->late or '0.00' }}</td>
		<td>{{ $employee->deductions->undertime or '0.00' }}</td>
		<td>{{ json_encode(json_decode($employee->deductions->deductions)->statutory) }}</td>
		<td>
			<button class="btn btn-xs btn-success">Edit</button>
		</td>
	</tr>
	@endforeach
@endif