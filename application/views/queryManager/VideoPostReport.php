<?php
$this->load->view('layout/layoutTop');
?>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Users Report</h3>
            </div>
            <div class="box-body">

                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Category Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Link</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                        ;
                        if ($data) {
                            $count = 1;
                            foreach ($data as $key => $value) {
                                ?>
                                <tr>
                                   
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo $value['cat']; ?></td>
                                    <td><?php echo $value['title']; ?>  </td>
                                    <td><?php echo $value['description']; ?>  </td>
                                    <td><?php echo $value['op_date_time']; ?>  </td>
                                    <td><?php echo $value['link']?> </td>
  
                               <td> 

                                        <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/QueryHandler/edit_video_post/<?php echo $value['id'];?>">Edit</a>

                                    </td>
                                                                      <td>
<?php
$session_data = $this->session->userdata('logged_in');
if ($session_data['user_type'] == 'Admin'){
?>

<a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/QueryHandler/delete_video_post/<?php echo $value['id'];?>">Delete</a>
<?php
}
?>

</td>
                                </tr>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</section>
<!-- end col-6 -->



<?php
$this->load->view('layout/layoutFooter');
?> 
<script>
    $(function () {

        $('#tableData').DataTable({
//      'paging'      : true,
//      'lengthChange': false,
//      'searching'   : false,
//      'ordering'    : true,
//      'info'        : true,
//      'autoWidth'   : false
        })
    })

</script>