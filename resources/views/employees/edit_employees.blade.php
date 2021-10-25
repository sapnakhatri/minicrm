<form role="form" class="form-horizontal" id="EditEmployeeForm"  method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_customer_Label">Edit Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      
        <div class="modal-body editcustomerbody">
          <input type="hidden" class="form-control col-md-6 hidden_employee_id" name="employeeid" id="employeeid"  value="{{@$employeeData->id}}">
                
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">First Name <span class="err_display">*</span></label>
                    <div class="row col-md-7">
                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{@$employeeData->first_name}}" placeholder="First Name" required>
                        <span id="first_name_err" class="error err_display"></span>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Last Name <span class="err_display">*</span></label>
                    <div class="row col-md-7">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{@$employeeData->last_name}}" placeholder="Last Name" required>
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
                                        $selected = (isset($employeeData->company) && ($employeeData->company == $v->id) ? 'Selected' : '' )
                                        ?>
                                        <option value="{{$v->id}}" {{$selected}}>{{$v->name}}</option>;
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
                        <input type="email" class="form-control textlowercase EmailIds" name="email" id="email" value="{{@$employeeData->email}}" placeholder="Email">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Phone</label>
                    <div class="row col-md-7">
                        <input type="number" class="form-control" name="phone" id="phone" value="{{@$employeeData->phone}}" placeholder="Phone">
                    </div>
                </div>
                
        </div>
                       

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="edit_employee_save" onclick="editEmp();">Submit</button>
        </div>
      
    </div>
</form>
