<div class="starter-template ">
<div class="row">
        <?php
$i = 0;
foreach ($shop->result() as $row) {
    $url2 = $url . "welcome/shopdetail/" . $row->shopid;
    ?>
        <div class="col-md-4">
        <span class="newsClass">【<?=$row->category?>】</span>
        <h2><a href="<?=$url2?>" class="newsListLink"><span class="newsMsg"> <?=$row->name?></span></a>
</h2>
          </div>
    <?}?>
</div>