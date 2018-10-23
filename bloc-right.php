<div class="side-blog column3">
 <img src="images/ns300x250.jpg" alt="">
 <!--
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-7956928456310977"
     data-ad-slot="8216857848"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->
<br />
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
				
$sql1 = 'SELECT * FROM members Order by IdMembers DESC limit 0,5';
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
        
        <br />
        
        <img src="images/ns300x600.jpg" alt="">
        <br />
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-7956928456310977"
     data-ad-slot="8216857848"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
        <!--
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:600px"
     data-ad-client="ca-pub-7956928456310977"
     data-ad-slot="9693591047"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>	
-->
	</div>