<x-admin-layout>
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::model($user, ['method' => 'POST','url' => ['admin/update-users-management', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
	<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Employee ID:</strong>
            {!! Form::text('emp_id', null, array('placeholder' => 'Employee ID','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <button type="button" class="btn btn-default btn-lg getNewPass"><span class="fa fa-refresh"></span>Genrate Password</button>
			<input type="text" class="form-control input-lg" name="password" rel="gp" data-size="32" data-character-set="a-z,A-Z,0-9,#">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Gender:</strong>
			<select id="status" class="form-control" name="gender">
			  <option value="">Gender</option>
			  <option value="Male" {{ $user->gender == 'Male'  ? 'selected' : ''}}>Male</option>
			  <option value="Female" {{ $user->gender == 'Female'  ? 'selected' : ''}}>Female</option>
			</select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
           {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
	<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Status:</strong>
			<select id="status" class="form-control" name="status">
			  <option value="1" {{ $user->status == 1  ? 'selected' : ''}} >Active</option>
			  <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
			</select>
        </div>
    </div>
	<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date of Joining:</strong>
			{!! Form::text('doj', null, array('placeholder' => 'Date of Joining','class' => 'form-control','id'=>'datepicker')) !!}
			
        </div>
    </div>
	<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date of Birth:</strong>
			{!! Form::text('date_of_birth', null, array('placeholder' => 'Date of Birth','class' => 'form-control','id'=>'datepicker1')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>

</x-admin-layout>
