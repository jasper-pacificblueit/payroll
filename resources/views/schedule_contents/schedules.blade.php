@foreach ($schedules as $sched)
	<option value="{{ $sched->id }}">{{ $sched->type }}</option>
@endforeach
	<option value="custom">Custom</option>
