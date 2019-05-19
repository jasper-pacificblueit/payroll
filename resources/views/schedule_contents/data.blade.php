
@foreach (App\Schedule::all() as $sched)
	<tr>
		<td>{{ $sched->type }}</td>
		<td>{!! $sched->department ? $sched->department->name : "<span class='badge badge-warning'>Created for user</span>" !!}</td>
		<td>{!! $sched->employee_id == null ? "<span class='badge badge-success'>Everyone</span>" : App\Profile::getFullName(App\Employee::find($sched->employee_id)->user_id) !!}</td>
		<td>{{ $sched->in_am }}</td>
		<td>{{ $sched->out_am }}</td>
		<td>{{ $sched->in_pm }}</td>
		<td>{{ $sched->out_pm }}</td>
		<td>
			@php
				switch ($sched->state) {
				case 0:
					echo '<span class="label label-info">Available</span>';
					break;
				case 1:
					echo '<span class="label label-warning">Unavailable</span>';
					break;
				case 2:
					echo '<span class="label label-success">Temporarily Unavailable</span>';
					break;
				default:
					echo '<span class="label label-danger">Unknown</span>';
					break;
				}
			@endphp
		</td>
		<td>
			<button class="btn btn-xs btn-danger">Remove</button>
		</td>
	</tr>
@endforeach