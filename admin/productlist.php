<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php' ;?>
<?php include_once '../helpers/format.php' ;?>

<?php $product = new product(); 
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delete_product = $product->delete_product($id);
	}
?>
<?php $fm = new Format(); ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
			<?php 
				if(isset($delete_product)){
					echo $delete_product;
				}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Product Images</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$show_product = $product->show_product();
					if(isset($show_product)){
						$i = 0;
						while($result = $show_product->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" style="width: 50px; height: 50px; vertical-align: middle;"/></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php echo $fm->textShorten_product($result['product_desc'], 20)  ?></td>
					<td><?php
						if($result['type'] == 1){
							echo 'Feathered';
						}else{
							echo 'None-Feathered';
						}
					
					?></td>
					
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete')" href="?delid=<?php echo $result['productId'] ?>">Delete</a></td>
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
