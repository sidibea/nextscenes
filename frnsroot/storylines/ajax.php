<?php // include 'inc.php'; ?>
<?php
//include'../include/functions.inc.php';
include'../../includes/connect_db.php';
//$t1 = "members";
//$t2 = "scenes";

		$table = "storylines" ;
		
		$fields = array("idstory" => "Idstory", "DateCreate" => "Date", "Forum" => "Forums", "Title" => "Story Lines",  );
		
		$pageLimit = 30;
		//Which field Ajax search should perform on. Leave blank to search ALL fields
		$searchField = "";
		//Which field to initially sort on. Leave blank to not sort on any field.
		$sortField = "idstory";
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
		@$sql = "SELECT count(*) AS num FROM $table where lang='fr' $search_sql $order_by LIMIT $pageLimit"; //  where rub='news'
		$result = mysql_query ( $sql );
		$rowCount = mysql_result($result,0,"num");

		foreach($fields as $key => $val){
			@$select_fields .= $key . ",";
		}
		$select_fields = substr($select_fields,0,-1);

		@$sql = "SELECT $select_fields FROM $table where lang='fr' $search_sql $order_by LIMIT $start, $pageLimit"; // where rub='news' 
		$row = mysql_query ( $sql );
		
		while ( $result = mysql_fetch_array ( $row ) ) {
			if ( @$x&1 ){ echo "<tr class=\"tdOdd\">"; } else { echo "<tr class=\"tdEven\">"; }
			/*
			foreach($fields as $key => $val){
				echo "<td align=left>" . $result[$key] . "</td>";
			}
			
			
*/
             echo "<td align=left width=100> $result[idstory] </td>"; // <a href=\"stocks_insert.php?op=$result[IdProduit]\">
             echo "<td align=left width=90> $result[DateCreate] </td>"; //  </a>
		
			 echo "<td align=left width=120> $result[Forum] </td>";
			 
			
			// echo "<td align=left> <img src=../../pictures/$result[Filename] width=25 height=25> </td>";
			  echo "<td align=left> $result[Title]</td>"; // ".CoupeChaine($result[titre], 50)." <a href=\"stocks_insert.php?op=$result[IdProduit]\"> </a>
			   echo "<td align=right width=200> <a href=\"homescenes.php?idstory=$result[idstory]\">[ View Scenes ]</a></td>";
			    echo "<td align=left width=180> <a href=\"scenes-valides.php?idstory=$result[idstory]\">[ View All Validated Scenes ]</a></td>";
			  echo "<td align=right> <a href=\"supp.php?op=$result[idstory]\"><strong>[ X ]</strong></a> </td>"; 
			   echo "<td align=left> <a href=\"modif.php?op1=$result[idstory]\"><strong>[ Update ]</strong></a> </td>"; 
			 // echo "<td align=left width=130> X </td>"; //  </a>
			   
			  
			   //echo "<td align=left> <a href=\"supp.php?op=$result[idnews]\"><img src=../image/supp.png border=0 width=16 height=16></a> </td>"; 
			   
			echo "</tr>";
			@$x++;
		}
		
		$numberOfPages = ceil($rowCount / $pageLimit);
	?>
</tbody>
<tfoot>
	<tr><td colspan="30"><h2><?php echo $rowCount . " Histoires ou Story Lines - " . $numberOfPages . " Pages"; ?></h2></td></tr>
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