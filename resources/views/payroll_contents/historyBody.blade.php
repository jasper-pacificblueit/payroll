
@php($Payslips = \App\Payslips::all()->where('start' , '=' , $payroll->start , 'AND' , 'end' , $payroll->end))

@foreach ($Payslips as $payslip)
   
    {{-- employee_id is equal to user_id LOL :D --}}

    <tr>
        <td>{{\App\Profile::getFullName($payslip->employee_id)}}</td>
    </tr>
@endforeach
