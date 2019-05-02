<div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Date Registered</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="EmployeeTable"></tbody>

             </table>
        </div>
    </div>
    <span id="modal-panel"></span>
</div>
<script>
  function DepartmentSelect(str) {
        if (str.length==0) { 
                document.getElementById("showEmp").innerHTML="";
                document.getElementById("showEmp").style.border="0px";
                return;
        }

        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {

                    document.getElementById("DepartmentSelector").innerHTML = this.responseText;
                    document.querySelector("#select2-DepartmentSelector-container").innerText = 
                        document.getElementById("DepartmentSelector").options[document.getElementById("DepartmentSelector").selectedIndex].text;
                        
                    EmployeeSelect(document.getElementById("DepartmentSelector").value);
                }
        }

        xmlhttp.open("GET","selectDepartment?q="+str,true);
        xmlhttp.send();
  }

    DepartmentSelect(document.getElementById('CompanySelector').value);
</script>

