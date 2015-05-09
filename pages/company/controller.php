<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$company=new company($_GET['id']);
		if (!$company->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}
	
	$s=$company->seats[0];
	$geolocation=json_decode($s->geolocation);
	$is_contracted=$company->is_contracted;

	if ($user!=null && $company->is_assigned_to_admin($user)) {
		if (isset($_POST['for']) && isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['for']) {
				case 'company':
					switch ($_POST['name']) {
						case 'name': $company->name=$_POST['value']; break;
						case 'slogan': $company->slogan=$_POST['value']; break;
						case 'description': $company->description=$_POST['value']; break;
					}
					break;
				case 'seat':
					$seat = new company_seat($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $seat->name=$_POST['value']; break;
						case 'address': $seat->address=$_POST['value']; break;
						case 'tel': $seat->tel=$_POST['value']; break;
						case 'mobile': $seat->mobile=$_POST['value']; break;
						case 'email': $seat->email=$_POST['value']; break;
					}
					break;
				case 'product':
					$product = new product($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $product->name=$_POST['value']; break;
						case 'description': $product->description=$_POST['value']; break;
						case 'price': $product->tel=$_POST['value']; break;
					}
					break;
				case 'service':
					$service = new service($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $service->name=$_POST['value']; break;
						case 'description': $service->description=$_POST['value']; break;
						case 'price': $service->tel=$_POST['value']; break;
					}
					break;
			}
			die();
		}elseif (isset($_POST['service_name']) && isset($_POST['service_description']) && isset($_POST['service_price'])) {
			
			$service=service::create($company);
			
			$service->name=$_POST['service_name'];
			$service->description=$_POST['service_description'];
			$service->price=$_POST['service_price'];
			
			die(json_encode(array("status"=>"success", "id"=>$service->id)));

		}elseif (isset($_POST['product_name']) && isset($_POST['product_description']) && isset($_POST['product_price'])) {

			$product=product::create($company);
			
			$product->name=$_POST['product_name'];
			$product->description=$_POST['product_description'];
			$product->price=$_POST['product_price'];
			
			die(json_encode(array("status"=>"success", "id"=>$product->id)));

		}elseif (isset($_POST['delete_service'])) {
			
			$service=new service($_POST['delete_service']);
			$service->delete();
			
			die(json_encode(array("status"=>"success")));

		}elseif (isset($_POST['delete_product'])) {
			
			$product=new produit($_POST['delete_product']);
			$product->delete();
			
			die(json_encode(array("status"=>"success")));

		}
		include "view_2.php";
	}elseif($is_contracted){
		include "view_1.php";
	}else{
		include __DIR__."/../404/controller.php";goto skip_this_page;
	}
			
	skip_this_page:
?>
