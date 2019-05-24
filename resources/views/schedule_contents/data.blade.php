
@foreach (App\Schedule::all() as $sched)
	<tr id="schedule-{{ $sched->id }}">
		<td>{{ $sched->type }}</td>
		<td data-toggle="tooltip" data-placement="bottom" title="{!! $sched->department->company->name !!}">{!! $sched->department ? $sched->department->name : "<span class='badge badge-warning'>Created for user</span>" !!}</td>
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
		<td align=right>
			<button class="btn btn-xs btn-success" onclick='

				var schedule = document.querySelector("#schedule-{{ $sched->id }}");

				if (schedule.children[8].firstElementChild.innerHTML == "Save") {

					fetch ("/schedules/{{ $sched->id }}", {
						method: "PUT",
						headers: {
							"X-CSRF-TOKEN": "{{ csrf_token() }}",
						},
						body: JSON.stringify({
							in_am: schedule.children[3].firstElementChild.value,
							out_am: schedule.children[4].firstElementChild.value,
							in_pm: schedule.children[5].firstElementChild.value,
							out_pm: schedule.children[6].firstElementChild.value,
							state: schedule.children[7].firstElementChild.value,
						}),

					}).then(rep => rep.json()).then(json => {
						console.log(json);
						eval(`toastr.${json.type}("${json.body}<br><br><span class=pull-right>{{ new Carbon\Carbon() }}</span>", "${json.title}")`);

						schedule.children[3].innerHTML = json.schedule.in_am;
						schedule.children[4].innerHTML = json.schedule.out_am;
						schedule.children[5].innerHTML = json.schedule.in_pm;
						schedule.children[6].innerHTML = json.schedule.out_pm;
						schedule.children[7].innerHTML = (function () {

							switch (json.schedule.state) {
							case "0": return `<span class="label label-info">Available</span>`; break;
							case "1": return `<span class="label label-warning">Unavailable</span>`; break;
							default:
								return `<span class="label label-success">Temporarily Unavailable</span>`;
							}

						})();

						return;
					});

					schedule.children[8].firstElementChild.innerHTML = "Edit";
					return;
				}

				for (i = 3; i <= 6; ++i)
					schedule.children[i].innerHTML = `
						<input class="form-control" value="${schedule.children[i].innerHTML}" type="time">
					`;

				schedule.children[7].innerHTML = `
					<select class="form-control">
						<option value="0" @if($sched->state == 0) selected @endif>Available</option>
						<option value="1" @if($sched->state == 1) selected @endif>Unavailable</option>
						<option value="2" @if($sched->state == 2) selected @endif>Temporarily unavailable</option>
					</select>
				`;

				schedule.children[8].firstElementChild.innerHTML = "Save";

			'>Edit</button>

			<button class="btn btn-xs btn-danger" @if (App\Employee::where("schedule_id", "=", $sched->id)->count() > 0) disabled @endif onclick='

				swal({
					title: "",
					text: "Are you sure you want to delete this schedule?",
					type: "warning",
					showCancelButton: true,
				}, function (req_conf) {
					if (req_conf) {
						fetch ("/schedules/{{$sched->id}}", {
							method: "delete",
							headers: {
								"X-CSRF-TOKEN": "{{ csrf_token() }}",
							},
						}).then(rep => rep.json()).then(json => {

							eval(`toastr.${json.type}("${json.body}<br><br><span class=pull-right>{{ new Carbon\Carbon() }}</span>", "${json.title}");`);

							fetch("/schedules/data", {
								method: "get",
								headers: {
									"X-CSRF-TOKEN": "{{ csrf_token() }}",
								},
							}).then(rep => rep.text()).then(html => {

								console.log(html);

								document.querySelector("#scheduleData").innerHTML = html;
							});

						});
					}
				});

			'><i class="fas fa-trash"></i></button>
		</td>
	</tr>
@endforeach