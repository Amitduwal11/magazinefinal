<?php 
$header = "Newsletter";
include 'inc/header.php'; ?>
<?php include 'inc/checklogin.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Subscribers</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Subscribers</h2>
<!--                     <ul class="nav navbar-right panel_toolbox">
                      <a href="javascript:;" class="btn btn-primary" onclick="addNewsletter();">Add Newsletter</a>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <th>S.N</th>
                        <th>Email</th>
                        <th>Time</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $Newsletter = new newsletter();
                          $Newsletters = $Newsletter->getAllNewsletter();
                          // debugger($Newsletters);
                          if ($Newsletters) {
                            foreach ($Newsletters as $key => $newsletter) {
                        ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $newsletter->email; ?></td>
                          <td><?php echo date("M d, Y h:i:s a",strtotime($newsletter->created_date)); ?></td>
                          <td>

                            <a href="process/newsletter?id=<?php echo($newsletter->id) ?>&amp;act=<?php echo substr(md5("Delete-Message-".$newsletter->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                        <?php
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
  <?php include 'inc/footer.php'; ?>
  <script src="assets/js/datatable.js"></script>