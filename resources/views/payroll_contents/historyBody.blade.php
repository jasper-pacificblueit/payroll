
@php($Payslips = \App\Payslips::all()->where('start' , '=' , $payroll->start , 'AND' , 'end' , $payroll->end))

@foreach ($Payslips as $payslip)
   
    {{-- employee_id is equal to user_id LOL :D --}}

    <tr>
        <td>{{\App\Profile::getFullName($payslip->employee_id)}}</td>
        <td>--</td>
        <td>--</td>
        <td>P {{number_format($payslip->total_income , 2)}}</td>
        <td>P {{number_format($payslip->total_deduction , 2)}}</td>
        <td>P {{number_format($payslip->net_pay , 2)}}</td>
        <td><button class="btn btn-info btn-sm">View Payslip</button></td>
    </tr>

@endforeach
