<style type="text/css">
    label{
    	margin-top: 5px;
    	margin-bottom: 5px;
    }
	span{
		margin-top: 5px;
		margin-bottom: 5px;
	}
</style>
<div class="container">
	<div class="row">
	  <div class="col-sm-5">
	    <div id="p" class="easyui-panel" title="Payment Form">
			<form id="ff" method="post">
				<label class="col-sm-2">Name:</label>
				<span class="col-sm-10"><input class="easyui-textbox" name="fname" id="fname" data-options="required:true" ></span>
				<label class="col-sm-2">Amount:</label>
				<span class="col-sm-10"><input class="easyui-textbox" name="paymentamount" id="paymentamount" data-options="required:true"></span>
				<center style="amargin-top:10px;">
					<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="save" onclick="saveUser()" style="width:90px; height: 30px;">Save</a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm"  onclick="clearForm()" style="width:90px;height: 30px;">Cancel</a>
				</center>
			</form>
		</div>
	  </div>
	  <div class="7">
	   <table id="dg" class="easyui-datagrid" style=" height:480px;"
                               url="<?php echo base_url() ?>index.php/dashboard/paymentreport"
                               toolbar="#toolbar" pagination="true"
                               rownumbers="true" fitColumns="true" singleSelect="true" pageSize='15' pageList='[15,30,45,60,75,90,105,120,135,150]'>
                            <thead>
                                <tr>
                                    <th field="user_id" sortable='true'width="50" >Id</th>
                                    <th field="fname" sortable='true' width="50">Farmer Name</th>
                                    <th field="balance" sortable='true'width="50" >Balance</th>
                                </tr>
                            </thead>
     </table>
            <div id="toolbar">
		        <select id="name" class="easyui-combogrid" name="name" data-options="
		              panelWidth:200,
		               idField:'id',
		               textField:'name',
		               valueField:'id',
		               url:'<?php echo base_url() ?>index.php/dashboard/get_users', 
		               required:'true',
		               columns:[[
		                         {field:'id',title:'Id',width:100},
		                         {field:'name',title:'Name',width:100}
		                       ]]
		               " style="width:160px;"> </select>
        			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search"  onclick="searchData()" style="height: 30px;"></a>
        			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit"  onclick="loadData()" style="height: 30px;"></a>
    	    </div>
	  </div>
	</div>
</div>
  <script src="<?php echo assets_url();?>/js/jquery.min.js"></script>
   <script src="<?php echo assets_url();?>/nepali.datepicker.js"></script>
    <script src="<?php echo assets_url();?>/js/bootstrap.min.js"></script>
    <script src="<?php echo assets_url();?>/js/jquery.easyui.min.js"></script>
    <script src="<?php echo assets_url();?>/js/jquery.validate.min.js"></script>

<script>
  $(document).ready(function(){
  $('#date').nepaliDatePicker();
  $('#nepdate').nepaliDatePicker();
  });
  function searchData(){
    var user_id= $('#name').combogrid('getValue');
    console.log(user_id);
    $('#dg').datagrid('load',{
          userid:user_id
    }); 
  }
  function loadData(){
       var row = $('#dg').datagrid('getSelected');
        if(row){
        	  $('#ff').form('load',row);
        	  url = 'ledgerPayment?id='+row.id;
	     }

  }
  function saveUser(){
            $('#ff').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                   var result = eval('('+result+')');
                    if (result.errorMsg){
                       $.messager.show({
                                   width:300,
                                   height:100,
                                   title:'Error',
                                   msg:'Inernal Server Error!!',
                                   timeout:2000,
                                   showType:'slide',
                                   style:{
                                       center:''
                                   }
                               });
                    } else {
                    	$.messager.show({
                                   width:300,
                                   height:100,
                                   title:'Success',
                                   msg:'Successfully Saved!!',
                                   timeout:2000,
                                   showType:'slide',
                                   style:{
                                       center:''
                                   }
                               });
                        $("#ff").form('clear');
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
</script>