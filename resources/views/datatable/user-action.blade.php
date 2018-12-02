<a href="{{ url('admin/users/'.encode($id).'/edit') }}" data-toggle="tooltip" data-original-title="Edit" class="edit">
	<i class="fa fa-pencil text-inverse m-r-10"></i> 
</a>
<?php $delet_Url = "'hard-delete/users/$id','user_table'"; ?>
<a href="javascript:void(0);" data-toggle="tooltip"  onclick="return deleteData(<?php echo $delet_Url ?>)" data-original-title="Delete" class="delete">
	<i class="fa fa-close text-danger"></i>
</a>

<!-- <a href="javascript:void(0);" data-toggle="tooltip"  onclick="return deleteData(<?php echo $delet_Url ?>)" data-original-title="Delete" data-id="{{ $id }}" class="delete">
	<i class="fa fa-close text-danger"></i>
</a> -->