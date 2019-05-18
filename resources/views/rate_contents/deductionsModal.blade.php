<div class="modal inmodal fade" id="deduction" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px"></h4>
            </div>
              <div class="modal-body">
                 <div class="row">
                 		<div class="col-lg-12" style="padding: 0">
                 			<div class="col-lg-12">
                     		<label>Late & Undertime</label>
                     		<div class="col-lg-12" style="padding: 0">
                     			<div class="table-responsive">
                     				<table class="table table-striped table-hover table-bordered">
                     					<thead>
                     						<tr>
                     							<th>Deduction</th>
                     							<th>Value</th>
                     							<th width=1></th>
                     						</tr>
                     					</thead>
                     					<tbody>
                     						<tr id="late">
                     							<td>Late</td>
                     							<td id="late-value">{{ number_format($employee->deductions->late, 2) }}</td>
                     							<td>
                     								<button class="btn btn-xs btn-default" onclick='

                     										var late = document.querySelector("#late");

                     										if (late.children[2].firstElementChild.innerHTML == "Save") {
                     											late.children[0].innerHTML = late.querySelector("#late-desc").value 
                     												|| late.querySelector("#late-desc").placeholder;
                     											late.children[1].innerHTML = late.querySelector("#late-val").value
                     												|| late.querySelector("#late-val").placeholder;

                     											late.children[2].firstElementChild.innerHTML = "Edit";
                     											late.children[2].firstElementChild.style.top = "auto";
                     											adddeduction--;
                     											return;
                     										}


                     										var late_desc = late.children[0].innerHTML;
                     										var late_val = late.children[1].innerHTML;

                     										late.children[0].innerHTML = `<input class="form-control" placeholder="${late_desc}" id="late-desc" readonly>`;
                     										late.children[1].innerHTML = `<input class="form-control" placeholder="${late_val}" id="late-val">`;

                     										late.children[2].firstElementChild.style.position = "relative";
                     										late.children[2].firstElementChild.style.top = "5px";
                     										late.children[2].firstElementChild.innerHTML = "Save";

                     										adddeduction++;
                     								'>Edit</button>
                     							</td>
                     						</tr>
                     						<tr id="undertime">
                     							<td>Undertime</td>
                     							<td id="undertime-value">{{ number_format($employee->deductions->undertime, 2) }}</td>
                     							<td>
                     								<button class="btn btn-xs btn-default" onclick='
                     										var undertime = document.querySelector("#undertime");

                     										if (undertime.children[2].firstElementChild.innerHTML == "Save") {
                     											undertime.children[0].innerHTML = undertime.querySelector("#undertime-desc").value 
                     												|| undertime.querySelector("#undertime-desc").placeholder;
                     											undertime.children[1].innerHTML = undertime.querySelector("#undertime-val").value
                     												|| undertime.querySelector("#undertime-val").placeholder;

                     											undertime.children[2].firstElementChild.innerHTML = "Edit";
                     											undertime.children[2].firstElementChild.style.top = "auto";
                     											adddeduction--;
                     											return;
                     										}

                     										var late_desc = undertime.children[0].innerHTML;
                     										var late_val = undertime.children[1].innerHTML;

                     										undertime.children[0].innerHTML = `<input class="form-control" placeholder="${late_desc}" id="undertime-desc" readonly>`;
                     										undertime.children[1].innerHTML = `<input class="form-control" placeholder="${late_val}" id="undertime-val">`;

                     										undertime.children[2].firstElementChild.style.position = "relative";
                     										undertime.children[2].firstElementChild.style.top = "5px";
                     										undertime.children[2].firstElementChild.innerHTML = "Save";

                     										adddeduction++;
                     								'>Edit</button>
                     							</td>
                     						</tr>
                     						<tr id="additional_deductions">
                     							<td>Additional Deductions</td>
                     							<td id="add_deducts-value">{{ number_format($employee->deductions->additional_deductions, 2) }}</td>
                     							<td>
                     								<button class="btn btn-xs btn-default" onclick='
                     										var additional_deductions = document.querySelector("#additional_deductions");

                     										if (additional_deductions.children[2].firstElementChild.innerHTML == "Save") {
                     											additional_deductions.children[0].innerHTML = additional_deductions.querySelector("#additional_deductions-desc").value 
                     												|| additional_deductions.querySelector("#additional_deductions-desc").placeholder;
                     											additional_deductions.children[1].innerHTML = additional_deductions.querySelector("#additional_deductions-val").value
                     												|| additional_deductions.querySelector("#additional_deductions-val").placeholder;

                     											additional_deductions.children[2].firstElementChild.innerHTML = "Edit";
                     											additional_deductions.children[2].firstElementChild.style.top = "auto";
                     											adddeduction--;
                     											return;
                     										}

                     										var late_desc = additional_deductions.children[0].innerHTML;
                     										var late_val = additional_deductions.children[1].innerHTML;

                     										additional_deductions.children[0].innerHTML = `<input class="form-control" placeholder="${late_desc}" id="additional_deductions-desc" readonly>`;
                     										additional_deductions.children[1].innerHTML = `<input class="form-control" placeholder="${late_val}" id="additional_deductions-val">`;

                     										additional_deductions.children[2].firstElementChild.style.position = "relative";
                     										additional_deductions.children[2].firstElementChild.style.top = "5px";
                     										additional_deductions.children[2].firstElementChild.innerHTML = "Save";
                     										adddeduction++;
                     								'>Edit</button>
                     							</td>
                     						</tr>
                     					</tbody>
                     				</table>
                     			</div>
                     		</div>
                     	</div>
                     	
                     	<div class="col-lg-12">
                     		<hr>
                     		<label>Statutory</label>
                     		<div class="col-lg-12" style="padding: 0">
                       		<div class="table-responsive" style="height: 150px; width: 100%; margin-bottom: 5px">
	                       		<table class="table table-striped table-hover table-bordered">
	                       			<thead>
	                       				<tr>
	                       					<th>Deduction</th>
	                       					<th>Value</th>
	                       					<th width=1></th>
	                       				</tr>
	                       			</thead>
	                       			<tbody id="misc">
	                       				@php
	                       					$statutory = json_decode($employee->deductions->deductions)->statutory;
	                       				@endphp
	                       				@foreach ($statutory as $name => $val)
	                       					<tr id="{{ $name }}">
	                       						<td>{{ $name }}</td>
	                       						<td id="{{ $name }}-value">{{ $val }}</td>
	                       						<td>
	                       							<button class="btn-xs btn btn-default" onclick='

	                       								var {{ $name }} = document.querySelector("#{{ $name }}");

                     										if ({{ $name }}.children[2].firstElementChild.innerHTML == "Save") {

                     											{{ $name }}.children[0].innerHTML = {{ $name }}.querySelector("#{{ $name }}-desc").value 
                     												|| {{ $name }}.querySelector("#{{ $name }}-desc").placeholder;
                     											{{ $name }}.children[1].innerHTML = {{ $name }}.querySelector("#{{ $name }}-val").value
                     												|| {{ $name }}.querySelector("#{{ $name }}-val").placeholder;

                     											{{ $name }}.children[2].firstElementChild.innerHTML = "Edit";
                     											{{ $name }}.children[2].firstElementChild.style.top = "auto";
                     											adddeduction--;
                     											return;
                     										}

                     										var late_desc = {{ $name }}.children[0].innerHTML;
                     										var late_val = {{ $name }}.children[1].innerHTML;

                     										{{ $name }}.children[0].innerHTML = `<input class="form-control" placeholder="${late_desc}" id="{{ $name }}-desc">`;
                     										{{ $name }}.children[1].innerHTML = `<input class="form-control" placeholder="${late_val}" id="{{ $name }}-val">`;

                     										{{ $name }}.children[2].firstElementChild.style.position = "relative";
                     										{{ $name }}.children[2].firstElementChild.style.top = "5px";
                     										{{ $name }}.children[2].firstElementChild.innerHTML = "Save";
                     										adddeduction++;
	                       							'>Edit</button>
	                       						</td>
	                       					</tr>
	                       				@endforeach
	                       			</tbody>
	                       		</table>
                       		</div>
                       		<button class="btn btn-default btn-sm pull-right" onclick='

                       			var tbody = document.querySelector("#misc");

                       			var tr = document.createElement("tr");

                       			tr.setAttribute("id", "deduction-" + document.querySelector("#misc").childElementCount);

                       			tr.innerHTML = `
                       				<td>
                       					<input class="form-control input" placeholder="Deduction">
                       				</td>
                       				<td>
                       					<input class="form-control input" placeholder="0.00" id="">
                       				</td>
                       				<td>
                       					<button class="btn btn-default btn-xs" style="top: 5px; position: relative" onclick=`
                       					+ `

                       						save_deduction(${document.querySelector("#misc").childElementCount});

                       					` +
                       					`>Save</button>
                       				</td>
                       			`;

                       			tbody.appendChild(tr);

                       			adddeduction++;
                       		'>Add Deduction</button>
                     		</div>
                     	</div>
                 		</div>			          
                 </div>
              </div>
              <div class="modal-footer">
                  <div class='btn-group'>
                      <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id='close'>Close</button>
                      <button type="submit" class="btn btn-sm btn-success" id="deduction-submit">Save</button>
                  </div>
              </div>
        </div>
    </div>
