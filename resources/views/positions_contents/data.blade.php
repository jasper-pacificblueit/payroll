@if ( ($Positions = \App\Positions::all())->count() > 0)
    @foreach ($Positions as $position)
    <tr ondblclick="$('#position-{{ $position->id }}').modal('show');">
        <td>
            {{$position->id}}
@can ("position_Modify")
<!-- @@@@@@@@@@@@ modal @@@@@@@@@@@@ -->
<div class="modal inmodal fade" id="position-{{ $position->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<form method="post" action="/positions/{{ $position->id }}">
    {{ csrf_field() }}
    {{ method_field("put") }}
    <div class="modal-header no-padding">
       <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12" style="padding: 0px">
                <div class="col-lg-5">
                    <label>Title</label>
                    <input type=text class="form-control" name="edit-title" placeholder="{{ $position->title }}" title={{$position->title}}>
                </div>
                <div class="col-lg-2">
                    <label>Maximum</label>
                    <input type=number class="form-control" style="width: 100%" name="edit-lim" placeholder={{ $position->lim }}>
                </div>
                <div class="col-lg-5">
                    <label>Status</label>
                    <select class="form-control" name="edit-state">
                        <option value=0 {{ $position->state != 0 ?: 'selected' }}>Available</option>
                        <option value=1 {{ $position->state != 1 ?: 'selected' }}>Unavailable</option>
                        <option value=2 {{ $position->state != 2 ?: 'selected' }}>Temporarily Unavailable</option>
                        <option value=4 {{ $position->state != 3 ?: 'selected' }}>Unknown</option>
                    </select>
                </div>
                <div class="col-lg-12">
                    <label>Description</label>
                    <textarea type="text" name="edit-description" id="" class="form-control" style="width: 100%" required>{{ $position->description }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class='btn-group'>
            <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id='close'>Close</button>
            <button type="submit" class="btn btn-sm btn-success">Save</button>
            <button type="button" class="btn btn-sm btn-danger"
            @if ($position->id == 1 || $position->count() > 0)
                {{ 'disabled' }}
            @endif
             onclick='
                fetch("/positions/{{ $position->id }}", {
                    method: "delete",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    }
                }).then(rep => rep.text()).then(text => {
                    $(".positionTable").DataTable().destroy();
                    document.querySelector("#update").innerHTML = text;
                    $(".positionTable").DataTable({
                        pageLength: 10,
                        language: {
                            paginate: {
                                previous: `<i class="fas fa-arrow-left"></i>`,
                                next: `<i class="fas fa-arrow-right"></i>`,
                            }
                        },
                   }).draw();
                });
            '
             data-dismiss="modal">
                Remove
            </button>
        </div>
    </div>
</form>
</div>
</div>
</div>
<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
@endcan
        </td>
        <td>{{$position->created_at}}</td>
        <td>{{$position->title}}</td>
        <td width=500 class="hidden-xs hidden-sm">{{ $position->description }}</td>
        <td>{{ $position->count() }}/{{ $position->lim }}</td>
        @php
            if ($position->count()/$position->lim == 1) $position->state = 1;

            $position->save();
        @endphp
        <td>
            @php
                switch ($position->state) {
                case 0:
                    echo "<span class='alert-success'>Available</span>";
                    break;
                case 1:
                    echo "<span class='alert-warning'>Unavailable</span>";
                    break;
                case 2:
                    echo "<span class='alert-info'>Temporarily Unavailable</span>";
                    break;
                default:
                    echo "<span class='alert-danger'>Unknown</span>";
                }
            @endphp
        </td>
     </tr> 
    @endforeach
@endif