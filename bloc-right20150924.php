<div class="side-blog column3">
			<!-- Tabs -->
            
           <?php include 'form_right.php' ; ?> 
                
				
			
            <br>
            
			<div class="tabs">					
			<div class="tabs-widget clearfix">
	    		<ul class="tab-links clearfix">
	    			<li class="active"><a href="#popular-tab">Last Members</a></li>
	    			
	    		</ul>

	    		<div id="popular-tab" style="display: block;">
                 <ul>
                <?php
				
$sql1 = 'SELECT * FROM members Order by IdMembers limit 0,5';
$req1 = mysql_query($sql1) or die('Erreur SQL !<br />'.$sql1.'<br />'.mysql_error()); 
while($data1 =mysql_fetch_assoc($req1))
{
echo' <li>
	    					<img src="images/tabs3.jpg" alt="">
	    					<p>'.$data1['Login'].'<br>
	    					  Register : '.$data1['Date'].'    					    
                              </p>
	    					
	    				</li>';

} ?>
	    			
</ul>
	    		</div>

	    		
			</div>
			<!-- End Tabs -->
            

			

			
		</div>
		<div class="clear"></div>	
	</div>