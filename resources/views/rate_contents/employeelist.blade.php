@if ($type == "rates")
	@foreach($employees as $employee)
	<tr ondblclick="$('#editbtn-{{ $employee->user_id }}')" name='employeeRates-{{ $employee->user_id }}'>
		<td>{{ $employee->bio_id ? $employee->bio_id : $employee->id + 1000 }}</td>
		<td>{{ App\Profile::getFullName($employee->user_id) }}</td>
		<td>{{ number_format($employee->rates->monthly, 2) }}</td>
		<td>{{ number_format($employee->rates->hourly, 2) }}</td>
		<td>{{ number_format($employee->rates->overtime, 2) }}</td>
		<td>{{ number_format($employee->rates->holiday, 2) }}</td>
		<td>{{ number_format($employee->rates->nightdiff, 2) }}</td>
		<td>
				<button class="btn btn-xs btn-success" id="editbtn-{{ $employee->user_id }}" onclick='

					if (document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").innerHTML == "Edit") {
						document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").innerHTML = "Save";
						document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").classList.remove("btn-success");
						document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").classList.add("btn-warning");

						document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").style.position = "relative";
						document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").style.top = "5px";

						row{{ $employee->id }} = document.querySelector("[name=employeeRates-{{ $employee->user_id }}]");

						cells = ["bio", "employee", "monthly", "hourly", "ot", "holiday", "nightdiff"];

						cells.forEach(function(v, i) {
							row{{ $employee->id }}.cells[i].setAttribute("id", v);
						});

						monthly{{ $employee->id }} = document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #monthly");
						hourly{{ $employee->id }} = document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #hourly");
						ot{{ $employee->id }} = document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #ot");
						holiday{{ $employee->id }} = document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #holiday");
						nightdiff{{ $employee->id }} = document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #nightdiff");


						monthly{{ $employee->id }}.innerHTML = `<input type="number" step=".01" class="form-control" placeholder="${monthly{{ $employee->id }}.innerText}">`;
						hourly{{ $employee->id }}.innerHTML = `<input type="number" step=".01" class="form-control" placeholder="${hourly{{ $employee->id }}.innerText}">`;
						ot{{ $employee->id }}.innerHTML = `<input type="number" step=".01" class="form-control" placeholder="${ot{{ $employee->id }}.innerText}">`;
						holiday{{ $employee->id }}.innerHTML = `<input type="number" step=".01" class="form-control" placeholder="${holiday{{ $employee->id }}.innerText}">`;
						nightdiff{{ $employee->id }}.innerHTML = `<input type="number" step=".01" class="form-control" placeholder="${nightdiff{{ $employee->id }}.innerText}">`;
					} else {

						fetch ("/rates/modify/{{ $employee->id }}", {
							method: "PUT",
							headers: {
								"X-CSRF-TOKEN": "{{ csrf_token() }}",
							},
							body: JSON.stringify({
								monthly: monthly{{ $employee->id }}.firstElementChild.value || monthly{{ $employee->id }}.firstElementChild.placeholder,
								hourly: hourly{{ $employee->id }}.firstElementChild.value || hourly{{ $employee->id }}.firstElementChild.placeholder,
								ot: ot{{ $employee->id }}.firstElementChild.value || ot{{ $employee->id }}.firstElementChild.placeholder,
								holiday: holiday{{ $employee->id }}.firstElementChild.value || holiday{{ $employee->id }}.firstElementChild.placeholder,
								nightdiff: nightdiff{{ $employee->id }}.firstElementChild.value || nightdiff{{ $employee->id }}.firstElementChild.placeholder,
							}),
						}).then(rep => rep.json()).then(json => {
							console.log(json);
							monthly{{ $employee->id }}.innerHTML = json.monthly;
							hourly{{ $employee->id }}.innerHTML = json.hourly;
							ot{{ $employee->id }}.innerHTML = json.overtime;
							holiday{{ $employee->id }}.innerHTML = json.holiday;
							nightdiff{{ $employee->id }}.innerHTML = json.nightdiff;

							document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").innerHTML = "Edit";
							document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").classList.remove("btn-warning");
							document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").classList.add("btn-success");
							document.querySelector("[name=employeeRates-{{ $employee->user_id }}] #editbtn-{{ $employee->user_id }}").style.top = "auto";

							cells.forEach(function(v, i) {
								row{{ $employee->id }}.cells[i].setAttribute("id", v);
							});	

						});
					}

				'>Edit</button>
		</td>
	</tr>
	@endforeach
@endif

@if ($type == "deductions")
	@foreach($employees as $employee)
	<tr>
		<td>{{ $employee->bio_id ? $employee->bio_id : $employee->id + 1000 }}</td>
		<td>{{ App\Profile::getFullName($employee->user_id) }}</td>
		<td>{{ number_format($employee->deductions->late, 2) }}</td>
		<td>{{ number_format($employee->deductions->undertime, 2) }}</td>
		<td>{{ number_format($employee->deductions->additional_deductions, 2) }}</td>
		<td>
			@php 
				$statutory = json_decode($employee->deductions->deductions)->statutory;
			@endphp
			@foreach ($statutory as $deduc => $val)
				<span class="badge badge-warning">{{$deduc}}: {{number_format($val, 2)}}</span>
			@endforeach
		</td>
		<td align=right>
			<button class="btn btn-xs btn-success" onclick='

				fetch ("/deductions/modal/{{ $employee->id }}", {
					headers: {
						"X-CSRF-TOKEN": "{{ csrf_token() }}",
					}
				}).then(rep => rep.text()).then(html => {

					document.querySelector("#modal-view").innerHTML = html;

					$("#modal-view #deduction").modal("toggle");

				});


			'>Edit</button>
		</td>
	</tr>
	@endforeach
@endif 

@if ($type == "earnings")
	@foreach($employees as $employee)
	<tr>
		<td>{{ $employee->bio_id ? $employee->bio_id : $employee->id + 1000 }}</td>
		<td>{{ App\Profile::getFullName($employee->user_id) }}</td>
		<td>{{ $employee->earnings }}</td>
		<td>
		@php
			switch ($employee->earnings->status) {
			case '0': echo '<span class="badge badge-info">Active</span>'; break;
			case '1': echo '<span class="badge badge-warning">Inactive</span>'; break;
			default: echo '<span class="badge badge-danger>Unknown</span>';
			}


		@endphp
		</td>
		<td>
			<button class="btn btn-xs btn-success">Edit</button>
		</td>
	</tr>
	@endforeach
@endif