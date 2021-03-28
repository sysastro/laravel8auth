<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPositionController extends Controller
{
  public function index()
  {
    $positions = UserPosition::all();
    return response()->json([
      'success' => true,
      'message' => 'List Position',
      'data'    => $positions
    ], 200);
  }
  
  /**
   * show
   *
   * @param  mixed $id
   * @return void
   */
  public function show($id)
  {
    $position = UserPosition::findOrfail($id);
    return response()->json([
      'success' => true,
      'message' => 'Detail Data Position',
      'data'    => $position
    ], 200);
  }
  
  /**
   * store
   *
   * @param  mixed $request
   * @return void
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'user_id'   => 'required',
      'status' => 'required',
      'position' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }
    $position = User::findOrFail($request->user_id);
    if (empty($position)) {
      return response()->json([
        'success' => false,
        'message' => 'User not found',
      ], 409);
    }
    $data = [
      'user_id'     => $request->user_id,
      'status'   => $request->status,
      'position'   => $request->position
    ];
    $position = UserPosition::create($data);
    if($position) {
      return response()->json([
        'success' => true,
        'message' => 'Position Created',
        'data'    => $data
      ], 201);
    }
    return response()->json([
      'success' => false,
      'message' => 'Position Failed to Save',
    ], 409);
  }
  
  /**
   * update
   *
   * @param  mixed $request
   * @param  mixed $position
   * @return void
   */
  public function update(Request $request, UserPosition $position)
  {
    $validator = Validator::make($request->all(), [
      'user_id'   => 'required',
      'status' => 'required',
      'position' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }
    $position = UserPosition::where('user_id', $position->user_id)->first();
    if($position) {
      $position->update([
        'status'     => $request->status,
        'position'   => $request->position
      ]);
      return response()->json([
        'success' => true,
        'message' => 'Position Updated',
        'data'    => $position
      ], 200);
    }
    return response()->json([
      'success' => false,
      'message' => 'Position Not Found',
    ], 404);
  }
  
  /**
   * destroy
   *
   * @param  mixed $id
   * @return void
   */
  public function destroy($id)
  {
    $position = UserPosition::where('user_id', $id)->first();
    if($position) {
      $position->delete();
      return response()->json([
        'success' => true,
        'message' => 'Position Deleted',
      ], 200);
    }
    return response()->json([
      'success' => false,
      'message' => 'Position Not Found',
    ], 404);
  }
}
