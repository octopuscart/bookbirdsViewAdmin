<?php
$this->load->view('layout/layoutTop');
?>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Users Post Report</h3>
                <a href="<?php echo base_url(); ?>index.php/QueryHandler/approve_status_all" 
               class="btn btn-success pull-right">Approve All</a> 
            </div>
            <div class="box-body">

                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                          
                            <th>Category Name</th>
                              <th>Title</th>
                            <th>Date</th>
                            <th>File</th>
                            <th></th>
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
                                    <td><?php echo $count; ?> </td>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo $value['cat']; ?></td>
                                    <td><?php echo $value['title']; ?>  </td>
                                 
                                    <td><?php echo $value['op_date_time']; ?>  </td>
                                     <td>
                                       <?php if($value['file_name']) {?>  
                                        <a href="http://bookbirdsview.com/post_image/<?php echo  $value['category_name']?>/<?php echo  $value['file_name']?>"  target=\"_BLANK\">Download</a>
                                       <?php }?>
                                     </td>
                                  
                                    <td>
                                        <a href="<?php echo base_url(); ?>index.php/QueryHandler/approve_status/<?php echo $value['id'];?>">Approve</a>
                                    </td>
     
                                    <td>
                                        <a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/QueryHandler/delete_post/<?php echo $value['id'];?>/up_post">Delete</a>
                                    </td>
                                   <td>
                                   <a href="http://bookbirdsview.com/blog_detail.php?blog_id=<?php echo $value['id'] ?>">View More</a>
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