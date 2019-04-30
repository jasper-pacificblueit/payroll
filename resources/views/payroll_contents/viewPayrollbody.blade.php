@php( $employees = \App\Employee::all())

@foreach ($employees as $employee)
    <?php
        $startDate = date("Y-m-d" , strtotime($start));
        $endDate = date("Y-m-d" , strtotime($end));
        $EmployeeRate = App\Rate::getHourlyRate($employee->id);
        $EmployeeTotalHours = App\DateTimeRecord::getTotalHours($startDate , $endDate , $employee->user_id);

        $Basic = App\Payroll::getBasic($EmployeeRate , $EmployeeTotalHours);
        $Overtime = 0;
        $Holiday = 0;


        $TotalEarnings = App\Payroll::getEarnings($Basic , $Overtime , $Holiday);

        $TotalDeductions = 0;
        $NetPay =  App\Payroll::NetPay($TotalEarnings , $TotalDeductions);
     ?>
    
    @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$startDate , $endDate])->get())
    <tr>
        <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
        <td>₱ {{$EmployeeRate}}</td>
        <td>{{$EmployeeTotalHours}}</td>
        <td>₱ {{ number_format($TotalEarnings , 2) }}</td>
        <td>₱ 0</td>
        <td>₱ {{ number_format($NetPay , 2) }}</td>
        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details-{{$employee->user_id}}">Details</button></td>
    </tr>

    <div class="modal inmodal fade" id="details-{{$employee->user_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{{$employee->user_id}}</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                        <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged.</p>
                                <div class="form-group"><label>Sample Input</label> <input type="email" placeholder="Enter your email" class="form-control"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

@endforeach