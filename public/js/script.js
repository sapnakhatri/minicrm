var APP_URL = window.location.origin;

function editCompany(companyid){

   $.ajax({
        type: "GET",
        url: APP_URL + "/companies/"+companyid+"/edit",
        dataType: "html",
        data: {
            id: companyid
        },
        success: function (message) {
            $(".model_content_lead").html('');
            $(".model_content_lead").html(message);
        }
    });
}

function editEmployee(employeeid){

   $.ajax({
        type: "GET",
        url: APP_URL + "/employees/"+employeeid+"/edit",
        dataType: "html",
        data: {
            id: employeeid
        },
        success: function (message) {
            $(".model_content_lead").html('');
            $(".model_content_lead").html(message);
        }
    });
}

function editComp(){ 
    var companyid = $("#companyid").val();
        var form_data = new FormData(jQuery('#EditCompanyForm')[0]);
        $.ajax({
            type: "POST",
            url: APP_URL + "/companies/"+companyid,
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                console.log(msg);
                var data = eval(msg);
                if (data.response == 'success') {
                    alert('Successfull');
                    window.location.href = '/companies';
                } else {
                    $.each(data.message, function (index, value) {
                        var input_name = (index.split("_"));
                        $("#" + index).html(value);
                    });
                }
            }
        });
}

function editEmp(){ 
    var employeeid = $("#employeeid").val();
        var form_data = new FormData(jQuery('#EditEmployeeForm')[0]);
        $.ajax({
            type: "POST",
            url: APP_URL + "/employees/"+employeeid,
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                console.log(msg);
                var data = eval(msg);
                if (data.response == 'success') {
                    alert('Successfull');
                    window.location.href = '/employees';
                } else {
                    $.each(data.message, function (index, value) {
                        var input_name = (index.split("_"));
                        $("#" + index).html(value);
                    });
                }
            }
        });
}

$(document).ready(function () {  
  
    //Add Company Start
    $('#savecompany').click(function(e){
        e.preventDefault();
         var form_data = new FormData(jQuery('#CompanyForm')[0]);
        $.ajax({
            type: "POST",
            url: APP_URL + "/companies",
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                console.log(msg);
                var data = eval(msg);
                if (data.response == 'success') {
                    alert('Successfull');
                    window.location.href = '/companies';
                } else {
                    $.each(data.message, function (index, value) {
                        var input_name = (index.split("_"));
                        $("#" + index).html(value);
                    });
                }
            }
        });
    });
    //Add Company Close
   
    //Add Employee Start
    $('#saveemployee').click(function(e){
        e.preventDefault();
         var form_data = new FormData(jQuery('#EmployeeForm')[0]);
        $.ajax({
            type: "POST",
            url: APP_URL + "/employees",
            dataType: "json",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                console.log(msg);
                var data = eval(msg);
                if (data.response == 'success') {
                    alert('Successfull');
                    window.location.href = '/employees';
                } else {
                    $.each(data.message, function (index, value) {
                        var input_name = (index.split("_"));
                        $("#" + index).html(value);
                    });
                }
            }
        });
    });
    //Add Employee Close
   
    //Delete Company Start
    $(".deleteRecord").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
       
        $.ajax(
        {
            url: APP_URL + "/companies/"+id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (msg){
                console.log(msg);
                var data = eval(msg);
                if (data.response == 'success') {
                    alert('Company Successfully Deleted..!!');
                    window.location.href = '/companies';
                } 
            }
        });
       
    });
    //Delete Company Close
    
    //Delete Employee Start
    $(".deleteEmployeeRecord").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
       
        $.ajax(
        {
            url: APP_URL + "/employees/"+id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function (msg){
                console.log(msg);
                var data = eval(msg);
                if (data.response == 'success') {
                    alert('Employee Successfully Deleted..!!');
                    window.location.href = '/employees';
                } 
            }
        });
       
    });
    //Delete Employee Close
});