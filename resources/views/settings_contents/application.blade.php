<div class="row">
    <div class="col-lg-12">
    <form method="post" action="/settings/app">
    	{{ csrf_field() }}
        <div class="col-lg-6" style="padding: 0px">
        	<div class="col-lg-12">
        		<h2 style='margin-top: 0px'>Migrations</h2>
        		<br>
        		<div class="table-responsive">
        		@php
        			$migrations = DB::select("select * from migrations");
        		@endphp
        		<table class="table table-striped table-bordered table-hover migrationTable">
        			<thead>
        				<tr>
        					<th>Migration</th>
        					<th>Status</th>
                            <th></th>
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
        						<strong class="{{ $mig->batch ? "alert-success" : "alert-danger" }} pull-right">M</strong>
        					</td>
                            <td>
                                <a class="btn btn-xs btn-success">Backup</a>
                            </td>
        				</tr>
        				@endforeach
        			</tbody>
        			<tfoot></tfoot>
        		</table>
        		</div>
        	</div>
		</div>
		<div class="col-lg-6"></div>
		<div class="col-lg-12">
				<div class="col-lg-12" style="padding: 0px"><hr></div>
				<div class="btn-group pull-right">
					<a class="btn btn-group btn-sm  btn-danger" onclick='

						fetch ("/settings/app/reset", {
							method: "post",
							headers: {
								"X-CSRF-TOKEN": "{{ csrf_token() }}",
							}
						}).then(rep => rep.text()).then(text => {
							console.log(text);
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