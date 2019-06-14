<div class="row">
    <div class="col-lg-12">
    <form method="post" action="/settings/app/{{ auth()->user()->id }}">
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
            <div class="col-lg-12">
                <h2 style="margin-top: 0px">Users Configuration</h2>
                <a href="/editprofile">(NOTE) If you want to edit your profile information just click this statement.</a>
                <div class="col-lg-12" style="padding: 0px">
                    <h3 class="text-muted">Change User password</h3>
                    <label for="current" style="width: 305px">Current password: </label>
                    <input class="form-control" style="margin-top: 1px" name="current" type="password" id="current" placeholder="Password">
                    <br>
                    <label for="new" style="width: 305px">New password: </label>
                    <input class="form-control" style="margin-top: 1px" name="new" type="password" id="new" placeholder="Password">
                    <br>
                    <label for="new" style="width: 305px">Retype new password: </label>
                    <input class="form-control" style="margin-top: 1px" name="renew" type="password" id="new" placeholder="Password">
                </div>
                <input type="text" name="skin" id="skin" hidden value="">
                <div class="col-lg-12" style="padding: 0px">
                    <br>
                    <br>
                    <h3>UI Theme</h3>
                    <div id="theme-slider" style="visibility: hidden">
                        <div id="default">
                            <h4>Style #1</h4>
                            <img src="/img/default.png">
                            <br>
                            <a class="btn btn-success" onclick="applyStyle('default')">Apply</a>
                        </div>
                        <div id="skin-1">
                            <h4>Style #2<h4>
                            <img src="/img/skin-1.png">
                            <br>
                            <a class="btn btn-success" onclick="applyStyle('skin-1')">Apply</a>
                        </div>
                        <div id="skin-2">
                            <h4>Style #3</h4>
                            <img src="/img/skin-2.png">
                            <br>
                            <a class="btn btn-success" onclick="applyStyle('skin-2')">Apply</a>
                        </div>
                        <div id="skin-3">
                            <h4>Style #4</h4>
                            <img src="/img/skin-3.png">
                            <br>
                            <a class="btn btn-success" onclick="applyStyle('skin-3')">Apply</a>
                        </div>
                    </div>

                </div>
            </div>
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