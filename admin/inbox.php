<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	$ct = new cart();
    if(isset($_GET['shiftid'])){
		$id = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $ct->shifted($id, $time, $price);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">
					<?php
						if($shifted){
							echo $shifted;
						}
					?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No .</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Customer</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$fm = new Format();
							$ct = new cart();
							$get_inbox_cart = $ct->get_inbox_cart();
							if($get_inbox_cart){
								$id = 0;
								while($result = $get_inbox_cart->fetch_assoc()){
								$id++;
						?>
						<tr class="odd gradeX">
							<td><?= $id ?></td>
							<td><?= $fm->formatDate($result['date_order']) ?></td>
							<td><?= $result['productName'] ?></td>
							<td><?= $result['quantity'] ?></td>
							<td><?= $result['price'].' '.'$' ?></td>
							<td><?= $result['customer_id'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">View Customer</a></td>
							<td>
								<?php
								 	if($result['status'] == 0){
								?>
									<a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>" >Shifted</a>
								<?php
									}else{
								?>
									<a href="shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>" >Remote</a>
								<?php
									}
								?>
							</td>
						</tr>
						<?php
							}
						}
						?>

					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
