<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersAddress;
use App\Models\Country;
use App\Models\State;
use App\Models\Admin;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
					->addColumn('phone', function($row){
						return (isset($row->phone))?$row->phone:'NA';       
                    })
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="/admin/customer/' .  $row->id  . ' " class="edit btn btn-primary btn-sm">View</a><a href="/admin/customer/edit/' .  $row->id  . ' " class="edit btn btn-primary btn-sm">Edit</a><a class="edit btn btn-primary btn-sm " id="deleteCus" onclick="deleteItem(this)" data-id="' .  $row->id  . '">Delete</a>';
                           
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       
        return view('users');
    }
	
	public function usersdetails(Request $request){
		$userDetail = User::where("id", $request->id)->first();
		return view('admin.users.show',compact('userDetail'));
	}
	
	public function usersedit(Request $request){
		$userDetail = User::where("id", $request->id)->first();
		return view('admin.users.edit',compact('userDetail'));
	}
	
	public function detailsave(Request $request){
		$data = $request->all();
		
		$getData = array(
			'name' => $data['name'],
			'email' => $data['email'],
			'country' => $data['country'],
			'state' => $data['state'],
			'city' => $data['city'],
			'zipcode' => $data['zipcode'],
			'address' => $data['address'],
		);
		User::where('id', $data['userId'])->update($getData);
		return redirect('/admin/customer')->with('message', 'Customer Information Updated Successfully!!');
	}
	
	public function addnewusers(Request $request){
		$countries = Country::get(["name", "id"]);
		return view('admin.users.addnewusers',compact(['countries']));
	}
	
	public function addnewcus(Request $request){
		$data = $request->all();
		//dd($data);
		$validatedData = $request->validate([
			'name' => 'required',
			'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
			'phone' => 'required|min:10|numeric',
		]);
		$newCus = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($request->password),
			'phone' => $data['phone'],
			'country' => $data['country'],
			'state' => $data['state'],
			'city' => $data['city'],
			'zipcode' => $data['zipcode'],
			'address' => $data['address'],
			'status' => $data['status'],
		]);
		
		$dataCus = array(
			'user_id' => $newCus->id,
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'country' => $data['country'],
			'state' => $data['state'],
			'city' => $data['city'],
			'zipcode' => $data['zipcode'],
			'address1' => $data['address'],
			'default_address' => $data['default_address'],
		);
		$newCus = UsersAddress::create($dataCus);
		
		return redirect()->back()->with('message', 'New Customer Created Successfully!!');
	}
	
	
	public function getstates(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
	
	public function deletecus(Request $request){
        User::find($request->id)->delete();
        return 1;
    }
	
	public function usersmanagement(Request $request)
    {
		
        $data = User::orderBy('id','DESC')->get();
		//dd($data);
        return view('admin.users.usersmanagement',compact('data'));
    }
	
	
	public function usersmanagementinfo($id){
        $userManageDetails = User::find($id);
		//dd($user);
        return view('admin.users.user_management_show',compact('userManageDetails'));
    }
	
	public function usersmanage(){
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create_user_management',compact('roles'));
    }
	
	public function storeusersmanage(Request $request)
    {
        $input = $request->all();
		//dd( $input);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required'
        ]);
    
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
		
        return view('admin.users.create_user_management')
                        ->with('success','User created successfully');
    }
	
	public function editusersmanage($id) {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.users.edit_user_management',compact('user','roles','userRole'));
    }
	
	public function updateusersmanage(Request $request, $id)
    {
		
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
                        $input['password'] = Hash::make($input['password']); 
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
		$data = User::orderBy('id','DESC')->get();
        //return view('admin.users.usersmanagement',compact('data'))
		return redirect('admin/usersmanagement')
                        ->with('success','User updated successfully');
    }
	
	public function userdestroy($id){
        User::find($id)->delete();
		$data = User::orderBy('id','DESC')->get();
        return redirect('admin/usersmanagement')
                        ->with('success','User deleted successfully');
    }
}
