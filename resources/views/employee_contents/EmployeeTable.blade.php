
@if (count($data) > 0)
    @foreach ($data as $employee)
    <tr>
        <td>{{$employee->getProfile->fname}} {{$employee->getProfile->lname}}</td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5">No data</td>
    </tr>
@endif