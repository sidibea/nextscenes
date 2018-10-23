<?php include 'inc.php'; ?>
<?php
include'../../includes/functions.inc.php';
include'../connect_db.php';


/*
        $hostname = "localhost";
		$username = "root";
		$password = "";
		$database = "pg2lp_db";

*/
		//$table = "lib_produit";
		$table = $t2 ;
		//$table = "ibx_news";
		//$table2 = "lib_produit";
		
		$fields = array("idnews" => "idnews", "date" => "date", "rub" => "rub", "position" => "position", "filename" => "filename","titre" => "titre", "HeureUNE" => "HeureUNE"  );
	// $fields = array("idnews" => "idnews", "date" => "date", "subrub" => "subrub", "filename" => "filename","titre" => "titre", "titre2" => "titre2"  );
		//$fields2 = array("NomProduit" => "NomProduit");
	 /****  Configuration Ajax Membres ************/
		
		//$table = "lib_produit";
		//$table = "dedicaces";
	//	$fields1 = array("iddedicace" => "iddedicace", "login" => "login", "cel" => "cel", "date" => "date", "texte" => "texte"  );
		
		$pageLimit = 100;
		//Which field Ajax search should perform on. Leave blank to search ALL fields
		$searchField = "";
		//Which field to initially sort on. Leave blank to not sort on any field.
		$sortField = "idnews";
		//Ascending or Descending initial sort order.
		$sortOrder = "DESC";


		$connection = @mysql_connect ( $hostname, $username, $password );
		if (! $connection) {
			die ( "Fatal Error: Could not connect to database server." );
		}
		if (! @mysql_select_db ( $database )) {
			die ( "Fatal Error: Could not select database." );
		}
		
		if(!$fields){
			$result = @mysql_query("SHOW COLUMNS FROM $table");
			if (mysql_num_rows($result) > 0) {
			   while ($row = mysql_fetch_assoc($result)) {
				   $fields[$row['Field']] = $row['Field'];
			   }
			}
		}
		
		@$get_search = mysql_real_escape_string($_GET['search']);
		@$get_start = mysql_real_escape_string($_GET['start']);
		@$get_direction = mysql_real_escape_string($_GET['direction']);
		@$get_order_by = mysql_real_escape_string($_GET['order_by']);
		

		if($get_search){ 
			if(!$searchField){
				$search_sql = " WHERE ";
				foreach($fields as $key=>$val){
				$search_sql .= "$key LIKE '%$get_search%' OR ";
				}
				$search_sql = substr($search_sql,0,-4);
			} else {			
				$search_sql = " WHERE $searchField LIKE '%$get_search%' ";
			}
			
		}

		if($get_start){ $start = $get_start; } else { $start = "0"; }
		if($get_direction){ $direction = $get_direction; }
		if(@$direction=="ASC"){@$direction="DESC";} else { @$direction="ASC";}
		if($get_order_by){ $order_by = " ORDER BY $get_order_by " . $direction; } else { $order_by = " "; }
		
		if($sortField && !$get_order_by){
		$get_order_by = $sortField;
		$direction = $sortOrder;
		$order_by = " ORDER BY $get_order_by " . $direction;
		}
		
?>
<div class="tableBorder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<table class="ajaxTable" cellpadding="0" cellspacing="0" border="0">
	<thead>
		<tr>
		<?php
			foreach($fields as $key => $val){
			if($key == $get_order_by){ $sort = $direction; } else { $sort = "DESC"; }
				echo "<th align=left><h3>$val</h3></th>";
			}
		?>
		</tr>
	</thead>
<tbody>
	<?php
		@$sql = "SELECT count(*) AS num FROM $table $search_sql $order_by LIMIT $pageLimit";
		$result = mysql_query ( $sql );
		$rowCount = mysql_result($result,0,"num");

		foreach($fields as $key => $val){
			@$select_fields .= $key . ",";
		}
		$select_fields = substr($select_fields,0,-1);

		@$sql = "SELECT $select_fields FROM $table $search_sql $order_by LIMIT $start, $pageLimit";
		$row = mysql_query ( $sql );
		
		while ( $result = mysql_fetch_array ( $row ) ) {
			if ( @$x&1 ){ echo "<tr class=\"tdOdd\">"; } else { echo "<tr class=\"tdEven\">"; }
			/*
			foreach($fields as $key => $val){
				echo "<td align=left>" . $result[$key] . "</td>";
			}
			
			
*/
             echo "<td align=left width=60> $result[idnews] </td>"; // <a href=\"stocks_insert.php?op=$result[IdProduit]\">
             echo "<td align=left width=90> $result[date] </td>"; //  </a>
		
			 echo "<td align=left width=60> $result[rub] </td>";
			  echo "<td align=left width=60> $result[position] </td>";
			 echo "<td align=left> <img src=../../mfupdata/$result[filename] width=25 height=25> </td>";
			  echo "<td align=left> ".CoupeChaine($result['titre'], 80)." </td>"; // ".CoupeChaine($result[titre], 50)." <a href=\"stocks_insert.php?op=$result[IdProduit]\"> </a>
			//  echo "<td align=left> $result[lien] </td>"; 
				 echo "<td align=left width=130> $result[HeureUNE] </td>"; //  </a>
			   echo "<td align=left> <a href=\"activer-une.php?op=$result[idnews]\"><img src=../image/une.gif width=16 height=16> </td>"; 
			   echo "<td align=left> <a href=\"modif.php?op1=$result[idnews]\"><img src=../image/modif.png width=16 height=16> </td>"; 
			   echo "<td align=left> <a href=\"supp.php?op=$result[idnews]\"><img src=../image/supp.png border=0 width=16 height=16></a> </td>"; 
			   
			echo "</tr>";
			@$x++;
		}
		
		$numberOfPages = ceil($rowCount / $pageLimit);
	?>
</tbody>
<tfoot>
	<tr><td colspan="30"><h2><?php echo $rowCount . " News - " . $numberOfPages . " Pages"; ?></h2></td></tr>
</tfoot>
</table>
</div>

<div class="pagination">
<?php
$current_page = ceil($start / $pageLimit) + 1;
$x=1;
$start=0;

if($current_page<=9){
	while($x<=$numberOfPages){
		if($x<=10){
			if($current_page == $x){$class="paginationSelected";} else { $class="";}
			echo "<a href=\"#\" class=\"$class\" onclick=\"javascript:gotoStart($start);\">$x</a> ";
		}
		if($x>10 && $x == $numberOfPages){
			echo " ... <a href=\"#\" onclick=\"javascript:gotoStart($start);\">$x</a> ";
		}
	$start = $start + $pageLimit;
	$x++;
	}
}

$x=1;
if($current_page>=10){
	$pageCounter = $current_page - 5;
	while($x<=10){
		$pageNumber = $pageCounter * $pageLimit - $pageLimit;
		if($pageCounter<=$numberOfPages){
			if($current_page == $pageCounter){$class="paginationSelected";} else { $class="";}
			echo "<a href=\"#\" class=\"$class\" onclick=\"javascript:gotoStart($pageNumber);\">$pageCounter</a> ";
		}
	$pageCounter++;
	$x++;
	}
}

?>
</div>