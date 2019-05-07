    
@foreach ($data as $department)
    <option value="{{$department->id}}">{{$department->name}}</option>
@endforeach

