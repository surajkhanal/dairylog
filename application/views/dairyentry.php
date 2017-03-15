<link rel="stylesheet" href="<?php echo assets_url();?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo assets_url();?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo assets_url();?>/themes/material/easyui.css">
<link rel="stylesheet" href="<?php echo assets_url();?>/themes/icon.css">
<link rel="stylesheet" href="<?php echo assets_url();?>/css/dashboard.css">
<link rel="stylesheet" href="<?php echo assets_url();?>/nepali.datepicker.v2.1.min.css">
<div class="container">
	<div class="row">
	  <div class="col-sm-5">
	          <table id="dd" title="Farmer List" class="easyui-datagrid" style="width:80%; height:480px;"
	                 url="<?php echo base_url() ?>index.php/dashboard/get_users"
	                 toolbar="#toolbar" pagination="true"
	                 rownumbers="true" fitColumns="true" singleSelect="true" pageSize='40' pageList='[40,80,120,160,200,240,280,320,360]'>
	              <thead>
	                  <tr>
	                  	  <th field="id" width="50">Id</th>
	                      <th field="name" sortable='true' width="50">Name</th>
	                      <th field="address" sortable='true'width="50" >Address</th>
	                      <th field="phone" sortable='true' width="50">Phone</th>
	                  </tr>
	              </thead>
	          </table>
	  </div>
	  <div class="col-sm-7">
	  	<div id="p" class="easyui-panel" title="Farmer" style="width:100%;height:590px;padding:10px;">
	  		  <form id="ff" method="post" novalidate="novalidate">
	  		  		<div class="row">
	  		  		   <label for="name" class="col-sm-1">Date.</label>
                        <div class="col-sm-4">
                                <input type="text" id="date" value="" name="date" class="nepali-calendar"/>
                        </div>
                       <label for="name" class="col-sm-2">Fat.</label>
                        <div class="col-sm-2">
                                <input class="easyui-textbox" type="text" id="fat" name="fat" data-options="required:true" style="width:100%" />
                        </div>
                        <label for="name" class="col-sm-1">SNF.</label>
                        <div class="col-sm-2">
                                <input class="easyui-textbox" type="text" id="snf" name="snf" data-options="required:true" style="width:100%" />
                        </div>
                      </div>
                      <div class="row" style="margin-top:5px;">
                        <label for="name" class="col-sm-1">Ts.</label>
                        <div class="col-sm-2">
                                <input class="easyui-textbox" type="text" id="ts" name="ts" data-options="required:true" style="width:100%" />
                        </div>
                       <center><button type="submit" tab-index="5" class="btn btn-default">Save</button></center>
                       </div>

	  		  </form>
	          <table id="dg" class="easyui-datagrid" style="width:100%; height:480px;"
	                 url="<?php echo base_url() ?>index.php/dashboard/getSpecificFarmerReport"
	                 toolbar="#toolbar" pagination="true"
	                 rownumbers="true" fitColumns="true" singleSelect="true" pageSize='40' pageList='[40,80,120,160,200,240,280,320,360]'>
	              <thead>
	                  <tr>
	                      <th field="fat" sortable='true' width="50">Fat</th>
	                      <th field="snf" sortable='true'width="50" >SNF</th>
	                      <th field="ts" sortable='true' width="50">TS</th>
	                      <th field="totalprice" sortable='true' width="50">Total</th>
	                  </tr>
	              </thead>
	          </table>
	     </div>
	  </div>
	</div>
</div>
<script>
	 $(document).ready(function(){
    $('#date').nepaliDatePicker();
    });
</script>
<script>
		$(function(){
	 	var row = $('#dd').datagrid('getSelected');
	 	if(row){
	         $('#dg').datagrid('load',{
	         searchkey:row.id,
	         
	     });
	 	}

	 });
</script>