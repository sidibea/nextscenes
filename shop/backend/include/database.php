<?php
session_start();
error_reporting(error_reporting() & ~E_NOTICE);
class MySQLiDatabase{
	public $link;
	public $lastquery;
	function __construct(){
		$this->open_connection();
	}
	public function open_connection(){
		$this->link = mysqli_connect("og21315-001.privatesql","nextscendidb","Sidere852","nextscendidb",35357);
		if(mysqli_connect_errno()){
			echo "Failed To Connect To Mysql Server: ".mysqli_connect_errno();
		}else{
			mysqli_select_db($this->link,"nextscendidb") or die ("no database"); 
		}
		date_default_timezone_set("Africa/Lagos");
	}
	public function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		$str = mysqli_real_escape_string($this->link,$str);
		return $str;
	}
	public function fuckpbnl($string){
		$string = strtolower($string);
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	public function query($sql){
		$this->lastquery = $sql;
		$query = mysqli_query($this->link, $sql);
		$this->confirm_query($query);
		return $query;
	}
	public function fetch_array($result){
		return mysqli_fetch_array($result);
	}
	public function num_rows($query){
		return mysqli_num_rows($query);
	}
	public function last_id(){
		return mysqli_insert_id($this->link);
	}
	public function affected_rows(){
		return mysqli_affected_rows($this->link);
	}
	public function confirm_query($result){
		if(!$result){
			/*$output = "Datase Query Failed! ".mysqli_error($this->link)."<br>";
			$output .= "Last SQL Query: ".$this->lastquery;
			die($output);*/
			return $result = false;
		}
	}
	public function authenticateUser(){
		if(!isset($_SESSION['isUser'])){
			header("location: login");
			exit;
		}
	}
	public function authenticateLogin(){
		if(isset($_SESSION['isUser'])){
			header("location: ./");
			exit;
		}
	}
	public function action(){
		return $this->clean($_REQUEST['action']);
	}
	public function dlink(){
		return "http://www.nextscenes.com/shop/backend";
	}
	public function flink(){
		return "http://www.nextscenes.com/shop";
	}
	public function firstImage($string){
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $string, $image);
		if(empty($image['src'])){
			return "img/no-photo.jpg";
		}else{
			return $image['src'];
		}
	}
	public function required(){
		if($_SESSION['required'] == true){
		echo "<div class=\"alert alert-warning\">*All Fields Are Required</div>";
		$_SESSION['required'] = false;
		}
	}
	public function incorrectcombination(){
		if($_SESSION['incorrectcombination'] == true){
		echo "<div class=\"alert alert-warning\">Incorrect Combination</div>";
		$_SESSION['incorrectcombination'] = false;
		}
	}
	public function registrationfailed(){
		if($_SESSION['registrationfailed'] == true){
		echo "<div class=\"alert alert-warning\">Registration Failed</div>";
		$_SESSION['registrationfailed'] = false;
		}
	}
	public function success(){
		if($_SESSION['s'] == true){
			echo "<div class=\"alert alert-success\">Operation Successful</div>";
		}
		$_SESSION['s'] = false;
	}
	public function failed(){
		if($_SESSION['f'] == true){
			echo "<div class=\"alert alert-danger\">Operation Failed</div>";
		}
		$_SESSION['f'] = false;
	}
	public function cond(){
		$cond = $_REQUEST['slug'];
		return $cond;
	}
	public function login($email, $password){
		$query = $this->query("SELECT * FROM login WHERE email=\"$email\" && password=\"$password\"");
		if($this->num_rows($query)>0){
			$_SESSION['isUser'] = true;
			$_SESSION['email'] = $email;
			header("location: ./");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Incorrect Username & Password Combination</div>";
			header("location: login");
			exit;
		}
	}
	public function showNotification(){
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	public function title($title){
		return $title;
	}
	public function fetchYou(){
		$me = $_SESSION['email'];
		$query = $this->query("SELECT * FROM login WHERE email=\"$me\"");
		return $this->fetch_array($query);
	}
	public function newItem($title, $description, $stock, $amount, $discount, $image, $author, $audience, $format, $language, $pages, $country, $edition, $cat){
		$slug = $this->fuckpbnl($title);
		$sku = time();
		$date = date("d D M Y h:iA");
		$img = str_replace("0.jpg,","",$image);
		$query = $this->query("INSERT INTO items(title, description, stock, sku, amount, discount, slug, date, images, author, audience, format, language, pages, country, edition, category)VALUES(\"$title\", \"$description\", \"$stock\", \"$sku\", \"$amount\", \"$discount\", \"$slug\", \"$date\", \"$img\", \"$author\", \"$audience\", \"$format\", \"$language\", \"$pages\", \"$country\", \"$edition\", \"$cat\")");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Item Successfully Added!</div>";
			header("location: items");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Failed to add your item at this time, Please try again.</div>";
			header("location: new-item");
			exit;
		}
	}
	public function fetchItemsBack($page, $limit){
		$startpoint = ($page * $limit) - $limit;
		$query = $this->query("SELECT * FROM items LIMIT {$startpoint} , {$limit}");
		while($row = $this->fetch_array($query)){
			echo "<tr>
					<td>".$row['id']."</td>
					<td>".$row['title']."</td>
					<td>".substr($row['description'],0,40)."...</td>
					<td>".$row['sku']."</td>
					<td>".$row['stock']."</td>
					<td>₦".$row['amount']."</td>
					<td>₦".$row['discount']."</td>
					<td>".$row['date']."</td>
					<td><a href=\"edit-item?id=".$row['id']."\">Edit</a> | <a href=\"mint?action=deleteItem&id=".$row['id']."\">Delete</a> | ".$this->ifExistRec($row['id']."/".$row['slug'], $row['images'])."</td>
				</tr>";
		}
	}
	public function ifExistRec($slug, $image){
		$query = $this->query("SELECT * FROM recommend WHERE slug=\"$slug\"");
		if($this->num_rows($query)>0){
			return "<a href=\"mint?action=recs&image=".$image."&slug=".$slug."\">-1</a>";
		}else{
			return "<a href=\"mint?action=rec&image=".$image."&slug=".$slug."\">+1</a>";
		}
	}
	public function paging($pages, $page, $per_page, $dlink, $tbname){
		$url = $dlink."/".$pages."?page";
		$query = "SELECT COUNT(*) as `num` FROM {$tbname}";
			$row = $this->fetch_array($this->query($query));
			$total = $row['num'];
			$adjacents = "2"; 
	
			$page = ($page == 0 ? 1 : $page);  
			$start = ($page - 1) * $per_page;								
			
			$prev = $page - 1;							
			$next = $page + 1;
			$lastpage = ceil($total/$per_page);
			$lpm1 = $lastpage - 1;
			if($page > 1){
			$pagination = "<a href='".$url."=$prev'>[prev]</a>";
			}
			if($lastpage > 1)
			{	
				$pagination .= "";
						$pagination .= "";
				if ($lastpage < 7 + ($adjacents * 2))
				{	
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "[$counter]";
						else
							$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))
				{
					if($page < 1 + ($adjacents * 2))		
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "[<a class='current'>$counter]</a>";
							else
								$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href='".$url."=$lpm1'>[$lpm1]</a>";
						$pagination.= "<a href='".$url."=$lastpage'>[$lastpage]</a>";		
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href='".$url."=1'>[1]</a>";
						$pagination.= "<a href='".$url."=2'>[2]</a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<a class='current'>[$counter]</a>";
							else
						 $pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href='".$url."=$lpm1'>[$lpm1]</a>";
						$pagination.= "<a href='".$url."=$lastpage'>[$lastpage]</a>";		
					}
					else
					{
						$pagination.= "<a href='".$url."=1'>[1]</a>";
						$pagination.= "<a href='".$url."=2'>[2]</a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<a class='current'>[$counter]</a>";
							else
								$pagination.= "<a href='".$url."=$counter'>[$counter]</a>";					
						}
					}
				}
				
				if ($page < $counter - 1){ 
					$pagination.= "<a href='".$url."=$next'>[Next]</a>";
					$pagination.= "<a href='".$url."=$lastpage'>[Last]</a>";
				}else{
					$pagination.= "<a class='current'>[Next]</a>";
					$pagination.= "<a class='current'>[Last]</a>";
				}
				$pagination.= "\n";		
			}
			 return $pagination;
	}
	public function pagindex($page, $per_page){
		$url = $this->flink()."?page";
		$query = "SELECT COUNT(*) as `num` FROM items";
			$row = $this->fetch_array($this->query($query));
			$total = $row['num'];
			$adjacents = "2"; 
	
			$page = ($page == 0 ? 1 : $page);  
			$start = ($page - 1) * $per_page;								
			
			$prev = $page - 1;							
			$next = $page + 1;
			$lastpage = ceil($total/$per_page);
			$lpm1 = $lastpage - 1;
			if($page > 1){
			$pagination = "<li><a href='".$url."=$prev'>prev</a></li>";
			}
			if($lastpage > 1)
			{	
				$pagination .= "";
						$pagination .= "";
				if ($lastpage < 7 + ($adjacents * 2))
				{	
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "[$counter]";
						else
							$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))
				{
					if($page < 1 + ($adjacents * 2))		
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><a class='current'>$counter</a></li>";
							else
								$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
						}
						$pagination.= "...";
						$pagination.= "<li><a href='".$url."=$lpm1'>$lpm1</a></li>";
						$pagination.= "<li><a href='".$url."=$lastpage'>$lastpage</a></li>";		
					}
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<li><a href='".$url."=1'>1</a></li>";
						$pagination.= "<li><a href='".$url."=2'>2</a></li>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><a class='current'>$counter</a></li>";
							else
						 $pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
						}
						$pagination.= "...";
						$pagination.= "<li><a href='".$url."=$lpm1'>$lpm1</a></li>";
						$pagination.= "<li><a href='".$url."=$lastpage'>$lastpage</a></li>";		
					}
					else
					{
						$pagination.= "<li><a href='".$url."=1'>1</a></li>";
						$pagination.= "<li><a href='".$url."=2'>2</a></li>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<li><a class='current'>$counter</a></li>";
							else
								$pagination.= "<li><a href='".$url."=$counter'>$counter</a></li>";					
						}
					}
				}
				
				if ($page < $counter - 1){ 
					$pagination.= "<li><a href='".$url."=$next'>Next</a></li>";
					$pagination.= "<li><a href='".$url."=$lastpage'>Last</a></li>";
				}else{
					$pagination.= "<li><a class='current'>Next</a></li>";
					$pagination.= "<li><a class='current'>Last</a></li>";
				}
				$pagination.= "\n";		
			}
			 return $pagination;
	}
	public function getItemByID($id){
		$query = $this->query("SELECT * FROM items WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function editItem($title, $description, $stock, $amount, $discount, $id){
		$query = $this->query("UPDATE items SET title=\"$title\", description=\"$description\", stock=\"$stock\", amount=\"$amount\", discount=\"$discount\" WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Item Successfully Edited!</div>";
			header("location: items");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: edit-item?id=$id");
			exit;
		}
	}
	public function deleteItem($id){
		$query = $this->query("DELETE FROM items WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Item Successfully Deleted!</div>";
			header("location: items");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: items");
			exit;
		}
	}
	public function editMe($username, $name, $location, $password, $picture){
		if(!empty($password)){
			$password = sha1($password);
			$this->query("UPDATE login SET password=\"$password\" WHERE email=\"".$_SESSION['email']."\"");
		}
		if(isset($picture)){
			$tmpFilePath = $picture['pix']['tmp_name'];
			//Make sure we have a filepath
			if ($tmpFilePath != ""){
				//Setup our new file path
				$newFilePath = "".time().$picture['pix']['name'];
				//Upload the file into the temp dir
				if(move_uploaded_file($tmpFilePath, "uploads/".$newFilePath)){
					$this->query("UPDATE login SET pix=\"$newFilePath\" WHERE email=\"".$_SESSION['email']."\"");
				}
			}
		}
		$query = $this->query("UPDATE login SET username=\"$username\", name=\"$name\", location=\"$location\" WHERE email=\"".$_SESSION['email']."\"");
		$_SESSION['msg'] = "<div class=\"alert alert-success\">Profile Successfully Updated!</div>";
		header("location: profile");
		exit;
	}
	public function newCategory($title){
		$slug = $this->fuckpbnl($title);
		$query = $this->query("INSERT INTO categories(name, slug)VALUES(\"$title\", \"$slug\")");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Category Successfully Added!</div>";
			header("location: categories");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: categories");
			exit;
		}
	}
	public function fetch(){
		$query = $this->query("SELECT * FROM items LIMIT 0,5");
		return $this->fetch_array($query);
	}
	public function fetchItemsFront($page, $limit){
		$startpoint = ($page * $limit) - $limit;
		$query = $this->query("SELECT * FROM items LIMIT {$startpoint} , {$limit}");
		while($row = $this->fetch_array($query)){
			
		}
	}
	public function userByID($id){
		$query = $this->query("SELECT * FROM login WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function userByMail($id){
		$query = $this->query("SELECT * FROM login WHERE email=\"$id\"");
		return $this->fetch_array($query);
	}
	public function getCategories($page=""){
		$query = $this->query("SELECT * FROM categories");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function deleteCategory($id){
		$query = $this->query("DELETE FROM categories WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Category Successfully Deleted!</div>";
			header("location: categories");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: categories");
			exit;
		}
	}
	public function getpages($page){
		$query = $this->query("SELECT * FROM pages");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function newPage($title, $content){
		$slug = $this->fuckpbnl($title);
		$query = $this->query("INSERT INTO pages(title, content, slug)VALUES(\"$title\", \"$content\", \"$slug\")");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Page Successfully Added!</div>";
			header("location: pages");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: pages");
			exit;
		}
	}
	public function deletePage($id){
		$query = $this->query("DELETE FROM pages WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Page Successfully Deleted!</div>";
			header("location: pages");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: pages");
			exit;
		}
	}
	public function logOut(){
		unset($_SESSION['isUser']);
		unset($_SESSION['email']);
		header("location: ./");
	}
	public function getUsers(){
		$query = $this->query("SELECT * FROM login");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function newUser($username, $name, $email, $location, $password){
		$query = $this->query("INSERT INTO login(username, name, email, location, password)VALUES(\"$username\", \"$name\", \"$email\", \"$location\", \"$password\")");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Admin Successfully Added!</div>";
			header("location: users");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: users");
			exit;
		}
	}
	public function recommend($image, $slug){
		$query = $this->query("INSERT INTO recommend(image, slug)VALUES(\"$image\", \"$slug\")");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Publication Successfully Recommended!</div>";
			header("location: items");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: items");
			exit;
		}
	}
	public function recommends($image, $slug){
		$query = $this->query("DELETE FROM recommend WHERE image=\"$image\" && slug=\"$slug\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Recormendation Successfully Removed!</div>";
			header("location: items");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">Operation Failed, Please try again.</div>";
			header("location: items");
			exit;
		}
	}
	public function fetchRecomend(){
		$query = $this->query("SELECT * FROM recommend");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function randomItem($limit){
		$query = $this->query("SELECT * FROM items ORDER BY rand() LIMIT 0, {$limit}");
		while($row = $this->fetch_array($query)){
			$data[] = $row;
		}
		return $data;
	}
	public function getCategoryBySlug($slg){
		$query = $this->query("SELECT * FROM categories WHERE slug=\"$slg\"");
		return $this->fetch_array($query);
	}
	public function ShopSettings(){
		$query = $this->query("SELECT * FROM settings");
		if($query){
			return $this->fetch_array($query);
		}
	}
	public function updateShop($address, $tel, $email, $facebook, $twitter, $instagram, $youtube){
		if(!empty($address)){$this->query("UPDATE settings SET address=\"$address\"");}
		if(!empty($tel)){$this->query("UPDATE settings SET tel=\"$tel\"");}
		if(!empty($email)){$this->query("UPDATE settings SET email=\"$email\"");}
		if(!empty($facebook)){$this->query("UPDATE settings SET facebook=\"$facebook\"");}
		if(!empty($twitter)){$this->query("UPDATE settings SET twitter=\"$twitter\"");}
		if(!empty($instagram)){$this->query("UPDATE settings SET instagram=\"$instagram\"");}
		if(!empty($youtube)){$this->query("UPDATE settings SET youtube=\"$youtube\"");}
		$_SESSION['msg'] = "<div class=\"alert alert-success\">Shop Successfully Updated!</div>";
		header("location: site-settings");
		exit;
	}
	public function contactUs($message, $name, $tel, $email){
		$have = $this->ShopSettings();
		$to = $have['email'];
		$body = $name."<br />";
		$body.= $email."<br />";
		$body.= $tel."<br />";
		$body.= $message;
		$sub = "From Shop Contact Form";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .="From:no-reply@unit1shop.com";
		mail($to,$sub,$body,$headers);
		$_SESSION['msg'] = "<div class=\"alert alert-success\">Thank You For Contacting Us!</div>";
		header("location: contact-us");
		exit;
	}
}
$db = new MySQLiDatabase();
?>