<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Company::latest()->paginate(5);
    
        return view('companies.index',compact('data'));
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
            'name' => 'required',
            'email' => 'required|email',
            'logo' => 'mimes:jpg,jpeg,png|dimensions:min_width=100,min_height=100'
        );

        $validator = Validator::make($data, $rules);
       
        if ($validator->passes()) {

            $companyObj = new Company;
            $companyObj->name= $request['name'];
            $companyObj->email= $request['email'];
            $companyObj->website= $request['website'];
            if($request->file('logo')) {

               $directory = storage_path().'/app/public/logo/';
               $file = $request->file('logo');
               $name = time().'.'.$file->getClientOriginalName();

               $file->move($directory, $name);
               $companyObj->logo= $name;
            }
            $companyObj->save();

            $result['response'] = 'success';
            $result['message'] = 'Company Added successfully';

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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $json_array['error'] = 'error';
        $companyData = Company::where('id', $request['id'])->first();
        if($companyData){
             $json_array['error'] = 'success';
            return View('companies.edit_companies', ['companyData' => $companyData]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $result=array();
        $data = $request->all();  
        $rules = array(
            'name' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|dimensions:min_width=100,min_height=100'
        );
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {

            $companyObj = Company::find($request['companyid']);
            $companyObj->name= $request['name'];
            $companyObj->email= $request['email'];
            $companyObj->website= $request['website'];
            if($request->file('logo')) {

               $directory = storage_path() . '/app/public/logo/';
               if($companyObj->logo != ''  && $companyObj->logo != null){
                   $file_old = $directory.$companyObj->logo;

                   unlink($file_old);
              }

               $file = $request->file('logo');
               $name = time().'-'.$file->getClientOriginalName();

               $file->move($directory, $name);
               $companyObj->logo= $name;
            }
            $companyObj->update();

            $result['response'] = 'success';
            $result['message'] = 'Company Updated successfully!';

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
         $deleteData = Company::find($id)->delete($id);
         $relationData = Employee::where('company',$id)->delete();
         if($deleteData || ($deleteData && $relationData)){
            $result['response'] = 'success';
         }
        
        return response()->json($result);
    }
}
