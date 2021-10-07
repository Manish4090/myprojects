<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
	
	<x-slot name="header">
      <a class="btn btn-primary" href="{{ route('admin.customer') }}">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   							
							<div class="col-lg-8 push-lg-4 personal-info">
							
							 <input type="hidden" name="userId" value="{{ $userManageDetails['id'] }}">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Name</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="name" value="{{ @$userManageDetails['name'] }}" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Email</label>
									<div class="col-lg-9">
										<input class="form-control" name="email" type="email" value="{{ @$userManageDetails['email'] }}" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Phone</label>
									<div class="col-lg-9">
										<input class="form-control" name="phone" type="phone" value="{{ @$userManageDetails['phone'] }}" readonly>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Country</label>
									<div class="col-lg-9">
										<input class="form-control" name="country" type="text" value="{{ @$userManageDetails['country'] }}" readonly>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">State</label>
									<div class="col-lg-9">
										<input class="form-control" name="state" type="text" value="{{ @$userManageDetails['state'] }}" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">City</label>
									<div class="col-lg-9">
										<input class="form-control" name="city" type="text" value="{{ @$userManageDetails['city'] }}" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Zip Code</label>
									<div class="col-lg-9">
										<input class="form-control" name="zipcode" type="text" value="{{ @$userManageDetails['zipcode'] }}" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Role</label>
									<div class="col-lg-9">
										<input class="form-control" name="zipcode" type="text" value="{{ @$userManageDetails['zipcode'] }}" readonly>
									</div>
								</div>
								
						</div>
						  
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>