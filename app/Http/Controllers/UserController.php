<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\UserMgt;
use App\Models\FilterModel;
use File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserMgt::all();
        return view('user.index')->with('user', $users);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = array();
    	foreach (UserMgt::all() as $user) {
    		$users[$user->id] = $user->name;
    	}
    	return view('user.create')->with('user', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'active' => 'required',
        ]);
          
        if ($validator->fails()) {
            return redirect('user/create')
                ->withInput()
                ->withErrors($validator);
    }
    // Create user

    $user = new UserMgt();
    $user->email = $request->email;
    $user->username = $request->username;
    $user->password = $request->password;
    $user->role = $request->role;
    $user->active = $request->active;
    $user->save();
    Session::flash('user_create',' "' . $user->username . '" has been inserted successfully!');
    return redirect('user');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = UserMgt::findOrFail($id);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserMgt::findOrFail($id);
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'username' => 'required',
            'role' => 'required',
            'active' => 'required',
		]);
		if ($validator->fails()) {
			return redirect('user/')
            ->withInput()
            ->withErrors($validator);
		}
		// Update the User
		$user = UserMgt::find($id);
		$user->email = $request->Input('email');
        $user->username = $request->Input('username');
        $user->role = $request->Input('role');
        $user->active = $request->Input('active');
		$user->save();
		Session::flash('user_update',' "'. $user->username . '" has been updated');
		return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = UserMgt::find($id);
        $user->delete();
        Session::flash('user_deleted','User "'. $user->id . '" was deleted.');
        return redirect('user');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = UserMgt::where('username', 'like', "%$query%")
        ->orWhere('email', 'like', "%$query%")
        ->get();

        return view('user.search', compact('users'));
    }

    public function getBySearch(Request $request)
    {
        $keyword = !empty($request->input('keyword')) ? $request->input('keyword') : "";
        $user = UserMgt::all();
        if ($keyword != "") {
            return view('user.search')
            ->with('users', UserMgt::where('username', 'LIKE', '%' . $keyword . '%')->paginate(2))
                ->with('keyword', $keyword)
                ->with('users', $user);
        } else {
            return view('user.index');
        }
    }
    public function status_filter(Request $request)
    {
        $filter = FilterModel::where('role', true);

        if ($request->has('1')) {
            $filter->where('role', $admin);
        }

        if ($request->has('2')) {
            $filter->where('role', $customer);
        }

        return $filter->get();

        return redirect('user', ['filter' => $filter]);

    }
}
