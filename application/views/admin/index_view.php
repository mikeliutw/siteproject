<ul id="navbar">

    <li class="active"><a href="<?php echo base_url(); ?>index.php/admin/"><span class="icon_text dashboard"></span>dashboard</a>
    </li>
    <li><a href='<?php echo base_url(); ?>index.php/admin/teacher'>老師簡介</a></li>
    <li><a href='<?php echo base_url(); ?>index.php/admin/course'>課程消息管理</a></li>

    <li><a href='<?php echo base_url(); ?>index.php/admin/news'>最新消息</a></li>
    <li><a href='<?php echo base_url(); ?>index.php/admin/account'>帳號管理</a></li>
    <li><a href='<?php echo base_url(); ?>index.php/admin/custom'>客製頁面</a></li>
    <li><a href='<?php echo base_url(); ?>index.php/admin/picupload'>圖片上傳</a></li>
    <li><a href='<?php echo base_url(); ?>index.php/admin/salon'>教學成果</a></li>

</ul>
<div id="subnavbar">
</div>
<div id="content">

    <script type="text/javascript">
        $(function () {
            $("#datepicker").datepicker();
            $("#datepicker").change(function () {
                $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
            });
        });


        function changedr() {
            var oform = document.forms["normalform"];
            var getName = oform.elements.uploadcategory.value;
            oform.elements.url.value = getName;
        }

        function changedr2() {
            var oform = document.forms["normalform"];
            var getName = oform.elements.uploadcategory2.value;
            oform.elements.img.value = getName;
        }

        function category() {
            var oform = document.forms["normalform"];
            var getName = oform.elements.newscategoryid.value;
            document.getElementById("img").disabled = false;
        }
    </script>

    <div class="column full">


        <div id="tabs" class="box tabs themed_box">
            <h2 class="box-header"></h2>
            <ul class="tabs-nav">
                <li class="tab"><a href="#tabs-1">首頁設定</a></li>
                <li class="tab"><a href="#tabs-2">通識活動</a></li>
                <li class="tab"><a href="#tabs-3">相關連結</a></li>
                <li class="tab"><a href="#tabs-4">Banner設定</a></li>

            </ul>
            <div class="box-content">
                <div id="tabs-1">
                    <div class="box themed_box">
                        <h2 class="box-header">Web Config </h2>
                        <div class="box-content">

                            <form action="<?= $adminurl ?>webconfig_update" method="post">

                                <label class="form-label"> Site Name:</label> <input class="form-field small"
                                                                                     value="<?= $name ?>" name="name"
                                                                                     type="text"/>
                                <p>

                                    <label class="form-label"> 通試活動檔案下載:</label> <input class="form-field small"
                                                                                        value="<?= $activityfile ?>"
                                                                                        name="activityfile"
                                                                                        type="text"/>
                                <p>

                                    <label class="form-label"> 通試活動檔案下載名稱:</label> <input class="form-field small"
                                                                                          value="<?= $activityname ?>"
                                                                                          name="activityname"
                                                                                          type="text"/>
                                <p>
                                    <input type="submit" class="button themed" value="Update"/>
                                <p>


                            </form>


                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div id="tabs-2">
                    <div class="box themed_box">
                        <h2 class="box-header">Acivity </h2>
                        <div class="box-content">

                            <table class="display" id="">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                foreach ($query1->result() as $row) {

                                    $i++;
                                    $bgColor = ($i % 2 == 0) ? 'bgColor' : '';
                                    ?>
                                    <tr class="<?= $bgColor; ?>">

                                        <td class="nTitle"><a
                                                    href='<?= $adminurl . "activity_del" ?>/<?= $row->activityid ?>'>DEL</a>
                                        </td>
                                        <td class="nCategory"><a
                                                    href="<?= $adminurl . "activity_detail" ?>/<?= $row->activityid ?>"><?= $row->title ?></a>
                                        </td>
                                        <td class="nCategory"><?= $row->date ?>   </td>
                                    </tr>
                                <? }
                                ?>
                                </tbody>
                            </table>


                            <form id="normalform" action="<?php echo $adminurl; ?>activity_adds" method="post">
                                <label class="form-label required"> Title </label>
                                <input class="form-field width60" name="title" type="text" value="" maxlength="100"/>


                                <label class="form-label"> Date: </label>
                                <input class="form-field small" id="datepicker" type="text" name="date"
                                       value="<?php echo $date; ?>"/>

                                <label class="form-label required"> URL or FILE LINK </label>
                                <input class="form-field width60" name="url" type="text" value="" maxlength="100"/>
                                <select name="uploadcategory" id="uploadcategory" onchange="changedr()">
                                    <option></option>
                                    <?

                                    $siteurl = "http://cge.cycu.edu.tw/uploads/images/";

                                    if ($handle = opendir('./uploads/images')) {
                                        while (false !== ($file = readdir($handle))) {
                                            if ($file != "." && $file != ".." && $file != '.DS_Store') {
                                                ?>

                                                <option value="<?= $siteurl . $file ?>"><?= $file ?></option>
                                            <? }
                                        }
                                    } ?>
                                </select>

                                <label class="form-label required"> Image </label>
                                <input class="form-field width60" id="img" name="img" type="text" maxlength="100"/>

                                <select name="uploadcategory2" id="uploadcategory2" onchange="changedr2()">
                                    <option></option>
                                    <?

                                    $siteurl = "/uploads/images/";

                                    if ($handle = opendir('./uploads/images')) {
                                        while (false !== ($file = readdir($handle))) {
                                            if ($file != "." && $file != ".." && $file != '.DS_Store') {
                                                ?>

                                                <option value="<?= $siteurl . $file ?>"><?= $file ?></option>
                                            <? }
                                        }
                                    } ?>
                                </select>
                                只有在中心相關消息才有作用

                                <h2 class="box-header">Content</h2>

                                <script>
                                    CKFinder.setupCKEditor(null, '/ckfinder/');
                                    var editor = CKEDITOR.replace('editor1');

                                </script>
                                <textarea class="ckeditor" id="editor1" cols="80" name="editor1" rows="15"></textarea>
                                <div class="clear"></div>

                                <input type="submit" class="button white" value="ADD"/>
                            </form>


                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div id="tabs-3">
                    <div class="box themed_box">
                        <h2 class="box-header">Links </h2>
                        <div class="box-content">

                            <form action="<?= $adminurl ?>links_adds" method="post">

                                <input class="form-field small" value="name" name="name" type="text"/>
                                <p>
                                    <input class="form-field small" value="link" name="links" type="text"/>
                                <p>
                                    <input class="form-field small" value="sort" name="sort" type="text"/>
                                <p>
                                    <input type="submit" class="button themed" value="新增"/>
                                <p>
                            </form>

                            <?php
                            $i = 0;
                            foreach ($links->result() as $row) {

                                ?>
                                <form action="<?= $adminurl ?>links_update" method="post">
                                    <input class="form-field small" value="<?= $row->name ?>" name="name"
                                           type="text"/><br>
                                    <input class="form-field small" value="<?= $row->link ?>" name="links" type="text"/>
                                    <p>
                                        <input class="form-field small" value="<?= $row->sort ?>" name="sort"
                                               type="text"/>
                                    <p>
                                        <input class="form-field small" value="<?= $row->linksid ?>" name="linksid"
                                               type="hidden"/>
                                        <input type="submit" class="button themed" value="更新"/>
                                        <a class="button themed" href="<?= $adminurl ?>links_del/<?= $row->linksid ?>">刪除</a>
                                </form>
                            <? }
                            ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div id="tabs-4">
                    <div class="box themed_box">
                        <h2 class="box-header">Banner </h2>
                        <div class="box-content">

                            <form action="<?= $adminurl ?>banner_adds" method="post" accept-charset="utf-8"
                                  enctype="multipart/form-data">

                                <select name="pagename">
                                    <option value="最新消息">最新消息</option>
                                    <option value="中心簡介">中心簡介</option>
                                    <option value="師資介紹">師資介紹</option>
                                    <option value="課程資訊">課程資訊</option>
                                    <option value="通試活動">通試活動</option>
                                    <option value="教學成果">教學成果</option>
                                    <option value="常見問題">常見問題</option>
                                </select>


                                    <input class="form-field small" value="" name="userfile" type="file"/>
                                <p>
                                    <input type="submit" class="button themed" value="新增"/>
                                <p>
                            </form>


                            <?php
                            $i = 0;
                            foreach ($banner->result() as $row1) {
                                $banner2 = $this->db->query("select * from banner where pagename='$row1->pagename'");

                                ?>
                                <div style="background: #d4d1d1;margin-top:20px">
                                    <?
                                    foreach ($banner2->result() as $row) {
                                        ?>

                                        <form action="<?= $adminurl ?>banner_update" method="post"
                                              accept-charset="utf-8"
                                              enctype="multipart/form-data">
                                            <input class="form-field small" readonly value="<?= $row->pagename ?>"
                                                   name="name"
                                                   type="text"/><br> <input class="form-field small" readonly
                                                                            value="<?= $row->url ?>"
                                                                            name="url" type="text"/>

                                            <p>
                                                <input class="form-field small" value="<?= $row->bannerid ?>"
                                                       name="bannerid"
                                                       type="hidden"/>
                                             <!--   <input class="form-field small" value="" name="userfile" type="file"/> <input type="submit" class="button themed" value="Update"/> -->
                                                <a class="button themed" onclick="return confirm('Are you sure?')"
                                                   href="<?= $adminurl ?>banner_del/<?= $row->bannerid ?>">刪除</a>

                                        </form>
                                    <? } ?>
                                </div>

                            <? } ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>