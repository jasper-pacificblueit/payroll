
function chcom(obj) {

	fetch ("/selectDepartment?q=" + obj.value, {
		headers: {
			"X-CSRF-TOKEN": document.querySelector("meta#_token").getAttribute("value"),
		}
	}).then(rep => rep.text()).then(html => {

		document.querySelector("#dep").innerHTML = html;
		$("#dep").select2();
		
		chdep(document.querySelector("#dep"));
	});

}

function chdep(obj) {

	checkAttendance(document.getElementById('start').value, document.getElementById('end').value, obj.value);

}







