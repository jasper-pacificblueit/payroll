
@foreach (App\Schedule::all() as $sched)
	<tr>
		<td>{{ $sched->type }}</td>
		<td>{{ $sched->department->name }}</td>
		<td>{{ $sched->in_am }}</td>
		<td>{{ $sched->out_am }}</td>
		<td>{{ $sched->in_pm }}</td>
		<td>{{ $sched->out_pm }}</td>
		<td>{{ $sched->state }}</td>
		<td>
			<button class="btn btn-xs btn-default">Manage</button>
		</td>
	</tr>
@endforeach