<div class="container">
  <div class="row">
  
   <table id="dg" class="easyui-datagrid" style="width:100%; height:480px;"
                               url="<?php echo base_url() ?>index.php/dashboard/getReportDatewise"
                               toolbar="#toolbar" pagination="true"
                               rownumbers="true" fitColumns="true" singleSelect="true" pageSize='15' pageList='[15,30,45,60,75,90,105,120,135,150]'>
                            <thead>
                                <tr>
                                    <th field="date" sortable='true' width="50">Date</th>
                                    <th field="fat" sortable='true'width="50" >Fat</th>
                                    <th field="snf" sortable='true'width="50" >SNF</th>
                                    <th field="ts" sortable='true' width="50">TS</th>
                                    <th field="totalprice" sortable='true' width="50">Total</th>
                                </tr>
                            </thead>
     </table>
     <div id="toolbar">
        <input type="text" name="date" id="date" value="" class="nepalicalender">
        <input type="text" name="nepdate" id="nepdate" value="" class="nepalicalender">
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
     </div>
  </div>
</div>

<script>
  $(document).ready(function(){
  $('#date').nepaliDatePicker();
  $('#nepdate').nepaliDatePicker();
  });
  function searchData(){
    var fromdate = $('#date').val();
    var todate = $('#nepdate').val();
    var user_id= $('#name').combogrid('getValue');
    console.log(fromdate+' '+todate+' '+user_id);
    $('#dg').datagrid('load',{
        fromDate:fromdate,
        toDate:todate,
          userid:user_id
    }); 
  }
</script>