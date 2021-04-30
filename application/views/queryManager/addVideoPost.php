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
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category_name" >
                            <option value="2">PADHAI VADHAI'S APP QUERIES</option>
                            <option value="5">TEST PAPERS (PREVIOUS YEARS)</option>
                            <option value="6">OUR CHANNEL VIDEOS</option>
                            <option value="9">TRAINER NOTES</option>
                            <option value="13">OUR PEOPLE</option>
                            <option value="19">CREATIVE IDEAS</option>
                            <option value="20">CALCULATORS</option>
                         </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea class="form-control"  name="description" style="height:200px"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Video Link</label>
                        <input type="text" class="form-control" name="link" >
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>


    </div>
</section>
<!-- end col-6 -->
</div>


<?php
$this->load->view('layout/layoutFooter');
?> 

