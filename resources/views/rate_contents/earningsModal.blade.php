<div class="modal inmodal fade" id="earning" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px"></h4>
            </div>
              <div class="modal-body">
                 <div class="row">
                 	<div class="col-lg-12">
                        To remove an earning just name it <label>REMOVE</label>.
                        <span class="pull-right">
                            <select name="status" class="form-control form-control-md">
                                <option value=1>Inactive</option>
                                <option value=0 @if($employee->earnings->status == 0) selected @endif>Active</option>
                            </select>
                        </span>
                        <br><br>
                 		<div class="col-lg-12" style="padding: 0">
                   		<div class="table-responsive" style="height: 150px; width: 100%; margin-bottom: 5px">
                       		<table class="table table-striped table-hover table-bordered">
                       			<thead>
                       				<tr>
                       					<th>Earnings</th>
                       					<th>Value</th>
                                        <th width=1></th>
                       				</tr>
                       			</thead>
                       			<tbody id="misc">
                                    @php
                                        $earnings = json_decode($employee->earnings->earnings)
                                    @endphp

                                    @foreach ($earnings as $name => $value)
                                        <tr id={{ $name }}>
                                            <td>{{ $name }}</td>
                                            <td>{{ $value }}</td>
                                            <td>
<button class="btn btn-xs btn-success" onclick='
    
    var earning = document.querySelector("#earning tbody#misc #{{ $name }}");

    if (this.innerHTML == "Save") {

        earning.children[0].innerHTML = 
            earning.children[0].firstElementChild.value.replace(/ /g,"") || earning.children[0].firstElementChild.placeholder;
        earning.children[1].innerHTML = 
            earning.children[1].firstElementChild.value.replace(/ /g,"") || earning.children[1].firstElementChild.placeholder;

        this.innerHTML = "Edit";
        return;
    }

    earning.children[0].innerHTML = `<input class="form-control" type="text" placeholder=${earning.children[0].innerHTML} name="name">`;

    earning.children[1].innerHTML = `<input class="form-control" type="number" step=".01" placeholder=${earning.children[1].innerHTML} name="value">`;

    this.innerHTML = "Save";

'>Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                       			</tbody>
                       		</table>
                   		</div>
                        <button class="btn btn-default pull-right btn-sm" onclick='

                            var tablelist = document.querySelector("#earning tbody#misc");
                            var row = document.createElement("tr");

                            row.innerHTML = `
                                <td>
                                    <input class="form-control" placeholder="Name">
                                </td>
                                <td>
                                    <input class="form-control" type="number" step=".01" placeholder="Value">
                                </td>
                                <td>
                                    <button class="btn btn-success btn-xs" onclick="

                                        save_earnings(${tablelist.childElementCount})

                                    ">Save</button>
                                </td>
                            `;

                            tablelist.appendChild(row);
                        '>Add Earnings</button>
                 		</div>
                 	</div>
             		</div>			          
                 </div>
              <div class="modal-footer">
                  <div class='btn-group'>
                      <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id='close'>Close</button>
                      <button type="submit" class="btn btn-sm btn-success" id="earning-submit">Save</button>
                  </div>
              </div>
        </div>
    </div>
</div>

<img src="..." onerror='

    document.querySelector("#earning button#earning-submit").onclick = function () {

        var state = true;
        var json = {
            status: document.querySelector("#earning [name=status]").value,
            earnings: {},
        };

        Array.from(document.querySelector("#earning tbody#misc").children).forEach(function (v) {
            if ((v.children[0].firstElementChild != null &&   
                v.children[1].firstElementChild != null)) {

                toastr.error("Please save any unsave earnings.", "Insufficient input provided");

                state = false;
                return;
            }

            if (state && v.children[0].innerHTML.toLowerCase() != "remove")
                json.earnings[v.children[0].innerHTML.replace(/ /g,"")] = parseFloat(v.children[1].innerHTML);
        });

        if (!state) return;

        fetch ("/earnings/{{ $employee->id }}", {
            method: "post",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify(json),
        }).then(rep => rep.json()).then(json => window.location.reload());
    };

'>