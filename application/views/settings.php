
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4>Set Price (for unit in Rs)</h4>
            <hr>
          <div class="alert alert-dismissible" role="alert" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>

            <form action="<?php echo base_url();?>index.php/dashboard/saveSettings" method="post" data-autosubmit>
                <div class="form-group">
                    <label for="">Fat</label>
                    <input type="hidden" name="id" value="<?php if(isset($rate)){ echo $rate->id; }?>">
                    <input type="text" class="form-control numeric-only" name="fat" value="<?php if(isset($rate)) { echo $rate->fat; }?>">
                </div>
                <div class="form-group">
                    <label for="">SNF</label>
                    <input type="text" class="form-control numeric-only" name="snf" value="<?php if(isset($rate))  echo $rate->snf; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
<script>
$(function() {
  $('form[data-autosubmit]').autosubmit();
});
  (function($) {
  $.fn.autosubmit = function() {
    this.submit(function(event) {
      event.preventDefault();
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
            $('.alert').addClass('alert-success').html('Settings saved successfully!').show();
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
 $(document).on('keyup', '.numeric-only', function(event) {
      var v = this.value;
      if($.isNumeric(v) === false) {
           //chop off the last char entered
           this.value = this.value.slice(0,-1);
      }
   });
</script>