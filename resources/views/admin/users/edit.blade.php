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
						<!-- edit form column -->
						<div class="col-lg-12 text-lg-center">
							<h2>Edit Profile</h2>
							<br>
							<br>
						</div>
						
						<div class="col-lg-8 push-lg-4 personal-info">
							 <form role="form" action="{{url('admin/customer/detailsave')}}" method="post">
							 {{csrf_field()}}
							 <input type="hidden" name="userId" value="{{ $userDetail['id'] }}">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Name</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="name" value="{{ $userDetail['name'] }}" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Email</label>
									<div class="col-lg-9">
										<input class="form-control" name="email" type="email" value="{{ $userDetail['email'] }}" />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Phone</label>
									<div class="col-lg-9">
										<input class="form-control" name="phone" type="phone" value="{{ $userDetail['phone'] }}" />
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Country</label>
									<div class="col-lg-9">
										<input class="form-control" name="country" type="text" value="{{ @$userDetail['country'] }}" />
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">State</label>
									<div class="col-lg-9">
										<input class="form-control" name="state" type="text" value="{{ @$userDetail['state'] }}" />
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