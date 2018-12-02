@if($status == 'Active')
 <a href="javascript:void(0)"  id="changeStatus-{{ $id }}-Active" class="btn btn-info btn-xs" > Active </a>
@else
 <a href="javascript:void(0)"  id="changeStatus-{{ $id }}-Inactive" class="btn btn-danger btn-xs" > Inactive </a>
@endif
