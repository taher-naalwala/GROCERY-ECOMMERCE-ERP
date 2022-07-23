<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(isset($_GET['ref']))
{
	$_SESSION['ref']=$_GET['ref'];
}
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case "add":
			if (!empty($_POST["quantity"])) {
				$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
				$itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));

				if (!empty($_SESSION["cart_item"])) {
					if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
						foreach ($_SESSION["cart_item"] as $k => $v) {
							if ($productByCode[0]["code"] == $k) {
								if (empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			break;
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
	}
}
?>
<HTML>

<HEAD>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<TITLE>Ashara Mubarak 1442H</TITLE>
	<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
	<div id="shopping-cart">
		<div class="txt-heading">Shopping Cart</div>
		<br>

		<div class="form-group">
			<form method="post" action="search.php" id="searchform">
				<input type="text" placeholder="Search for your item" class="form-control" name="search_name">
		</div>
		<button type="submit" class="btn btn-primary" name="search" value="search">Search</button>
		</form>






		<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
		<?php
		if (isset($_SESSION["cart_item"])) {
			$total_quantity = 0;
			$total_price = 0;
		?>
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th style="text-align:left;">Name</th>
						<th style="text-align:left;">Code</th>
						<th style="text-align:right;" width="5%">Quantity</th>
						<th style="text-align:right;" width="10%">Unit Price</th>
						<th style="text-align:right;" width="10%">Price</th>
						<th style="text-align:center;" width="5%">Remove</th>
					</tr>
					<?php
					foreach ($_SESSION["cart_item"] as $item) {
						$item_price = $item["quantity"] * $item["price"];
					?>

						<tr>
							<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
							<td><?php echo $item["code"]; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td style="text-align:right;"><?php echo "Rs. " . $item["price"]; ?></td>
							<td style="text-align:right;"><?php echo "Rs. " . number_format($item_price, 2); ?></td>
							<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
						</tr>
					<?php
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"] * $item["quantity"]);
						$total = $total_price + 50;
					}
					?>

					<tr>
						<td colspan="2" align="right">Total (incl. taxes):</td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2"><strong><?php echo "Rs. " . $total ?></strong></td>
						<td></td>

					</tr>

				</tbody>

			</table>
			<br>
			<form method="POST">
				<button style="width:100%" name="place_order" class="btn btn-primary btn-lg btn-block" value="Place Order">Go to CheckOut Page</button>
			</form>
		<?php
		} else {
		?>
			<div class="no-records">Your Cart is Empty</div>
		<?php
		}
		?>
	</div>

	<?php

	if (isset($_POST['place_order'])) {
		header('Location: delievery_details.php');
	}

	?>

	<div id="product-grid">
		<div class="txt-heading">Products</div>
		<div class="row">
			<?php
			$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
			if (!empty($product_array)) {
				foreach ($product_array as $key => $value) {
			?>

					<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
						<div class="col-lg-6">
							<div class="card" style="width: 26rem;">
								<img class="card-img-top" src="<?php echo $product_array[$key]["image"]; ?>" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title"><?php echo $product_array[$key]["name"]; ?></h5>
									<p class="card-text"><?php echo "Rs." . $product_array[$key]["price"]; ?></p>
									<input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" />
								</div>
							</div>
						</div>
					</form>
	

<?php
				}
			}
?>
	</div>
	</div>
</BODY>

</HTML>