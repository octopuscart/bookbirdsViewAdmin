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
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Contact No.</th>
                            <th>Date Of Birth</th>
                            
                            <th>Password</th>
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
                                    <td><?php echo $value['first_name'] . '' . $value['last_name']; ?></td>

                                    <td> <?php echo $value['email']; ?></td>
                                    <td><?php echo $value['user_type']; ?>  </td>
                                  
                                    <td> <?php echo $value['contact_no']; ?></td>
                                    <td> <?php echo $value['birth_date']; ?></td>
                                    
                                    <td><?php  echo $value['password2']; ?> </td>
                                    <td> <a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/QueryHandler/delete_user/<?php echo $value['id'];?>">Delete</a>
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