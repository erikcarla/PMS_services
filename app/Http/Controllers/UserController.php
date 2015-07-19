<?php namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\MsUser;
use Illuminate\Http\Request;
use Lang;
use Validator;

class UserController extends Controller {
		
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return MsUser::get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$action = $request->input('action');
		if($action == 'create_user')
		{
			$validator = Validator::make($request->all(), [
	            'email' => 'unique:msuser,email|email|required',
	            'password' => 'alpha_num|required',
	            'role' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return response(array('error' => 'data not valid'), 400);
	        }
			$data['email'] = $request->input('email');
			$data['password'] = $request->input('password');
			$data['role_id'] = $request->input('role');
			MsUser::create_user($data);
			return response('',200);
		}
		return response(array('error' => 'true'), 404);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $action)
	{
		if($action == 'detail')
		{
			$id = $request->input('id');
			$id = (!empty($id)?$id:$this->MYID);
			return MsUser::detail($id);
		}
		return response(array('error' => 'true'), 404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $action)
	{
		if($action == 'update')
		{
			$validator = Validator::make($request->all(), [
	            'email' => 'unique:msuser,email,'.$this->MYID.'|email|required',
	            'role' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return response(array('error' => 'data not valid'), 400);
	        }
	        $data['id'] = $this->MYID;
			$data['email'] = $request->input('email');
			$data['password'] = $request->input('password');
			$data['role_id'] = $request->input('role');
			MsUser::update_user($data);
			return response('',200);
		}
		return response(array('error' => 'true'), 404);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $action)
	{
		if($action == 'delete')
		{
			$validator = Validator::make($request->all(), [
	            'id' => 'required',
	        ]);
	        if ($validator->fails()) {
	            return response(array('error' => 'data not valid'), 400);
	        }
			$data['id'] = $request->input('id');
			MsUser::delete_user($data);
			return response('',200);
		}
		return response(array('error' => 'true'), 404);
	}

}
