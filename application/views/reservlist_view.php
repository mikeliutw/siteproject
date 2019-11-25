

<div class="starter-template ">

<table class="table table-hover"> 
    
<thead> <tr> <th>#</th> <th>Shop</th> <th>People</th> <th>Date</th><th>Time</th> <th>Opt</th> </tr> </thead>

<tbody>
    
<?php
$i = 0;
foreach ($shop->result() as $row) {

$i++;
    ?>
        <tr> <td >  <?php echo $i?>     </td> 
        <td><? echo $row->name?></td> 
        <td><? echo $row->people?></td>
         <td><? echo $row->date?></td>
         
         <td><? echo $row->time?></td> 

         <td>                        <a href="<?=base_url()?>index.php/reservlist/cancel/<? echo $row->reservationid?>">Cancel</a>
</td> 
        
        </tr> 


    <?}?>
    </tbody> </table>
