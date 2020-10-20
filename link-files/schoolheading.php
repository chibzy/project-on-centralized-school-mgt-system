<div class="span12">
<div class="padding"><img src="img/icons/icon-school.png" align="left" class="school-img-position" /><div class="school-details"><h2><?php echo $schldetails['schlName'];?></h2>
<h4>of <?php echo $schldetails['address'];?>.</h4>
<h5>on <?php echo getDomainname();?></h5></div></div>
<div class="clear"></div>
<div class="container-fluid stat-font">
<div class="row-fluid">
<div class="span12">
<table width="100%" height="100%" class="bg">
<tr align="center"><td class="stat-background title font">Students statitistics : </td>
<?php
$class=array('JSS 1','JSS 2','JSS 3','SS 1','SS 2','SS 3');
$cyear=date('Y');
$total=count($class);
for($i=0;$i<$total;$i++){
    #echo "$i - {$class[$i]} - $i+1 - ok<br>";
     ?>
     <td><?php echo $class[$i];?> : <?php echo classPopulation($cyear,($i+1),$_SESSION['schlid']);?></td>
    <?php
    $cyear=$cyear-1;
}
?>
<!--td>JSS 1 : <?php #echo classPopulation('2016','1',$_SESSION['schlid']);?></td>
<td>JSS 2 : <?php #echo classPopulation('2015','2',$_SESSION['schlid']);?></td>
<td>JSS 3 : <?php #echo classPopulation('2014','3',$_SESSION['schlid']);?></td>
<td>SS 1 : <?php #echo classPopulation('2013','4',$_SESSION['schlid']);?></td>
<td>SS 2 : <?php #echo classPopulation('2012','5',$_SESSION['schlid']);?></td>
<td>SS 3 : <?php #echo classPopulation('2011','6',$_SESSION['schlid']);?></td-->
</tr>
</table>
</div>
</div>
</div>
</div>