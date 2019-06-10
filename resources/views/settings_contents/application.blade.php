<div class="row">
    <div class="col-lg-12">
    <form method="post" action="/settings/app">
    	{{ csrf_field() }}
        <div class="col-lg-6" style="padding: 0px">
        	<div class="col-lg-12">
        		<h2 style='margin-top: 0px'>Migrations</h2>
                <p>• You can double click a row to save its data into a json.</p>
        		<br>
        		<div class="table-responsive">
        		@php
        			$migrations = DB::select("select * from migrations");
        		@endphp
        		<table class="table table-striped table-bordered table-hover migrationTable">
        			<thead>
        				<tr>
        					<th>Migration</th>
        					<th width=10></th>
        				</tr>
        			</thead>
        			<tbody>
        				@foreach ($migrations as $mig)
        				<tr ondblclick='
        						@foreach ($tables as $tbl)
        							@if (strpos($mig->migration, $tbl))
										download(`{!! json_encode(DB::select("select * from " . $tbl . ($tbl == 'users' ? " where id != 1":"")), JSON_PRETTY_PRINT) !!}`, "{{ $tbl }}.bak.json");
        								@break
        							@endif
        						@endforeach
        				'>
        					<td>{{ $mig->migration }}</td>
        					<td>
        						<strong class="{{ $mig->batch ? "alert-success" : "alert-danger" }} pull-right" title="Status">M</strong>
        					</td>
        				</tr>
        				@endforeach
        			</tbody>
        		</table>
        		</div>
        	</div>
		</div>

		<div class="col-lg-6" style="padding: 0px">


        </div>

		<div class="col-lg-12">
				<div class="col-lg-12" style="padding: 0px"><hr></div>
				<div class="btn-group pull-right">
					<a class="btn btn-group btn-sm  btn-danger" onclick='

                        swal({
                            title: "Reset database?",
                            text: "Resetting the database will delete all the payrolls data and employees.",
                            showCancelButton: true,
                            type: "warning",
                        }, function () {
                            toastr.error("Please wait after awhile you will be redirected to the dashboard.<br><br><span class=pull-right>System message</span>", "Payroll is now resetting.");

                            fetch ("/settings/app/reset", {
                                method: "post",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                }
                            });

                            window.location.href = "/";
                        });
						

					'>Reset</a>
					<input class="btn btn-group  btn-sm btn-danger" type="submit" name="submit" value="Save">
				</div>
			</div>
		</form>
    </div>
 </div>

 <script>

 	function download(json, fname) {
 		const a = document.createElement('a');
		const type = fname.split(".").pop();
		a.href = URL.createObjectURL(new Blob([json], { type:`text/${type === "txt" ? "plain" : type}` }));
		a.download = fname;
		a.click();
 	}

 </script>