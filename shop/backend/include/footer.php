</div>
<!-- jQuery --> 
<script src="<?php echo $db->dlink();?>/vendor/jquery/jquery.min.js"></script> 
<!-- Bootstrap Core JavaScript --> 
<script src="<?php echo $db->dlink();?>/vendor/bootstrap/js/bootstrap.min.js"></script> 
<!-- NicEdit --> 
<script src="<?php echo $db->dlink();?>/nicEdit.js"></script> 
<!-- DataTables JavaScript --> 
<script src="<?php echo $db->dlink();?>/vendor/datatables/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo $db->dlink();?>/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script> 
<script src="<?php echo $db->dlink();?>/vendor/datatables-responsive/dataTables.responsive.js"></script> 
<!-- Morris Charts JavaScript 
<script src="<?php echo $db->dlink();?>/vendor/raphael/raphael.js"></script> 
<script src="<?php echo $db->dlink();?>/vendor/morrisjs/morris.min.js"></script> 
<script src="<?php echo $db->dlink();?>/vendor/morrisjs/morris-data.js"></script> --> 
<!-- jvectormap JavaScript --> 
<script src="<?php echo $db->dlink();?>/vendor/jquery-jvectormap/jquery-jvectormap.js"></script> 
<script src="<?php echo $db->dlink();?>/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script> 
<!-- Custom Theme JavaScript --> 
<script src="<?php echo $db->dlink();?>/js/adminnine.js"></script> 

<!-- Page-Level Demo Scripts - Tables - Use for reference --> 
<script>
    $(document).ready(function(){
			bkLib.onDomLoaded(function() {
			bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		});
		$("#addMoreImage").click(function(e) {
            $(".addMoreImage").append('<input type="file" name="upload[]" />');
        });
            $('#dataTables-userlist').DataTable({
                responsive: true,
                pageLength:10,
                sPaginationType: "full_numbers",
                oLanguage: {
                    oPaginate: {
                        sFirst: "<<",
                        sPrevious: "<",
                        sNext: ">", 
                        sLast: ">>" 
                    }
                }
            });
            
             Morris.Bar({
            element: 'morris-bar-chart2',
              data: [
                { y: '2006', a: 100, b: 100},
                { y: '2007', a: 75,  b: 75 },
                { y: '2008', a: 60 , b: 60 },
                { y: '2009', a: 75 , b: 75 },
                { y: '2006', a: 100, b: 100},
                { y: '2007', a: 75,  b: 75 },
                { y: '2008', a: 40,  b: 40 },
                { y: '2009', a: 25,  b: 25 },
                { y: '2006', a: 110, b: 110},
                { y: '2007', a: 75,  b: 75 },
                { y: '2008', a: 60,  b: 60 },
                { y: '2009', a: 75,  b: 75 },
                { y: '2012', a: 100, b: 100}
              ],
               resize: true,
                 axes:'',
                 hideHover: 'auto',
              xkey: 'y',
              padding:1,
              ykeys: ['a', 'b'],
              labels: ['Series A'],
              barColors: ["#ffffff", "#cfdfed"]
            });
            
              $('#mapwrap').vectorMap({map: 'world_mill'});              
                  
    
        $(window).resize(function(){
            
            $('#dataTables-userlist').DataTable();
            
        });
        
    });
    </script>
</body>
</html>