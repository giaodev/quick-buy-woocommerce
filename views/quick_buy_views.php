<button id="myBtn"><?php printf(__('Mua ngay', 'giaovn')); ?></button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2><?php printf(__('Đặt hàng nhanh', 'giaovn')); ?></h2>
    </div>
    <div class="modal-body">
      <form action="" method="post">
        <label for="">Tên</label>
        <input type="text" class="input-text " name="name" id="name" placeholder="" value="">
        <br>
        <label for="">Địa chỉ</label>
        <input type="text" class="input-text " name="address" id="address" placeholder="Địa chỉ" value=""placeholder="Địa chỉ">
        <br>
        <label for="">Số điện thoại</label>
        <input type="tel" class="input-text " name="phone" id="phone" placeholder="" value="">
        <br>
        <label for="">Ghi chú</label>
        <textarea name="note" class="input-text " id="note" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." rows="2" cols="5"></textarea>
<button type="submit" class="button alt" name="ok" value="Đặt hàng">Đặt hàng</button>
      </form>
    </div>
  </div>

</div>