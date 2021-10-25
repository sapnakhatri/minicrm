<form role="form" class="form-horizontal" id="EditCompanyForm"  method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_customer_Label">Edit Company</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      
        <div class="modal-body editcustomerbody">
          <input type="hidden" class="form-control col-md-6 hidden_company_id" name="companyid" id="companyid"  value="{{@$companyData->id}}">
                
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Name <span class="err_display">*</span></label>
                    <div class="row col-md-7">
                        <input type="text" class="form-control" name="name" id="name" value="{{@$companyData->name}}" placeholder="Name" required>
                        <span id="name_err" class="error err_display"></span>
                    </div>
                </div>
                
               <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Email</label>
                    <div class="row col-md-7">
                        <input type="email" class="form-control textlowercase EmailIds" required name="email" id="email" value="{{@$companyData->email}}" placeholder="Email">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Website</label>
                    <div class="row col-md-7">
                        <input type="text" class="form-control" name="website" id="website" value="{{@$companyData->website}}" placeholder="Website">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Logo<span class="err_display">*</span></label>
                    <div class="row col-md-7">
                        <input type="file" name="logo" id="logo" class="form-control">
                         @if(isset($companyData->logo) && $companyData->logo != '')
                        <a href="{{url('/')}}/storage/app/public/logo/{{isset($companyData->logo) ? $companyData->logo : ''}}" target="_blank">{{isset($companyData->logo) ? $companyData->logo : ''}}</a>
                                 @endif
                        <span id="logo_err" class="error err_display"></span>
                    </div>
                </div>
        </div>
                       

        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="edit_company_save" onclick="editComp();">Submit</button>
        </div>
      
    </div>
</form>
