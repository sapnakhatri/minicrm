@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ __('message.Companies') }}</h2>
            </div>
            <div class="pull-right ">
                <button type="button" class="btn btn-success" title="Add Company" data-toggle="modal" data-target="#add_company" data-caption-animate="fadeInUp" data-caption-delay="200" id="addcompany"><i class="fa fa-plus">{{ __('message.Add Company') }}</i></button>
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
            
            <th>{{ __('message.Name') }}</th>
            <th>{{ __('message.Website') }}</th>
            <th>{{ __('message.Logo') }}</th>
            <th>{{ __('message.Email') }}</th>
            <th width="280px">{{ __('message.Action') }}</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->website }}</td>
            <td><img src="{{ URL::asset('storage/logo/'.$value->logo) }}" style="width: 100px; height: 100px;"></td>
            <td>{{ $value->email }}</td>
            <td>
                
                <button type="button" class="btn btn-primary" title="Edit Company" data-toggle="modal" data-target="#edit_company_modal" data-caption-animate="fadeInUp" data-caption-delay="200" id="edit_company" Onclick="editCompany({{$value->id}})"><i class="fa fa-plus">Edit</i></button>  
                 <button class="btn btn-info deleteRecord" title="Delete Company" data-id="{{ $value->id }}" ><i class="fa fa-trash">Delete</i></button>
                    
            </td>
        </tr>
        @endforeach
    </table> 
    </div> 
    {!! $data->links() !!} 
</div>  

<!-- Add Company Modal -->
<div class="modal fade" id="add_company" tabindex="-1" role="dialog" aria-labelledby="add_company_label" aria-hidden="true">
  <div class="modal-dialog" role="document" style="height:90% !important;">
    <form role="form" class="form-horizontal" id="CompanyForm"  method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_company_label">Add Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body addcompanybody">
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Name <span class="err_display">*</span></label>
                    <div class="row col-md-7">
                      <input type="text" class="form-control" name="name" id="name" value="" placeholder=" Name" required>
                      <span id="name_err" class="error err_display"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Email</label>
                    <div class="row col-md-7">
                      <input type="email" class="form-control" name="email" required id="email" value="" placeholder="Email">
                    </div>
                </div>
               <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Website </label>
                    <div class="row col-md-7">
                      <input type="text" class="form-control" name="website" id="website" placeholder="Website">
                    </div>
                </div>
                
                 <div class="form-group row">
                    <label for="" class="col-form-label col-md-4">Logo</label>
                    <div class="row col-md-7">
                      <input type="file" name="logo" id="logo" class="form-control">
                      <span id="logo_err" class="error err_display"></span>
                    </div>
                </div>
        </div>
                       

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="savecompany">Submit</button>
      </div>
      
    </div>
    </form>
  </div>
</div>

<!-- Edit Company Modal Start-->
<div class="modal fade" id="edit_company_modal" tabindex="-1" role="dialog" aria-labelledby="edit_company_Label" aria-hidden="true">
  <div class="modal-dialog model_content_lead " role="document" style="height:90% !important;">
    @include('companies.edit_companies')
  </div>
</div>
<!-- Edit Company Modal Close-->


@endsection