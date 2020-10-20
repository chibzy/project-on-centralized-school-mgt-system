<div>    
        <table class="btn-group">
        <tr>
        <?php
        	$curdate=date('Y');
			
			$lastdate=$curdate-6;
			
			for($i=$lastdate;$i<=$curdate;$i++){?>
			
            	<td class="btn-group"><button class="btn dropdown-toggle" href="#" data-toggle="dropdown"><?php echo $i;?> <span class="caret"></span></button> 
        <ul class="dropdown-menu"  role="menu" aria-labelledby="dlabel">
        	<li class="dropdown-submenu">
            		<a tabindex="-1" href="">View students</a>
            		<ul class="dropdown-menu">
                    	<li><a tabindex="-1" href="studentlist.php?clsid=<?php echo $i;?>&subclass=A">Sub Class A</a></li>
                        <li><a tabindex="-1" href="studentlist.php?clsid=<?php echo $i;?>&subclass=B">Sub Class B</a></li>
                        <li><a tabindex="-1" href="studentlist.php?clsid=<?php echo $i;?>&subclass=C">Sub Class C</a></li>
                        <li><a tabindex="-1" href="studentlist.php?clsid=<?php echo $i;?>&subclass=D">Sub Class D</a></li>
                        <li><a tabindex="-1" href="studentlist.php?clsid=<?php echo $i;?>&subclass=E">Sub Class E</a></li>
                        <li><a tabindex="-1" href="studentlist.php?clsid=<?php echo $i;?>&subclass=F">Sub Class F</a></li>
                    </ul>
            </li>
            <li class="divider"></li>
            <li class="dropdown-submenu">
            		<a tabindex="-1" href="">Print List</a>
            		<ul class="dropdown-menu">
                    	<li><a tabindex="-1" href="printclasslist.php?clsid=<?php echo $i;?>&subclass=A" target="_blank">Sub Class A</a></li>
                        <li><a tabindex="-1" href="printclasslist.php?clsid=<?php echo $i;?>&subclass=B" target="_blank">Sub Class B</a></li>
                        <li><a tabindex="-1" href="printclasslist.php?clsid=<?php echo $i;?>&subclass=C" target="_blank">Sub Class C</a></li>
                        <li><a tabindex="-1" href="printclasslist.php?clsid=<?php echo $i;?>&subclass=D" target="_blank">Sub Class D</a></li>
                        <li><a tabindex="-1" href="printclasslist.php?clsid=<?php echo $i;?>&subclass=E" target="_blank">Sub Class E</a></li>
                        <li><a tabindex="-1" href="printclasslist.php?clsid=<?php echo $i;?>&subclass=F" target="_blank">Sub Class F</a></li>
                    </ul>
            </li>
            <li class="divider"></li>
            <li class=""><a tabindex="-1" href="#" data-toggle="modal" data-target="#createNewClass">Add to list</a></li>
            <li class="divider"></li>
            <li class=""><a tabindex="-1" href="#" onclick="confirm('This action erases the content of this class, do you wish to continue?');">Clear Class</a></li>
        </ul> 
                </td>
                
				
			<?php
            }
			?>
            <!--td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2010</a></td>
            <td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2011</a></td>
            
            <td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2012</a></td>
            <td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2013</a></td>
            
            
            <td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2014</a></td>
            <td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2015</a></td>
            
            <td><a href="#" data-target="#addnRemoveStudent" data-toggle="modal">2016</a></td-->
        </tr>
        </table>
        
        
</div>