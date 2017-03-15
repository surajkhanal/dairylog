<div class="container">
    <div class="row">
        <div class="col-md-4">
           <div class="easyui-panel" title="कृषक विवरण" style="width:100%;max-width:400px;padding:30px 60px;">
        <form id="ff" method="post">
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="name" style="width:100%" data-options="label:'कृषकको नाम:',required:true">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-textbox" name="address" style="width:100%" data-options="label:'ठेगाना:'">
            </div>
            <div style="margin-bottom:20px">
                <input class="easyui-numberbox" name="phone" style="width:100%" data-options="label:'फोन नं:',required:false,validType:'number'">
            </div>
        </form>
        <div style="text-align:center;padding:5px 0">
            <a href="javascript:void(0)" id="savebtn" class="easyui-linkbutton" onclick="saveUser()" style="width:80px">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
        </div>
    </div>
        
        </div>
        <div class="col-md-8">
            <table id="dg" title="Farmers" class="easyui-datagrid" style="width:700px;height:450px"
            url="get_users"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="id" width="50">कृषक नं</th>
                        <th field="name" width="50">कृषकको नाम</th>
                        <th field="address" width="50">ठेगाना</th>
                        <th field="phone" width="50">फोन नं</th>
                    </tr>
                </thead>
            </table>
            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">नयाँ कृषक</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">सच्याउनुहोस्</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">हटाउनुहोस्</a>
                <input class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:doSearch" style="width:30%">
            </div>
      </div>
    </div>
</div>
<script type="text/javascript">
        function doSearch(value){
            alert('You input: ' + value);
        }
        function submitForm(){
            $('#ff').form('submit');
        }
        function clearForm(){
            $('#savebtn').css('padding','5px').html('Save');
            $('#ff').form('clear');
        }
    </script>
    <script type="text/javascript">
        var url = 'register_user';
        function newUser(){
            $('#savebtn').css('padding','5px').html('Save');
            $('#ff').form('clear');
            url = 'register_user';
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#ff').form('load',row);
                url = 'update_user?id='+row.id;
            }
            $('#savebtn').css('padding','5px').html('Update');
        }
        function saveUser(){
            $('#ff').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                   // var result = eval('('+result+')');
                    if (result.errorMsg){
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $("#ff").form('clear');
                        $('#dg').datagrid('reload');    // reload the user data
                    }
                }
            });
        }
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                    if (r){
                        $.post('delete_user',{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                    }
                });
            }
        }
    </script>
      