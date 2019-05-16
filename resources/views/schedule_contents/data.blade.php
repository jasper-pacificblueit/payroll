
@foreach (App\Schedule::all() as $sched)
	<tr>
		<td>{{ $sched->type }}</td>
		<td>{{ $sched->department->name }}</td>
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
			<button class="btn btn-xs btn-default">Manage</button>
		</td>
	</tr>
@endforeach