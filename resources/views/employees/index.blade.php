@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('message.Employees') }}</h2>
            </div>
            <div class="pull-right ">
                <button type="button" class="btn btn-success" title="Add Employee" data-toggle="modal" data-target="#add_employee" data-caption-animate="fadeInUp" data-caption-delay="200" id="addemployee"><i class="fa fa-plus">{{ __('message.Add Employee') }}</i></button>
            </div>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            
            <th>{{ __('message.First Name') }}</th>
            <th>{{ __('message.Last Name') }}</th>
            <th>{{ __('message.Company') }}</th>
            <th>{{ __('message.Email') }}</th>
            <th>{{ __('message.Phone') }}</th>
            <th width="280px">{{ __('message.Action') }}</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $value->first_name }}</td>
            <td>{{ $value->last_name }}</td>
            <?php $company = DB::table('companies')->select('name')->where('id', @$value->company)->first();  ?>
            <td>{{ @$company->name }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->phone }}</td>
            <td>
                <button type="button" class="btn btn-primary" title="Edit Employee" data-toggle="modal" data-target="#edit_employee_modal" data-caption-animate="fadeInUp" data-caption-delay="200" id="edit_employee" Onclick="editEmployee({{$value->id}})"><i class="fa fa-plus">Edit</i></button>  
                 <button class="btn btn-info deleteEmployeeRecord" title="Delete Employee" data-id="{{ $value->id }}" ><i class="fa fa-trash">Delete</i></button>
            </td>
        </tr>
        @endforeach
    </table> 
    </div> 
    {!! $data->links() !!} 
</div>  

<!-- Add Employee Modal -->
<div class="modal fade" id="add_employee" tabindex="-1" role="dialog" aria-labelledby="add_employee_label" aria-hidden="true">
  <div class="modal-dialog" role="document" style="height:90% !important;">
    <form role="form" class="form-horizontal" id="EmployeeForm"  method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_employee_label">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body addemployeebody">
                 <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">First Name <span class="err_display">*</span></label>
                    <div class="row col-md-7">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="First Name" required>
                        <span id="first_name_err" class="error err_display"></span>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Last Name <span class="err_display">*</span></label>
                    <div class="row col-md-7">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Last Name" required>
                        <span id="last_name_err" class="error err_display"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Company</label>
                    <div class="row col-md-7">
                        <select class="form-control" name="company" id="company">
                            <?php
                            $selected = '';
                            if ($company = App\Models\Company::orderBy('name', 'ASC')->get()) {
                                    foreach ($company as $k => $v) {
                                        ?>
                                        <option value="{{$v->id}}">{{$v->name}}</option>;
                                        <?php
                                    }
                            }
                            ?>
                        </select>
                    </div>
                </div>
               <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Email</label>
                    <div class="row col-md-7">
                        <input type="email" class="form-control textlowercase EmailIds" name="email" id="email" value="" placeholder="Email">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Phone</label>
                    <div class="row col-md-7">
                        <input type="number" class="form-control" name="phone" id="phone" value="" placeholder="Phone">
                    </div>
                </div>
        </div>
                       

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveemployee">Submit</button>
      </div>
      
    </div>
    </form>
  </div>
</div>

<!-- Edit Employee Modal Start-->
<div class="modal fade" id="edit_employee_modal" tabindex="-1" role="dialog" aria-labelledby="edit_employee_Label" aria-hidden="true">
  <div class="modal-dialog model_content_lead " role="document" style="height:90% !important;">
    @include('employees.edit_employees')
  </div>
</div>
<!-- Edit Employee Modal Close-->


@endsection