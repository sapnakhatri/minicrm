<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::latest()->paginate(5);
    
        return view('employees.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $result=array();
        $data = $request->all();  
       
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
        );

        $validator = Validator::make($data, $rules);
       
        if ($validator->passes()) {

            $employeeObj = new Employee;
            $employeeObj->first_name= $request['first_name'];
            $employeeObj->last_name= $request['last_name'];
            $employeeObj->company= $request['company'];
            $employeeObj->email= $request['email'];
            $employeeObj->phone= $request['phone'];
            $employeeObj->save();

            $result['response'] = 'success';
            $result['message'] = 'Employee Added successfully';

        }else{   
            $result['response'] = 'fail';
            $error = $validator->errors()->all();
            $messaage = $validator->messages();
            foreach ($rules as $key => $value) {
                $feild_error[$key . '_err'] = $messaage->first($key);
            }
            $result['message'] = $feild_error;  
        }

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $json_array['error'] = 'error';
        $employeeData = Employee::where('id', $request['id'])->first();
        if($employeeData){
             $json_array['error'] = 'success';
            return View('employees.edit_employees', ['employeeData' => $employeeData]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $result=array();
        $data = $request->all();  
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {

            $employeeObj = Employee::find($request['employeeid']);
            $employeeObj->first_name= $request['first_name'];
            $employeeObj->last_name= $request['last_name'];
            $employeeObj->company= $request['company'];
            $employeeObj->email= $request['email'];
            $employeeObj->phone= $request['phone'];
            $employeeObj->update();

            $result['response'] = 'success';
            $result['message'] = 'Employee Updated successfully!';

        }else{   
            $result['response'] = 'fail';
            $result['error'] = $validator->errors()->all();
            $messaage = $validator->messages();
            foreach ($rules as $key => $value) {
                $feild_error[$key . '_err'] = $messaage->first($key);
            }
            $result['message'] = $feild_error;  
        }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result['response'] = 'error';
         $deleteData = Employee::find($id)->delete($id);
         if($deleteData){
            $result['response'] = 'success';
         }
        
        return response()->json($result);
    }
}