</div>

<img src="..." hidden onerror='

	modalInterval = setInterval(_ => {

		if (adddeduction > 0)	document.querySelector("#deduction-submit").classList.add("disabled");
		else document.querySelector("#deduction-submit").classList.remove("disabled");

	}, 500);

	$("#deduction").on("hide.bs.modal", function () {
		clearInterval(modalInterval);
	});

	document.querySelector("#deduction-submit").addEventListener("click", event => {

			if (adddeduction) return;

			$("#deduction").modal("hide");

			fetch ("/deductions/{{ $employee->id }}", {
				method: "put",
				headers: {
					"X-CSRF-TOKEN": "{{ csrf_token() }}",
				},
				body: JSON.stringify((_ => {

					var json = {
						deductions: {
							statutory: {},
						},
					};

					Array.from(document.querySelector("#misc").children).forEach((value, index) => {
						if (value.children[0].innerHTML == "empty" || value.children[0].innerHTML == "REMOVE") return;

						json.deductions.statutory[value.children[0].innerHTML] = parseFloat(value.children[1].innerHTML);
					});

					json.deductions = JSON.stringify(json.deductions);

					json["late"] = parseFloat(document.querySelector("#late-value").innerHTML);
					json["undertime"] = parseFloat(document.querySelector("#undertime-value").innerHTML);
					json["additional_deductions"] = parseFloat(document.querySelector("#add_deducts-value").innerHTML);

					return json;
				})()),

			}).then(rep => rep.json()).then(json => {

				console.log(json);
				chemployee(document.querySelector(".dep"));
			});

	});

'>