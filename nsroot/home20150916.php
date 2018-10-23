<?php
session_start();  
 if(empty($_SESSION['login'])) 
{
  header('Location: index.php');
  exit();
}  
include '../includes/connect_db.php' ;  
?>
<?php include 'meta.php' ; ?>

<body class="withvernav">


    <?php include 'header.php' ; ?>
    <?php include 'menu2.php' ; ?>
    <!--leftmenu-->
        
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">&nbsp;</h1>
           
            
            <ul class="hornav">
                <li class="current"><a href="#default">WELCOME</a></li>
                
            </ul>
        </div><!--pageheader-->
        
        <div id="contentwrapper" class="contentwrapper">
        
        	<div id="default" class="subcontent">
                    <!-- START OF DEFAULT WIZARD --><!-- END OF DEFAULT WIZARD -->
                    
                    <div class="two_third dashboard_left">
                    
                    	
                    
                      <div class="contenttitle2 nomargintop">
                            <h3>HOME</h3>
                        </div><!--contenttitle--><!--overviewhead-->
                        
                       
                        
                        <table cellpadding="0" cellspacing="0" border="0" class="stdtable overviewtable">
                            <colgroup>
                                <col class="con0" width="20%">
                                <col class="con1" width="20%">
                                <col class="con0" width="20%">
                                <col class="con1" width="20%">
                                <col class="con0" width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="head1">Forums</th>
                                    <th class="head0">Scenes Created</th>
                                    <th class="head1">User Nextscenes</th>
                                    <th class="head0">Members</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php 
									$query = 'SELECT COUNT(*) FROM forums';
									$total = mysql_fetch_array(mysql_query($query));
									echo $total[0] ;
									?></td>
                                    <td><?php 
									$query = 'SELECT COUNT(*) FROM scenes';
									$total = mysql_fetch_array(mysql_query($query));
									echo $total[0] ;
									?></td>
                                    <td class="center">44</td>
                                    <td class="center"><?php 
									$query = 'SELECT COUNT(*) FROM members';
									$total = mysql_fetch_array(mysql_query($query));
									echo $total[0] ;
									?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        
                        
                        <div class="widgetbox">
                          <div class="widgetcontent"><!--#scroll1-->
                            </div><!--widgetcontent-->
                      </div><!-- widgetbox -->                            
                        
                        
                    </div>
                    
            </div><!-- #default -->
            
            
            <div id="tabbed" class="subcontent" style="display: none">
            
                    <!-- START OF TABBED WIZARD -->
                    <form class="stdform" method="post" action="#">
                    <div id="wizard2" class="wizard">
                    	
                        <ul class="tabbedmenu">
                            <li>
                            	<a href="#wiz1step2_1">
                                	<span class="h2">STEP 1</span>
                                    <span class="label">Basic Information</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step2_2">
                                	<span class="h2">STEP 2</span>
                                    <span class="label">Account Information</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step2_3">
                                	<span class="h2">STEP 3</span>
                                    <span class="label">Terms of Agreement</span>
                                </a>
                            </li>
                        </ul>
                        
                        <br clear="all" /><br /><br />
                        	
                        <div id="wiz1step2_1" class="formwiz">
                        	<h4>Step 1: Basic Information</h4>
                        	
                                <p>
                                    <label>First Name</label>
                                    <span class="field"><input type="text" name="firstname" class="longinput" /></span>
                                </p>
                                
                                <p>
                                    <label>Last Name</label>
                                    <span class="field"><input type="text" name="lastname" class="longinput" /></span>
                                </p>
                                                                
                                <p>
                                    <label>Gender</label>
                                    <span class="field"><select name="selection">
                                        <option value="">Choose One</option>
                                        <option value="1">Female</option>
                                        <option value="2">Male</option>
                                    </select></span>
                                </p>
                                
                        	
                            
                        </div><!--#wiz1step2_1-->
                        
                        <div id="wiz1step2_2" class="formwiz">
                        	<h4>Step 2: Account Information</h4> 
                            
                                <p>
                                    <label>Account No</label>
                                    <span class="field"><input type="text" name="lastname" class="longinput" /></span>
                                </p>
                                <p>
                                    <label>Address</label>
                                    <span class="field"><textarea cols="80" rows="5" name="location"></textarea></span>
                                </p>
                                                                                               
                        </div><!--#wiz1step2_2-->
                        
                        <div id="wiz1step2_3">
                        	<h4>Step 3: Terms of Agreement</h4>
                            <div class="par terms">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                                <p><input type="checkbox"  /> I agree with the terms and agreement...</p>
                            </div>
                        </div><!--#wiz1step2_3-->
                        
                    </div><!--#wizard-->
                    </form>
                                        
                    <!-- END OF TABBED WIZARD -->
                                
            </div><!-- #tabbed -->
            
            <div id="vertical" class="subcontent" style="display: none">
            
                    <!-- START OF VERTICAL WIZARD -->
                    <form class="stdform" method="post" action="#">
                    <div id="wizard3" class="wizard verwizard">
                    	
                        <ul class="verticalmenu">
                            <li>
                            	<a href="#wiz1step3_1">
                                    <span class="label">Step 1: Basic Information</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step3_2">
                                    <span class="label">Step 2: Account Information</span>
                                </a>
                            </li>
                            <li>
                            	<a href="#wiz1step3_3">
                                    <span class="label">Step 3: Terms of Agreement</span>
                                </a>
                            </li>
                        </ul>
                                                	
                        <div id="wiz1step3_1" class="formwiz">
                        	<h4>Step 1: Basic Information</h4> 
                        	
                                <p>
                                    <label>First Name</label>
                                    <span class="field"><input type="text" name="firstname" class="longinput" /></span>
                                </p>
                                
                                <p>
                                    <label>Last Name</label>
                                    <span class="field"><input type="text" name="lastname" class="longinput" /></span>
                                </p>
                                                                
                                <p>
                                    <label>Gender</label>
                                    <span class="field"><select name="selection">
                                        <option value="">Choose One</option>
                                        <option value="1">Female</option>
                                        <option value="2">Male</option>
                                    </select></span>
                                </p>
                                
                        	
                            
                        </div><!--#wiz1step3_1-->
                        
                        <div id="wiz1step3_2" class="formwiz">
                        	<h4>Step 2: Account Information</h4> 
                            
                                <p>
                                    <label>Account No</label>
                                    <span class="field"><input type="text" name="lastname" class="longinput" /></span>
                                </p>
                                <p>
                                    <label>Address</label>
                                    <span class="field"><textarea cols="80" rows="5" name="location" class="longinput"></textarea></span>
                                </p>
                                                                                               
                        </div><!--#wiz1step3_2-->
                        
                        <div id="wiz1step3_3">
                        	<h4>Step 3: Terms of Agreement</h4>
                            <div class="par terms">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                                <p><input type="checkbox"  /> I agree with the terms and agreement...</p>
                            </div>
                        </div><!--#wiz1step3_3-->
                        
                    </div><!--#wizard-->
                    </form>
                    
                    <br clear="all" /><br />
                    
                    <!-- END OF VERTICAL WIZARD -->
                    
            </div><!--#vertical-->
            
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->

</body>

</html>
