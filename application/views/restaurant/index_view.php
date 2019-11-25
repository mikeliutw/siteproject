
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <title>restaurant search and reservation</title>

    <style>body {
            padding-top: 50px;
          }
          .starter-template {
            padding: 40px 15px;
            text-align: left;
          }</style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">restaurant</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?=base_url()?>">Home</a></li>

                    <?php
if (empty($this->session->userdata('shopid'))) {
    ?>

                    <li>
                        <a href="<?=base_url()?>index.php/restaurant/login">Login</a>
                    </li>

                      <?
} else {
    ?>
                           <li>
                        <a href="<?=base_url()?>">Welcome <?php echo $this->session->userdata('shopname') ?></a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>index.php/login/logout">Logout</a>
                    </li>
                        <?
}
?>


                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

<div class="starter-template ">
<table class="table table-hover">
<thead> <tr> <th>#</th> <th>Member Name</th> <th>People</th> <th>Date</th><th>Time</th> </tr> </thead>
<tbody>
<?php
$i = 0;
foreach ($shop->result() as $row) {

    $i++;
    ?>
        <tr> <td ><?php echo $i ?></td> <td><?echo $row->mname ?></td>
        <td><?echo $row->people ?></td>
         <td><?echo $row->date ?></td>
        <td><?echo $row->time ?></td>
    </tr>
    <?}?>
    </tbody> </table>
        </div>

        <footer>
            <p>&copy; 2019 Company, Inc.</p>
        </footer>
    </div> <!-- /container -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

</body>

</html>
