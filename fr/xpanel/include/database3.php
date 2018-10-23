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
		$this->link = mysqli_connect("og21315-001.privatesql:35357","nextscendidb","Sidere852");
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
	public function alert_error(){
		return mysqli_error($this->link);
	}
	public function dlink(){
		return "http://www.nextscenes.com/fr";
	}
	public function action(){
		return $this->clean($_REQUEST['action']);
	}
	public function firstImage($string){
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $string, $image);
		if(empty($image['src'])){
			return $this->dlink()."/img/nopix.png";
		}else{
			return $image['src'];
		}
	}
	public function showNotification(){
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	public function paging($pages, $page, $per_page, $tbname){
		$url = $this->dlink()."/".$pages."/".$page;
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
	public function newStoryline($title, $content, $cat, $upload, $dig){
		$slug = $this->fuckpbnl($title);
		$date = date("d D M Y");
		$author = $_SESSION['uid'];
		if($author == 000001){
			exit;
		}
		if(!empty($title) || !empty($content)){
			if($dig == 1){
				$filename = $this->uploadImageAdmin($upload);
			}else{
				$filename = $this->uploadImageFront($upload);
			}
			$query = $this->query("INSERT INTO fr_storylines(title, content, category, slug, author, date, scene, img)VALUES(\"$title\", \"$content\", \"$cat\", \"$slug\", \"$author\", \"$date\", 1, \"$filename\")");
			if($query){
				$_SESSION['msg'] = "<div class=\"alert alert-success\">Histoire ajouté avec succès</div>";
				header("location: histoires");
				exit;
			}else{
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
				header("location: nouvelle-histoire");
				exit;
			}
		}
	}
	public function editStoryline($title, $content, $cat, $id, $upload, $dig){
		if(!empty($title) || !empty($content)){
			if($dig == 1){
				$filename = $this->uploadImageAdmin($upload);
			}else{
				$filename = $this->uploadImageFront($upload);
			}
			if(isset($upload) && $upload != "Upload Failed"){
				$query = $this->query("UPDATE fr_storylines SET title=\"$title\", content=\"$content\", category=\"$cat\", img=\"$filename\" WHERE id=\"$id\"");
			}else{
				$query = $this->query("UPDATE fr_storylines SET title=\"$title\", content=\"$content\", category=\"$cat\" WHERE id=\"$id\"");
			}
			if($query){
				$_SESSION['msg'] = "<div class=\"alert alert-success\">Histoire éditée avec succès</div>";
				header("location: histoires");
				exit;
			}else{
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
				header("location: edit-histoire?id=$id");
				exit;
			}
		}
	}
	public function deleteStoryline($id){
		$query = $this->query("DELETE FROM fr_storylines WHERE id=\"$id\"");
			if($query){
				$_SESSION['msg'] = "<div class=\"alert alert-success\">Histoire supprimé avec succès</div>";
				header("location: histoires");
				exit;
			}else{
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
				header("location: histoires");
				exit;
			}
	}
	public function newScene($id, $content){
		$story = $this->getStoryID($id);
		$slug = $story['slug'];
		$author = $_SESSION['uid'];
		if($author == 000001){
			exit;
		}
		$date = date("d D M Y");
		$scene = $story['scene'] + 1;
		$query = $this->query("INsERT INTO fr_scenes(content, author, slug, date, scene, s_id)VALUES(\"$content\", \"$author\", \"$slug\", \"$date\", \"$scene\", \"$id\")");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Scènes ajoutées avec succès</div>";
			header("location: scenes");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: new-scene");
			exit;
		}
	}
	public function editScene($content, $id){
		$query = $this->query("UPDATE fr_scenes SET content=\"$content\" WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Scène modifiée avec succès</div>";
			header("location: scenes");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: edit-scene?id=$id");
			exit;
		}
	}
	public function deleteScene($id){
		$query = $this->query("DELETE FROM fr_scenes WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Scène supprimée avec succès</div>";
			header("location: scenes");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: scenes");
			exit;
		}
	}
	public function newForum($title, $description, $upload){
		$slug = $this->fuckpbnl($title);
		$filename = $this->uploadImageAdmin($upload);
		if(($filename != "Upload Failed") && (!empty($filename))){
			$query = $this->query("INSERT INTO fr_forum(title, description, slug, image)VALUES(\"$title\", \"$description\", \"$slug\", \"$filename\")");
		}else{
			$query = $this->query("INSERT INTO fr_forum(title, description, slug)VALUES(\"$title\", \"$description\", \"$slug\")");
		}
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Forum ajouté avec succès</div>";
			header("location: forums");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: nouveau-forum");
			exit;
		}
	}
	public function editForum($title, $description, $id, $upload){
		$filename = $this->uploadImageAdmin($upload);
		if(($filename != "Upload Failed") && (!empty($filename))){
			$query = $this->query("UPDATE fr_forum SET title=\"$title\", description=\"$description\", image=\"$filename\" WHERE id=\"$id\"");
		}else{
			$query = $this->query("UPDATE fr_forum SET title=\"$title\", description=\"$description\" WHERE id=\"$id\"");
		}
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Forum édité avec succès</div>";
			header("location: forums");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: edit-forum?id=$id");
			exit;
		}
	}
	public function deleteForum($id){
		$query = $this->query("DELETE FROM fr_forum WHERE id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">Forum supprimé avec succès</div>";
			header("location: forums");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: forums");
			exit;
		}
	}
	public function getStoryID($id){
		$query = $this->query("SELECT * FROM fr_storylines WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function fetchHome($limit, $cat){
		$query = $this->query("SELECT * FROM fr_storylines WHERE category=\"$cat\" ORDER BY id DESC LIMIT 0, $limit");
		if($query){
			while($row = $this->fetch_array($query)){
				$data[] = $row;
			}
		}
	}
	public function fetchStoryline($cat, $page, $limit, $curPge){
		$startpoint = ($page * $limit) - $limit;
		if($page == ""){
			$page = 1;
		}
		$tbname = "fr_storylines WHERE category=\"$cat\" ORDER BY id DESC";
		$url = $this->dlink()."/".$curPge;
		$startpoint = ($page * $limit) - $limit;
		$query = "{$tbname} LIMIT {$startpoint} , {$limit}";
		$sql = "{$query}";
		$result = $this->query("SELECT * FROM ".$sql);
		while($row = $this->fetch_array($result)){
			$data[] = $row;
		}
		return $data;
	}
	public function fetchStorylineScenes($id){
		$query = $this->query("SELECT * FROM fr_scenes WHERE s_id=\"$id\"");
		if($query){
			while($row = $this->fetch_array($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	public function fetchForum(){
		$query = $this->query("SELECT * FROM fr_forum");
		if($query){
			while($row = $this->fetch_array($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	public function fetchForumID($id){
		$query = $this->query("SELECT * FROM fr_forum WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function fetchForumSlug($id){
		$query = $this->query("SELECT * FROM fr_forum WHERE slug=\"$id\"");
		return $this->fetch_array($query);
	}
	public function login($username, $pass){
		$pass = sha1($pass.$this->salt());
		$query = $this->query("SElECT * FROM c_users WHERE (u_username=\"$username\" || u_email=\"$username\") && u_pass=\"$pass\"");
		if($this->num_rows($query)>0){
			$row = $this->fetch_array($query);
			$_SESSION['uid'] = $row['u_id'];
			if($row['u_mod'] > 0){$_SESSION['nadmin'] = $row['u_id'];}
			header("location: ./");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-warning\">Combinaison d'identifiant / mot de passe incorrecte</div>";
			header("location: ./");
			exit;
		}
	}
	public function salt(){
		$data = "c_=xPf3PL%2342Qv|=xPf3PL@#&s$^&=xPf3PL%2b342542AoFc=m6s%2AZN";
		return $data;
	}
	public function bot_detected() {
	  if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider/i', $_SERVER['HTTP_USER_AGENT'])) {
		$_SESSION['uid'] = 000001;
	  }
	  else {
		//return FALSE;
	  }
	}
	public function logout(){
		unset($_SESSION['uid']);
		unset($_SESSION['nadmin']);
		header("location: ./");
		exit;
	}
	public function isAdmin(){
		if(!isset($_SESSION['nadmin'])){
			header("location: ../");
			exit;
		}
	}
	public function fetchStories($limit, $page, $curPage){
		$startpoint = ($page * $limit) - $limit;
		if($page == ""){
			$page = 1;
		}
		$tbname = "fr_storylines ORDER BY id DESC";
		$url = $this->dlink()."/".$curPge;
		$startpoint = ($page * $limit) - $limit;
		$query = "{$tbname} LIMIT {$startpoint} , {$limit}";
		$sql = "{$query}";
		$result = $this->query("SELECT * FROM ".$sql);
		while($row = $this->fetch_array($result)){
			$data[] = $row;
		}
		return $data;
	}
	public function fetchScenes2($limit, $page){
		$startpoint = ($page * $limit) - $limit;
		if($page == ""){
			$page = 1;
		}
		$tbname = "fr_scenes ORDER BY id DESC";
		$startpoint = ($page * $limit) - $limit;
		$query = "{$tbname} LIMIT {$startpoint} , {$limit}";
		$sql = "{$query}";
		$result = $this->query("SELECT * FROM ".$sql);
		while($row = $this->fetch_array($result)){
			$data[] = $row;
		}
		return $data;
	}
	public function getAuthor($id){
		$query = $this->query("SElECT * FROM c_users WHERE u_id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function fetchStID($id){
		$query = $this->query("SELECT * FROM fr_storylines WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function readStoryline($id, $slug){
		$query = $this->query("SELECT * FROM fr_storylines WHERE id=\"$id\" && slug=\"$slug\"");
		return $this->fetch_array($query);
	}
	public function fetchScenes($s_id){
		$query = $this->query("SELECT * FROM fr_scenes WHERE s_id=\"$s_id\"");
		if($query){
			while($row = $this->fetch_array($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	public function fetchScene($id){
		$query = $this->query("SELECT * FROM fr_scenes WHERE id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function latestScenes($b){
		$query = $this->query("SELECT * FROM fr_scenes ORDER BY id DESC LIMIT 0, $b");
		if($query){
			while($row = $this->fetch_array($query)){
				$data[] = $row;
			}
			return $data;
		}
	}
	public function fetchStoryAuthor($author, $page, $limit){
		$startpoint = ($page * $limit) - $limit;
		if($page == ""){
			$page = 1;
		}
		$tbname = "fr_storylines WHERE author=\"$author\" ORDER BY id DESC";
		$startpoint = ($page * $limit) - $limit;
		$query = "{$tbname} LIMIT {$startpoint} , {$limit}";
		$sql = "{$query}";
		$result = $this->query("SELECT * FROM ".$sql);
		while($row = $this->fetch_array($result)){
			$data[] = $row;
		}
		return $data;
	}
	public function pager($pages, $page, $per_page, $tbname){
		$url = $this->dlink()."/".$pages."?page=".$page;
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
	public function approveScene($id){
		$q = $this->fetchScene($id);
		$sid = $q['s_id'];
		$q2 = $this->getStoryID($sid);
		$s1 = $q['scene'];
		$s2 = $q2['scene'];
		if($s1 > $s2){
			$query = $this->query("UPDATE fr_scenes SET status=1 WHERE id=\"$id\"");
			if($query){
				$this->query("UPDATE fr_storylines SET scene=scene+1 WHERE id=\"$sid\"");
				header("location: scenes");
				exit;
			}else{
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
				header("location: scene?id=$id");
				exit;
			}
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: scene?id=$id");
			exit;
		}
	}
	public function uploadImageAdmin($img){
		$upload = $img["pix"];
		$imgFile = preg_replace('#[^a-z.0-9]#i', '', $img["name"]);
		//$fileExt = pathinfo($imgFile, PATHINFO_EXTENSION);
		$ar = explode('.', $img['pix']['name']);
		$fileExt = end($ar);
		$filename = md5(date('Ymd').time().'-').".".$fileExt;
		$target = "../uploads/".$filename;
		if(move_uploaded_file($img["pix"]['tmp_name'], $target)){
			return $filename;
		}else{
		//	echo $img['upload']['error'];
			return "Upload Failed";
		}
	}
	public function uploadImageFront($img){
		$upload = $img["pix"];
		$imgFile = preg_replace('#[^a-z.0-9]#i', '', $img["name"]);
		//$fileExt = pathinfo($imgFile, PATHINFO_EXTENSION);
		$ar = explode('.', $img['pix']['name']);
		$fileExt = end($ar);
		$filename = md5(date('Ymd').time().'-').".".$fileExt;
		$target = "uploads/".$filename;
		if(move_uploaded_file($img["pix"]['tmp_name'], $target)){
			return $filename;
		}else{
		//	echo $img['upload']['error'];
			return "Upload Failed";
		}
	}
	public function fetchScenesAuthor($author, $limit, $page){
		$startpoint = ($page * $limit) - $limit;
		if($page == ""){
			$page = 1;
		}
		$tbname = "fr_scenes WHERE author=\"$author\" ORDER BY id DESC";
		$startpoint = ($page * $limit) - $limit;
		$query = "{$tbname} LIMIT {$startpoint} , {$limit}";
		$sql = "{$query}";
		$result = $this->query("SELECT * FROM ".$sql);
		while($row = $this->fetch_array($result)){
			$data[] = $row;
		}
		return $data;
	}
	public function register($username, $password, $email, $firstname, $lastname){
			if($username == "" || $username == NULL ||
			$password == "" || $password == NULL){
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">The username and password fields cannot be empty.</div>";
				header('Location: ./');
				exit;
			}
			else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">Please enter a valid email address</div>";
				header('Location: ./');
				exit;
			}
			else{
				$pass= sha1($_POST['password'].$this->salt());
				$date = date("Y-m-d");
				$query = "SELECT * FROM c_users WHERE u_username=\"$username\"";
				$result = $this->query($query); 
				if($this->num_rows($result) == 0){
					$query2 = "SELECT * FROM c_users WHERE u_email=\"$email\"";
					$result2 = $this->query($query2);
					if($this->num_rows($result2) > 0){
						$_SESSION['msg'] = "<div class=\"alert alert-danger\">You have already registered on NextScenes with this email address: ".$email."</div>";
						header('Location: ./');
						exit;
					}
					else{
						$insr= "INSERT INTO c_users (u_email,u_pass,u_username,u_fname, u_lastname) 
							VALUES
							(\"$email\", \"$password\", \"$username\",   \"$firstname\", \"$lastname\")"; 
						$insr = $this->query($insr);
						if(!$insr){
							$_SESSION['msg'] = "<div class=\"alert alert-danger\">Sorry, something seems to have gone wrong.<br>Please try again later.</div>";
							header('Location: ./');
							exit;
						}
						else{
							$to= $email;
							$subj = 'Welcome to Nextscenes.com';
							$msg = '
							<html> 
							<head> 
							<title>WELCOME NEXTSCENES.COM</title> 
							</head> 
							<body> <center> <img src="http://www.nextscenes.com/central/next-scenes_logo.jpg" alt="WELCOME NEXTSCENES.COM">  <br><br><h3><font color=#ff00ff>Thank You for Registering !</font></h3> </center>
							
							<div align=left>
							<h3><font color=#698C00> Hi $username, </font></h3>
							We welcome you to Nextscenes.com. Now that you are a member, you can read from great minds, create your own literary masterpiece and be entertained.<br><br>Go to any Forum of your choice and start your journey into this redefined literary world. <br>
							<font color=#7A4DFF><a href="http://www.nextscenes.com/" target="_blank"><center><h3>Connect to Nextscenes.com : Literary Entertainment !</h3></center></font></a></font>
							</div></body> 
							</html>';
							
							$headers = 'From: Nextscenes.com <support@nextscenes.com>'."\r\n";
							$headers .='Reply-To: support@nextscenes.com'."\n"; 
							$headers .= "MIME-version: 1.0\n";
							$headers .= "Content-type: text/html; charset= iso-8859-1\n";
							mail($to, $subj, $msg, $headers);
							$_SESSION['msg'] = "<div class=\"alert alert-success\">success</div>";
							header('Location: ./');
							exit;
						}
					}
				}
				else{
					$_SESSION['msg'] = "<div class=\"alert alert-danger\">This username is already taken, please enter another username.</div>";
					header('Location: ./');
					exit;
				}
			}
	}
	public function getUser($id){
		$query = $this->query("SELECT * FROM c_users WHERE u_id=\"$id\"");
		return $this->fetch_array($query);
	}
	public function udata($fname, $lname, $id){
		$query = $this->query("UPDATE c_users SET u_fname=\"$fname\", u_lastname=\"$lname\" WHERE u_id=\"$id\"");
		if($query){
			$_SESSION['msg'] = "<div class=\"alert alert-success\">>L'opération a succès</div>";
			header("location: profile");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: manage-account-user");
			exit;
		}
	}
	public function upass($old, $new, $id){
		$old = sha1($old.$this->salt());
		$new = sha1($new.$this->salt());
		$q1 = $this->query("SELECT * FROM c_users WHERE u_id=\"$id\" && u_pass=\"$old\"");
		if($this->num_rows($q1)>0){
			$query = $this->query("UPDATE c_users SET u_pass=\"$new\" WHERE u_id=\"$id\"");
			$_SESSION['msg'] = "<div class=\"alert alert-success\">>L'opération a succès</div>";
			header("location: profile");
			exit;
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: manage-account-user");
			exit;
		}
	}
	public function changeAvatar($upload, $id){
		$filename = $this->uploadImageFront($upload);
		if(($filename != "Upload Failed") && (!empty($filename))){
			$filename = "uploads/".$filename;
			$query = $this->query("UPDATE c_users SET u_avatar=\"$filename\" WHERE u_id=\"$id\"");
			if($query){
				$_SESSION['msg'] = "<div class=\"alert alert-success\">>L'opération a succès</div>";
				header("location: profile");
				exit;
			}else{
				$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
				header("location: manage-account-user");
				exit;
			}
		}else{
			$_SESSION['msg'] = "<div class=\"alert alert-danger\">L'opération a échoué! Veuillez réessayer plus tard</div>";
			header("location: manage-account-user");
			exit;
		}
	}
}
$db = new MySQLiDatabase();
?>