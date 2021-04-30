<?php
$this->load->view('layout/layoutTop');
?>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Add Post</h3>
            </div>
            <div class="box-body">

                <?php echo $this->session->flashdata('success_msg'); ?>
                <?php echo $this->session->flashdata('error_msg'); ?>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category_name" >

                            <?php
                            foreach ($category_data as $key => $value) {
                                $cat_name = $value->category_name;
                                $cat_id = $value->id;
                                echo "<option value='$cat_id' " . ($data['category_name'] == $cat_id ? 'selected' : '') . ">$cat_name</option>";
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control"  name="description" style="height: 500px;"><?php echo $data['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload File</label>
                        <input type="file" name="picture" />           
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Post Comment</h3>
            </div>
            <div class="box-body">
                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($comments) {
                        
                        foreach ($comments as $key => $value) {
                            
                            ?>
                            <tr>

                        <div class="post">
                            <div class="user-block">
                               <?php if($value['profileimage']){?>
                                <img class="img-circle img-bordered-sm" src="http://bookbirdsview.com/post_image/profile_image/<?php echo $value['profileimage'];?>" alt="user image">
                               <?php }else{?>
                                  <img class="img-circle img-bordered-sm" src="http://bookbirdsview.com/post_image/user-default.jpg" alt="user image">

                                <?php }?>
                                <span class="username">
                                    <a href="#"><?php echo $value['first_name'].''.$value['last_name'];?></a>
                                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/delete_comment/<?php echo $value['id'];?>/<?php echo $value['post_id'];?>" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                </span>
                                <span class="description">Shared publicly - <?php echo $value['op_date_time'];?></span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                <?php echo $value['comment'];?>
                            </p>
                           

                        </div>

                        </tr>
                        <?php
                    }
                    
                    }else{ echo "No Comment Found"; }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- end col-6 -->
</div>

<script src="<?php echo base_url(); ?>assets_main/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({selector: 'textarea', plugins: 'advlist autolink link image lists charmap print preview'});</script>
<?php
$this->load->view('layout/layoutFooter');
?> 

