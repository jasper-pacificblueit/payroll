<div class="row">
	<div class="col-lg-6">
		<h2>Database</h2>
		<div class="col-lg-12">
			Reset database?

			<button class="btn btn-sm btn-success pull-right" onclick='

				$("#progress").modal({
		            backdrop: "static",
		            keyboard: false,
		        });

				fetch ("/settings/app/reset", {
					method: "post",
					headers: {
						"X-CSRF-TOKEN": "{{ csrf_token() }}",
					}
				}).then(rep => rep.text()).then(text => {

					console.log(text);
					window.location.reload();

				});


			'>Reset</button>

			<div class="modal inmodal fade" id="progress" tabindex="-1" role="dialog" aria-hidden="true"></div>
		</div>
	</div>
</div>

