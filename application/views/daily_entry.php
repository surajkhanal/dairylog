<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
         <?php
              
                if(!empty($user_list) && $user_list!=='noUser'){?>
            <table class="table table-hover" id="farmers">
                <thead>
                   <th>कृषक नं</th>
                   <th>कृषकको नाम</th>
                   <th>फोन नं</th>
                </thead>
                <tbody>
               <?php 
                foreach ($user_list as $value) {?>
                    <tr class="flist" data-id="<?php echo $value->id;?>">
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->phone; ?></td>
                    </tr>
                <?php } ?>
              
                </tbody>
            </table>
            <?php }else{?>
                  <h3>No Farmer exist</h3>
                  <a href="<?php echo base_url();?>/index.php/dashboard/register">Register user</a>
              <?php }
              ?>
        </div>
        <div class="col-md-9">
        <div class="farmer-detail">
            <div class="f-id">कृषक नं : <span id="farmer_id"></span></div>
             <div class="f-name">कृषकको नाम : <span id="farmer_name"></span><span class="message"></span></div>
             
        </div>
            <form id="#ff" class="form-inline" action="<?php echo base_url();?>index.php/dashboard/insertRecord" method="post" data-autosubmit>
             <div class="form-group">
                <input type="text" tab-index="1" class="form-control numeric-only" id="date" name="date" placeholder="मिती" required>
              </div>

              <div class="form-group">
                <select name="milk_type" id="milk_type" class="form-control">
                  <option value="whole"></option>
                  <option value="मिश्रीत" selected="selected">मिश्रीत</option>
                </select>
              </div>
              
              <div class="form-group">
                <input type="text" tab-index="1" class="form-control numeric-only" id="quantity" name="quantity" placeholder="परिमाण (लि.)" required>
              </div>

              <div class="form-group">
                <input type="hidden" name="fid" id="fid">
                <input type="text" tab-index="2" class="form-control numeric-only" id="fat" name="fat" placeholder="फ्याट (%)" required>
              </div>

              <div class="form-group">
                <input type="text" tab-index="3" class="form-control numeric-only" id="snf" name="snf" placeholder="एस.एन.एफ (%)" required>
              </div>

               <div class="form-group">
                <input type="text" tab-index="4" class="form-control numeric-only" id="ts" name="ts" placeholder="थप कमिशन" >
              </div>
              <button type="submit" tab-index="5" class="btn btn-default">Save</button>
            </form>

            <table id="dg" class="easyui-datagrid" style="width:100%; height:480px;"
                               url="<?php echo base_url() ?>index.php/dashboard/getSpecificFarmerReport"
                               toolbar="#toolbar" pagination="true"
                               rownumbers="true" fitColumns="true" singleSelect="true" pageSize='40' pageList='[40,80,120,160,200,240,280,320,360]'>
                            <thead>
                                <tr>
                                    <th field="date" sortable='false' width="50">मिती</th>
                                    <th field="milktype" sortable='false' width="50">प्रकार</th>
                                    <th field="quantity" sortable='true' width="50">परिमाण</th>
                                    <th field="fat" sortable='true' width="50">फ्याट</th>
                                    <th field="snf" sortable='true' width="50" >एस.एन.एफ</th>
                                    <th field="raw_price" sortable='true' width="50">मुल्य रु</th>
                                    <th field="ts" sortable='true' width="50">थप कमिशन</th>
                                    <th field="price_with_ts" sortable='true' width="50">प्रति लि. रु</th>
                                    <th field="totalprice" sortable='true' width="50">जम्मा रु</th>
                                </tr>
                            </thead>
             </table>
           
        </div>
    </div>
</div>
<script>
$('.flist').click(function(){
    var t = $(this);
    var fid = $(this).data('id');
    var fname = $(t).find('td:nth-child(2)').text();
    window.localStorage.setItem('fid',fid);
    search();
      console.log(fname);
    $("#farmer_id").html(fid);
    $("#farmer_name").html(fname);
    $("#fid").val(fid);
})
function search(){
   var fid=window.localStorage.getItem('fid');
    $('#dg').datagrid('load',{
        searchkey:fid
        
    }); 
  }
$(function() {
  $('form[data-autosubmit]').autosubmit();
});
  (function($) {
  $.fn.autosubmit = function() {
    this.submit(function(event) {
      event.preventDefault();
      if($('#fid').val()=='') {

        $.messager.show({
            width:300,
            height:100,
            title:'Error',
            msg:'Please choose a farmer from list',
            timeout:2000,
            showType:'slide',
            style:{
                center:''
            }
        });
        return;}
      var form = $(this);
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        dataType:'json'
      }).done(function(data) {
        console.log(data);
        // Optionally alert the user of success here...
        if(data.successMsg == 'success'){
            console.log('dada');
            $('#ff').form('clear');
            $('.message').html('<p>saved successfully!</p>');
            setTimeout(function(){
                $('.message').hide();
            },4000);
            $('#dg').datagrid('reload');
        }else{
             $('.alert').addClass('alert-error').html('Error while saving settings').show();
        }
      }).fail(function(data) {
        // Optionally alert the user of an error here...
       alert('error');
      });
    });
    return this;
  }
})(jQuery)

  $(document).ready(function(){
  
    $('#date').nepaliDatePicker();
    });

   $(document).on('keyup', '.numeric-only', function(event) {
      var v = this.value;
      if($.isNumeric(v) === false) {
           //chop off the last char entered
           this.value = this.value.slice(0,-1);
      }
   });
      $(document).on('keyup', '#snf', function(){
        var fat = $('#fat').val();
        console.log(fat);
        var snf = $('#snf').val();
        var total = fat*snf;
        console.log(total);
        $('.total').text(total);
       })
    </script>