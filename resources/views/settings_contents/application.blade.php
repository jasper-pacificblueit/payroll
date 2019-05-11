<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6" style="padding: 0px">
        	<form method="post">
        		{{ csrf_field() }}
        		<div class="col-lg-12">
	        		<h2 class="no-padding" style="margin-top: 0px">Database</h2>
	        	</div>

	        	<div class="col-lg-9">
	        		<label>Host</label>
	        		<input placeholder="{{ env("DB_HOST") }}" class="form-control">
	        	</div>

	        	<div class="col-lg-3">
	        		<label>Port</label>
	        		<input placeholder="{{ env("DB_PORT") }}" class="form-control">
	        	</div>

	        	<div class="col-lg-4">
	        		<label>DB user</label>
	        		<input placeholder="{{ env("DB_USERNAME") }}" class="form-control">
	        	</div>

	        	<div class="col-lg-5">
	        		<label>DB password</label>
	        		<input type="password" value="{{ env("DB_PASSWORD") }}" class="form-control">
	        	</div>

	        	<div class="col-lg-3">
	        		<label>Database</label>
	        		<input placeholder="{{ env("DB_DATABASE") }}" class="form-control">
	        	</div>

	        	<div class="col-lg-12">
	        		<h2>Migrations</h2>
	        		<br>
	        		<div class="table-responsive">
	        		@php
	        			use Illuminate\Support\Facades\DB;

	        			$migrations = DB::select("select * from migrations");
	        		@endphp
	        		<table class="table table-striped table-bordered table-hover migrationTable">
	        			<thead>
	        				<tr>
	        					<th>File (Migrations)</th>
	        					<th>Status</th>
	        				</tr>

	        			</thead>
	        			<tbody>
	        				@foreach ($migrations as $mig)
	        				<tr>
	        					<td>{{ $mig->migration }}</td>
	        					<td><strong class="{{ $mig->batch ? "alert-success" : "alert-danger" }} pull-right">M</strong></td>
	        				</tr>
	        				@endforeach
	        			</tbody>
	        			<tfoot></tfoot>
	        		</table>
	        		</div>
	        	</div>

				<div class="col-lg-12">
					<div class="col-lg-12" style="padding: 0px"><hr></div>
					<div class="btn-group pull-right">
						<button class="btn btn-group btn-sm  btn-danger" onclick='

							fetch ("/settings/app/reset", {
								method: "post",
								headers: {
									"X-CSRF-TOKEN": "{{ csrf_token() }}",
								}
							}).then(rep => rep.text()).then(text => {
								document.querySelector("#logout-form").submit();
							});

						'>Reset</button>
						<button class="btn btn-group  btn-sm btn-danger" type="submit">Save</button>
					</div>

				</div>
			</form>
		</div>
		<div class="col-lg-6"></div>
    </div>
 </div>