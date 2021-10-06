<!DOCTYPE html>


<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
	<x-slot name="header">
        <a href="{{url('/admin/addnew/customer')}}">Add New Customer</a>
    </x-slot>
	
					@if(session()->has('message'))
						<div class="alert alert-success">
							{{ session()->get('message') }}
						</div>
					@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone Number</th>
								<th width="100px">Action</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
   
<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/customer') }}",
        columns: [
			
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
  
  
  function deleteItem(e){
	 let id = e.getAttribute('data-id');
	 swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
               $.ajax({
                    "url": "{{ url('admin/customer/delete') }}",
                    "type": "POST",
                    "data": {id: id,_token: '{{csrf_token()}}'},
                    success: function (result) {
                         swal({
							  title: "Customer Account Deleted Successfully!!",
							  icon: "success",
							  buttons: true,
							  dangerMode: true,
						  })
						setTimeout(function() {
        
							location.reload();
						}, 2000);
                    }
                });
            }
          });
}
</script>
