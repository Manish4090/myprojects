<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersAddress;
use App\Models\Country;
use App\Models\State;
use DataTables;
use Illuminate\Support\Facades\Hash;

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
}
