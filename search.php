<?php  
    include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
        $bread = "Search results";
    include 'inc/header.php';

    //debugger($_GET);
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search_text = $_GET['search'];
       //debugger($search_text);

    }else{
        redirect('index');
    }

?>
        <!-- section -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">

                    <!-- aside -->
                    <div class="col-md-8">
                        <!-- ad -->
                       <!--  <div class="aside-widget text-center">
                            <a href="#" style="display: inline-block;margin: auto;">
                                <img class="img-responsive" src="./assets/img/postad-2.jpg" alt="">
                            </a>
                        </div> -->
                        <!-- /ad -->

                        <!-- post widget -->
                        <div class="aside-widget">
                            <div class="section-title">
                                <h2><?php echo "Search results for $search_text"; ?></h2>
                            </div>


                                <?php 
                                    $Blog = new blog();
                                   // debugger($search_text);
                                    $blogs = $Blog->getBlogbyText($search_text);
                                    //debugger($blogs);
                                    if (isset($blogs) && !empty($blogs)) {
                                        foreach ($blogs as $key => $blog) {

                                    if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'/blog/'.$blog->image)){
                                        $thumbnail = UPLOAD_URL.'/blog/'.$blog->image;
                                    }else{

                                        $thumbnail = UPLOAD_URL.'noimg.jpg';
                                    } 

                                ?>  
                                <div class="post post-widget">      
                                    <a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
                                    <div class="post-body">
                                        <h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title ?></a></h3>
                                    </div>
                                </div>

                                <?php
                                        }
                                    }else{
                                ?>
                                    <h3>Search results not found.</h3>
                                <?php
                                    }
                                 ?>



                        </div>
                        <!-- /post widget -->
                    </div>
                    <!-- /aside -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /section -->

        <?php include 'inc/footer.php'; ?>