<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <div class="container">
				   @if(session()->has('message'))
						<div class="alert alert-success">
							{{ session()->get('message') }}
						</div>
					@endif
					@if ($errors->any())
							 @foreach ($errors->all() as $error)
								 <div class="alert alert-success">{{$error}}</div>
							 @endforeach
						 @endif
						<!-- edit form column -->
						<div class="col-lg-12 text-lg-center">
							<h2>Add New Customer</h2>
							<br>
							<br>
						</div>
						<div class="col-lg-8 push-lg-4 personal-info">
							 <form role="form" action="{{url('admin/addnewcus')}}" method="post">
							 {{csrf_field()}}
							 
							  <div class="form-group">
								
							  </div>
							  
								<div class="form-group row">
									<div class="col-lg-6">
									<label class=" form-control-label">Name</label>
										<input class="form-control" type="text" name="name" value="" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-6">
									<label class=" form-control-label">Email</label>
										<input class="form-control" type="email" name="email" value="" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-6">
									
									<button type="button" class="btn btn-default btn-lg getNewPass"><span class="fa fa-refresh"></span>Genrate Password</button>
										 <input type="text" class="form-control input-lg" name="password" rel="gp" data-size="32" data-character-set="a-z,A-Z,0-9,#">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-6">
									<label class=" form-control-label">Phone</label>
										<input class="form-control" type="phone" name="phone" value="" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-lg-6">
									<label class=" form-control-label">Status</label>
										<select id="status" class="form-control" name="status">
										  <option value="1">Active</option>
										  <option value="0">Inactive</option>
										</select>
									</div>
								</div>
								
								<label>Manage Address</label>
								
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Country</label>
									<div class="col-lg-9">
										<select name="country"  id="country-dd" class="form-control">
											<option value="" >Select Country</option>
											@foreach ($countries as $data)
											<option value="{{$data->name}}" data-id="{{$data->id}}">
												{{$data->name}}
											</option>
											@endforeach
										</select>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">State</label>
									<div class="col-lg-9">
										<select class="form-control" id="state-dd" name="state">
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">City</label>
									<div class="col-lg-9">
										<input class="form-control" name="city" type="text" value="{{ @$userDetail['city'] }}" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Zip Code</label>
									<div class="col-lg-9">
										<input class="form-control" name="zipcode" type="text" value="{{ @$userDetail['zipcode'] }}" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Full Address</label>
									<div class="col-lg-9">
										<textarea class="form-control" id="address" name="address" value="fasdflk" rows="4" cols="50">{{ @$userDetail['address'] }}
										</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Billing Address</label>
									<div class="col-lg-9">
										<input id="billingadd" type="checkbox" name="default_address" value="">
									</div>
								</div>
								
								
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label"></label>
									<div class="col-lg-9">
										<input class="form-control" type="submit" value="Save" />
									</div>
								</div>
								
								
							</form>
						</div>
						
				</div>
				<hr />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
$('#country-dd').on('change', function () {
                var idCountry = $('option:selected', this).attr('data-id');
				//alert(idCountry);
                $("#state-dd").html('');
                $.ajax({
                    "url": "{{ url('admin/getstates') }}",
                    "type": "POST",
                    "data": {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    "dataType": 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            
		
</script>