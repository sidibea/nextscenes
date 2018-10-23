<?php
session_start();
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set("Africa/Lagos");
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
	}
	public function clean($str) {
		$str = @trim($str);
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
	public function dlink(){
		return "http://www.nextscenes.com/news";
	}
	public function firstImage($string){
		preg_match('/<*img[^>]*src *= *["\']?([^"\']*)/i', $string, $image);
		if(empty($image[0])){
			return "img/nopix.png";
		}else{
			$image[0] = preg_replace('/(width|height)="\d*"\s/', "", $image[0]);
			$array = array('<img border="0" ', 'src="', '<img ');
			$replace = array("","", "");
			return str_replace($array,$replace,$image[0]);
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
	public function postExist(){
		if($_SESSION['pex'] == true){
			echo "<div class=\"alert alert-warning\">Operation Failed, Topic Already Exist, modify your topic/content</div>";
		}$_SESSION['pex'] = false;
	}
	public function userExist(){
		if($_SESSION['pex'] == true){
			echo "<div class=\"alert alert-warning\">Operation Failed, User Already Exist, modify new user details</div>";
		}$_SESSION['pex'] = false;
	}
	public function postNotExist(){
		if($_SESSION['ped'] == true){
			echo "<div class=\"alert alert-warning\">Operation Failed, Can't Find Posts</div>";
		}$_SESSION['ped'] = false;
	}
	public function getSinglePost($links){
		$sql = "SELECT * FROM topics WHERE slug=\"$links\"";
		$query = $this->query($sql);
		$row = $this->fetch_array($query);
		return $row;
	}
	public function singlePost($links){
		$sql = "SELECT * FROM topics WHERE slug=\"$links\"";
		$query = $this->query($sql);
		return $query;
	}
	public function getPostByID($id){
		$sql = "SELECT * FROM topics WHERE id=\"$id\"";
		$query = $this->query($sql);
		$row = $this->fetch_array($query);
		return $row;
	}
	public function makePost($title, $content, $cat){
		$title = $this->clean($title);
		$content = $this->clean($content);
		$_SESSION['topic'] = $title;
		$_SESSION['content'] = $content;
		$links = $this->fuckpbnl($title);
		$tx = strip_tags($title);
		$cx = strip_tags($content);
		$ttl = preg_replace('/\s+/', '', $tx);
		$con = preg_replace('/\s+/', '', $cx);
		if(empty($ttl) || empty($cx) || empty($cat)){
			$_SESSION['required'] = true;
			header("location: xpanel/new-post");
			exit;
		}
		$date = date("Y-m-d\TH:i:sP");
		$author = $_SESSION['id'];
		$sql = $this->getSinglePost($links);
		$id = $sql['id'];
		if($id == ""){
			$sql = "INSERT INTO topics(topic, content, date, slug, author, cat)VALUES(\"$title\", \"$content\", \"$date\", \"$links\", \"$author\", \"$cat\")";
			$query = $this->query($sql);
			if($query){
				$sql1 = $this->getSinglePost($links);
				$_SESSION['s'] = true;
				$id = $sql1['id'];
				header("location: xpanel/edit?id=$id");
				unset($_SESSION['topic']);
				unset($_SESSION['content']);
				exit;
			}else{
				$_SESSION['f'] = true;
				header("location: xpanel/new-post");
				exit;
			}
		}else{
			$_SESSION['pex'] = true;
			header("location: xpanel/new-post");
			exit;
		}
	}
	public function updatePost($id, $title, $content){
		$title = $this->clean($title);
		$content = $this->clean($content);
		$tx = strip_tags($title);
		$cx = strip_tags($content);
		$ttl = preg_replace('/\s+/', '', $tx);
		$con = preg_replace('/\s+/', '', $cx);
		if(empty($ttl) || empty($con)){
			$_SESSION['required'] = true;
			header("location: xpanel/edit?id=$id");
			exit;
		}
		if($id != ""){
			$sql = "UPDATE topics SET topic=\"$title\", content=\"$content\" WHERE id=\"$id\"";
			$query = $this->query($sql);
			if($query){
				$_SESSION['s'] = true;
				header("location: xpanel/edit?id=$id");
				unset($_SESSION['topic']);
				unset($_SESSION['content']);
				exit;
			}else{
				$_SESSION['f'] = true;
			header("location: xpanel/edit?id=$id");
				exit;
			}
		}else{
			$_SESSION['ped'] = true;
			header("location: xpanel/edit?id=$id");
			exit;
		}
	}
	public function getAllPosts(){
		$sql = "SELECT * FROM topics";
		$query = $this->query($sql);
		$row = $this->fetch_array($query);
		return $row;
	}
	public function getAllPostCount(){
		$sql = "SELECT * FROM topics";
		$query = $this->query($sql);
		$row = $this->num_rows($query);
		return $row;
	}
	public function topic($row){
		return $row['topic'];
	}
	public function content($row){
		return $row['content'];
	}
	public function dtime($row){
		return $row['date'];
	}
	public function id($row){
		return $row['id'];
	}
	public function views($row){
		return $row['views'];
	}
	public function slug($row){
		return $row['slug'];
	}
	public function username($row){
		return $row['username'];
	}
	public function email($row){
		return $row['email'];
	}
	public function name($row){
		return $row['name'];
	}
	public function love($row){
		return $row['love'];
	}
	public function dislove($row){
		return $row['dislove'];
	}
	public function last_seen($row){
		return $row['last_seen'];
	}
	public function role($row){
		return $row['role'];
	}
	public function resetP($row){
		return $row['reset'];
	}
	public function cat($row){
		return $row['cat'];
	}
	public function catName($id){
		$sql = "SELECT * FROM cat WHERE id=\"$id\"";
		$query = $this->query($sql);
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
		}else{
			$row = "NULL";
		}
		return $row;
	}
	public function image($row){
		return $row['image'];
	}
	public function getAuthor($id){
		$sql = "SELECT * FROM membuser WHERE id=\"$id\"";
		$query = $this->query($sql);
		if($this->num_rows($query)>0){
			return $this->fetch_array($query);
		}
	}
	public function author($row){
		return $row['author'];
	}
	public function dates($row){
		return $row['date'];
	}
	public function deletePost($id){
		$sql = "DELETE FROM topics WHERE id=\"$id\"";
		$query = $this->query($sql);
		if($query){
			$_SESSION['s'] = true;
			header("location: xpanel/all-posts");
			exit;
		}else{
			$_SESSION['f'] = true;
			header("location: xpanel/all-posts");
			exit;
		}
	}
	public function postsPaging($pages, $page, $per_page, $dlink, $tbname){
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
	public function action(){
		return $_REQUEST['action'];
	}
	public function getLogin($username, $password){
		return "SELECT * FROM membuser WHERE username=\"$username\" && password=\"$password\"";
	}
	public function findUser($username){
		return "SELECT * FROM membuser WHERE username=\"$username\"";
	}
	public function findUserEmail($email){
		return "SELECT * FROM membuser WHERE email=\"$email\"";
	}
	public function findUserID($email){
		return "SELECT * FROM membuser WHERE id=\"$email\"";
	}
	public function authenticate(){
		if(!isset($_SESSION['admin'])){
			header("location: ../");
		}
	}
	public function newUser($username, $email, $name, $password, $role){
		$username = preg_replace('/\s+/', '', $username);
		$email = preg_replace('/\s+/', '', $email);
		$nm = preg_replace('/\s+/', '', $name);
		$password = preg_replace('/\s+/', '', $password);
		if(empty($username) || empty($email) || empty($nm) || empty($password)){
			$_SESSION['required'] = true;
			header("Location: xpanel/new-user");
			exit;
		}
		$password = sha1($password);
		$query1 = $this->query($this->findUser($username));
		if($this->num_rows($query1) == 0){
			$q1 = $this->query($this->findUserEmail($email));
			if($this->num_rows($q1)>0){
				$_SESSION['pex'] = true;
				header("Location: xpanel/new-user");
				exit;
			}else{
				//Insert Into DB
				$sql = "INSERT INTO membuser(username, email, name, password, role)VALUES(\"$username\", \"$email\", \"$name\", \"$password\", \"$role\")";
				$query = $this->query($sql);
				if($query){
					$_SESSION['s'] = true;
					header("location: xpanel/users");
					exit;
				}else{
					$_SESSION['f'] = true;
					header("location: xpanel/new-user");
					exit;
				}
			}
		}else{
			$_SESSION['pex'] = true;
			header("Location: xpanel/new-user");
			exit;
		}
	}
	public function editUser($username, $email, $name, $password, $id){
		$username = preg_replace('/\s+/', '', $username);
		$email = preg_replace('/\s+/', '', $email);
		$name = preg_replace('/\s+/', '', $name);
		$password = preg_replace('/\s+/', '', $password);
		$id = preg_replace('/\s+/', '', $id);
		if(empty($username) || empty($email) || empty($name) || empty($id)){
			$_SESSION['required'] = true;
			header("Location: xpanel/edit-user?id=$id");
			exit;
		}
		if(empty($password)){
			$sql = "UPDATE membuser SET username=\"$username\", name=\"$name\", email=\"$email\" WHERE id=\"$id\"";
		}else{
			$password = sha1($password);
			$sql = "UPDATE membuser SET username=\"$username\", name=\"$name\", email=\"$email\", password=\"$password\" WHERE id=\"$id\"";
		}
		$query = $this->query($sql);
		if($query){
			$_SESSION['s'] = true;
			header("Location: xpanel/edit-user?id=$id");
			exit;
		}else{
			$_SESSION['f'] = true;
			header("Location: xpanel/edit-user?id=$id");
			exit;
		}
	}
	public function deleteUser($id){
		$sql = "DELETE FROM membuser WHERE id=\"$id\"";
		$query = $this->query($sql);
		if($query){
			$_SESSION['s'] = true;
			header("Location: xpanel/users");
			exit;
		}else{
			$_SESSION['f'] = true;
			header("Location: xpanel/users");
			exit;
		}
	}
	public function editProfile($name, $password){
		$name = preg_replace('/\s+/', '', $name);
		$password = preg_replace('/\s+/', '', $password);
		$id = $this->clean($_SESSION['id']);
		if(empty($name) || empty($id)){
			$_SESSION['required'] = true;
			header("Location: xpanel/edit-profile");
			exit;
		}
		if(empty($password)){
			$sql = "UPDATE membuser SET name=\"$name\" WHERE id=\"$id\"";
		}else{
			$password = sha1($password);
			$sql = "UPDATE membuser SET name=\"$name\", password=\"$password\" WHERE id=\"$id\"";
		}
		$query = $this->query($sql);
		if($query){
			$_SESSION['s'] = true;
			header("Location: xpanel/edit-profile");
			exit;
		}else{
			$_SESSION['f'] = true;
			header("Location: xpanel/edit-profile");
			exit;
		}
	}
	public function allCatOption(){
		$query = $this->query("SELECT * FROM cat");
		if($this->num_rows($query)>0){
			while($row = $this->fetch_array($query)){
				echo "<option value=\"".$this->id($row)."\">".$this->name($row)."</option>";
			}
		}
		return $row;
	}
	public function catByID($id){
		$query = $this->query("SELECT * FROM cat WHERE id=\"$id\"");
		$row = $this->fetch_array($query);
		return $row;
	}
	public function likePost($str){
		$rate = 0;
		$data = 0;
		if(isset($_COOKIE['link']) && $_COOKIE['link'] == $str){
			$query = $this->query("SELECT love FROM topics WHERE slug=\"$str\"");
			$row = $this->fetch_array($query);
			$rate = $this->love($row);
			//Voted
			$data = 2;
		}else{
			//Please add vote
			$this->query("UPDATE topics SET love = love+1 WHERE slug=\"$str\"");
				$query = $this->query("SELECT love FROM topics WHERE slug=\"$str\"");
				$row = $this->fetch_array($query);
				$rate = $this->love($row);
			$data = 1;
			$year = time() + 31536000;
			setcookie('link', $str, $year);
		}
		$array = array($data, $rate);
		return json_encode($array);
	}
	public function dislikePost($str){
		$rate = 0;
		$data = 0;
		if(isset($_COOKIE['link']) && $_COOKIE['link'] == $str){
			//Voted
			$data = 2;
		}else{
			//Please add vote
				$this->query("UPDATE topics SET dislove = dislove+1 WHERE slug=\"$str\"");
				$query = $this->query("SELECT dislove FROM topics WHERE slug=\"$str\"");
				$row = $this->fetch_array($query);
				$rate = $this->dislove($row);
			
			$data = 1;
			$year = time() + 31536000;
			setcookie('link', $str, $year);
		}
		$array = array($data, $rate);
		return json_encode($array);
	}
	public function lovePost($str){
		$rate = 0;
		$data = 0;
		if(isset($_COOKIE['link']) && $_COOKIE['link'] == $str){
			$query = $this->query("SELECT love FROM articles WHERE slug=\"$str\"");
			$row = $this->fetch_array($query);
			$rate = $this->love($row);
			//Voted
			$data = 2;
		}else{
			//Please add vote
			$this->query("UPDATE articles SET love = love+1 WHERE slug=\"$str\"");
				$query = $this->query("SELECT love FROM articles WHERE slug=\"$str\"");
				$row = $this->fetch_array($query);
				$rate = $this->love($row);
			$data = 1;
			$year = time() + 31536000;
			setcookie('link', $str, $year);
		}
		$array = array($data, $rate);
		return json_encode($array);
	}
	public function dislovePost($str){
		$rate = 0;
		$data = 0;
		if(isset($_COOKIE['link']) && $_COOKIE['link'] == $str){
			//Voted
			$data = 2;
		}else{
			//Please add vote
				$this->query("UPDATE articles SET dislove = dislove+1 WHERE slug=\"$str\"");
				$query = $this->query("SELECT dislove FROM articles WHERE slug=\"$str\"");
				$row = $this->fetch_array($query);
				$rate = $this->dislove($row);
			
			$data = 1;
			$year = time() + 31536000;
			setcookie('link', $str, $year);
		}
		$array = array($data, $rate);
		return json_encode($array);
	}
	public function totalPosts($id){
		$query = $this->query("SELECT * FROM topics WHERE author=\"$id\"");
		return $this->num_rows($query);
	}
	public function url_get_contents ($Url) {
		if (function_exists('curl_exec')){ 
			$conn = curl_init($url);
			curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
			curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
			$url_get_contents_data = (curl_exec($conn));
			curl_close($conn);
		}elseif(function_exists('file_get_contents')){
			$url_get_contents_data = file_get_contents($url);
		}elseif(function_exists('fopen') && function_exists('stream_get_contents')){
			$handle = fopen ($url, "r");
			$url_get_contents_data = stream_get_contents($handle);
		}else{
			$url_get_contents_data = false;
		}
	return $url_get_contents_data;
	}
	public function setTraffic(){
		date_default_timezone_set("Africa/Lagos");
		$date = date('Y-m-d');
		$s0 = $this->query("SELECT * FROM traffic");
		$s1 = $this->query("SELECT * FROM traffic WHERE date=\"$date\"");
		if($this->num_rows($s1)>0){
			$this->query("UPDATE traffic SET count=count+1 WHERE date=\"$date\"");
		}else{
			$this->query("INSERT INTO traffic(date, count)VALUES(\"$date\", \"1\")");
		}
		$user_ip = getenv('REMOTE_ADDR');
		$url = "http://www.geoplugin.net/php.gp?ip=".$user_ip;
//		echo url_get_contents($url);
//		$geo = var_export(unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$user_ip)));
		$country = $geo["geoplugin_countryName"];
		$sq1 = $this->query("SELECT * FROM country WHERE name=\"$country\" && date=\"$date\"");
		if($this->num_rows($sq1)>0){
			$this->query("UPDATE country SET hits=hits+1 WHERE name=\"$country\" && date=\"$date\"");
		}else{
			$this->query("INSERT INTO country(name, hits, date)VALUES(\"$country\", \"1\", \"$date\")");
		}
		$ref = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		if($ref == ""){
			$ref = "Annonymous";
		}
		$ref1 = $this->query("SELECT * FROM ref WHERE name=\"$ref\" && date=\"$date\"");
		if($this->num_rows($ref1) > 0){
			$this->query("UPDATE ref SET hits=hits+1 WHERE name=\"$ref\" && date=\"$date\"");
		}else{
			$this->query("INSERT INTO ref(name, hits, date)VALUES(\"$ref\", \"1\", \"$date\")");
		}
	}
    public function viewTraffic(){
		$datas = '';
        $date = date('Y-m-d', strtotime("today"));
        $sq2 = $this->query("SELECT * FROM country WHERE date=\"$date\" ORDER BY hits DESC");
        $ref2 = $this->query("SELECT * FROM ref WHERE date=\"$date\" ORDER BY hits DESC");
        //Get data for today
        $query = $this->query("SELECT * FROM traffic WHERE date=\"$date\"");
        $rs = $this->fetch_array($query);
        $date = date('Y-m-d', strtotime("today"));
            //Get data for yesterday
            $dd = date('Y-m-d', strtotime("-1 day"));
            $query1 = $this->query("SELECT * FROM traffic WHERE date=\"$dd\" ORDER BY oid");
            $ry = $this->fetch_array($query1);
            //Get data for Last Seven days
            $ddw = date('Y-m-d', strtotime("-1 week"));
            $sev = 0;
            $query2 = $this->query("SELECT * FROM traffic WHERE date ='".$ddw."'");
            if($query2){
                while($rw = $this->fetch_array($query2)){
                    $sev += $rw['count'];
                }
            }			//Get data for Last month
            $ddx = date('Y-m-d', strtotime("-1 month"));
            $mon = 0;
            $query3 = $this->query("SELECT * FROM traffic WHERE date='".$ddx."' ORDER BY oid DESC");
            while($rx = $this->fetch_array($query3)){
                $mon += $rx['count'];
            }
            //Get data for One year
            $ddz = date('Y-m-d', strtotime("-1 year"));
            $yer = 0;
            $query4 = $this->query("SELECT * FROM traffic WHERE date='".$ddz."' ORDER BY oid DESC");
            while($rz = $this->fetch_array($query4)){
                $yer += $rz['count'];
            }
        //Get data for All Time
            $query5 = $this->query("SELECT * FROM traffic ORDER BY oid DESC");
            $rp = $this->fetch_array($query5);
            $query6 = $this->query("SELECT * FROM traffic ORDER BY oid ASC");
            $rp6 = $this->fetch_array($query6);
            $dbx = $rp['date'];
            $dbx6 = $rp6['date'];
            $all = 0;
            $query5 = $this->query("SELECT * FROM traffic WHERE date BETWEEN '".$dbx6."' AND '".$dbx."' ORDER BY oid DESC");
            while($rz1 = $this->fetch_array($query5)){
                $all += $rz1['count'];
            }
			$datas[] = $rs['count'];
			$datas[] = $ry['count'];
			$datas[] = $sev;
			$datas[] = $mon;
			$datas[] = $yer;
			$datas[] = $all;
			
			return $datas;
		}
	}
$db = new MySQLiDatabase();
?>