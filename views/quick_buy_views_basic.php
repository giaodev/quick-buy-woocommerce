<?php $g_product = wc_get_product( get_the_ID() ); ?>
<div class="<?php echo (isset($option['quick_buy_class_css'])) ? $option['quick_buy_class_css'] : '' ?>">
  <button id="myBtn"><?php printf(__($option['quick_buy_name'], 'giaovn')); ?></button>

  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <h2><?php printf(__('Đặt hàng nhanh', 'giaovn')); ?></h2>
      </div>
      <div class="modal-body" id="content_popup">
        <div class="g_col_4">
          <h3><?php the_title(); ?></h3>
          <div class="image_single_product">
            <?php
            the_post_thumbnail( 'woocommerce_thumbnail' )
            ?>
          </div>
          <?php
          if ($g_product->get_sale_price() == NULL) {
            ?>
          <p class="price"><?php echo $g_product->get_regular_price(); ?></p>
            <?php
          } else {
            ?>
          <p class="price"><?php echo $g_product->get_sale_price(); ?></p>
            <?php
          }
          ?>
        </div>
        <div class="g_col_8">
          <form action="" method="post">
            <label for=""><?php echo __('Tên'); ?></label>
            <input type="text" class="input-text " name="name" id="name" placeholder="<?php echo __('Tên'); ?>" value="">
            <br>
            <label for=""><?php echo __('Địa chỉ'); ?></label>
            <input type="text" class="input-text " name="address" id="address" value="" placeholder="<?php echo __('Địa chỉ'); ?>">
            <br>
            <label for=""><?php echo __('Số điện thoại'); ?></label>
            <input type="tel" class="input-text " name="phone" id="phone" placeholder="<?php echo __('Số điện thoại'); ?>" value="">
            <br>
            <label for=""><?php echo __('Ghi chú'); ?></label>
            <textarea name="note" class="input-text " id="note" placeholder="<?php echo __('Ghi chú về đơn hàng..'); ?>" rows="2" cols="5"></textarea>
            <button type="submit" class="button alt" name="ok" value="<?php echo __('Đặt hàng'); ?>" id="dat_hang"><?php echo __('Đặt hàng'); ?></button>
          </form>
        </div>
        <div class="clear_fix"></div>
      </div>
    </div>

  </div>

</div>

<script type="text/javascript">
  (function($){
   $(document).ready(function(){
     $('#dat_hang').click(function(){
       $.ajax({
         type: "post",
         dataType: "json",
         url: "<?php echo admin_url('admin-ajax.php'); ?>",
         data: {
           action: "request_ajax",
           id: <?php echo get_the_ID(); ?>,
           name: $("input[name='name']").val(),
           address: $("input[name='address']").val(),
           phone: $("input[name='phone']").val(),
           note: $("input[name='note']").val(),
         },
         beforeSend: function(){
         // loading..
       },
       success: function(result){
          $('#content_popup').html(result.data);
       },
       error: function(){
         console.log('Error');
       }
     });
       return false;
     });
   });   
 })(jQuery);

</script>