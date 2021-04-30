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
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category_name" >
                            <?php
                            foreach ($category_data as $key => $value) {
                                $cat_name = $value->category_name;
                                $cat_id = $value->id;
                                echo "<option value='$cat_id'>$cat_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control"  name="description" style="height:400px"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload File</label>
                        <input type="file" name="picture" />           
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
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

