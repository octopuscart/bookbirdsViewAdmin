<?php
$this->load->view('layout/layoutTop');

   function checkvalidext($filename, $path, $category) {
 
    
        $spath = "http://bookbirdsview.com/post_image/post_comment/";
  



    $mfilename = $spath . $filename;
   
        return $mfilename;
    
}



?>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Post Comment Report</h3>
            </div>
            <div class="box-body">

                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Post Title</th>
                            <th>Commnet</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>File</th>
                      
                           
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
 <td><?php echo $value['title']; ?></td>
                                    <td><?php echo $value['comment'] ?></td>
                                   
                                    <td><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?>  </td>
                                 
                                    <td><?php echo $value['datetime']; ?>  </td>
                                     <td>
                                     <?php
                                    
                                   if($value['filename']){ 
                                    
                                    
                                 $filepath = "";
                                    if (($value['user_type'] == 'Admin') or ( $value['user_type'] == 'Manager')) {
                                    $filepath = checkvalidext($value['filename'], 'admin', $value['category_name']);
                                } else {
                                    $filepath = checkvalidext($value['filename'], '', $value['category_name']);
                                }
                                
                                 ?>   
                                     
                                   <a href="<?php echo $filepath ?>"  target=\"_BLANK\">Download</a>
                                   <?php }else{
                                   
                                    }?>
                                     
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