<div class="starter-template ">
          <a href="<?=$url?>reservation/index/<?=$query2->shopid?>" class="btn btn-primary">Reservation</a>
            <table class="tbNewsarea">
                <tr>
                  <td class="tbNewsareaClass" > <?=$query2->category?></td>
                  <td class="tbNewsareaTitle" >  <?=$query2->name?></td>
                  <td class="tbNewsareaDate"  > <?=$query2->createtime?></td>
                </tr>
                <tr>
                <td colspan="3" class="tbNewsareaDetail">
              <?=htmlspecialchars_decode($query2->content, ENT_QUOTES);?></td>
                </tr>
              </table>
    </div>