<?php
$this->load->view('layout/layoutTop');

   function checkvalidext($filename, $path, $category) {
 
    if ($path == 'admin') {
        $spath = "http://bookbirdsview.com/bookbirdsViewAdmin/assets_main/image/$category/";
    } else {
        $spath = "http://bookbirdsview.com/post_image/$category/";
    }

    $ext = explode(".", $filename)[1];

    $mfilename = $spath . $filename;
    $listarray = array(
        'doc' => 'doc-docx.png',
        'docx' => 'doc-docx.png',
        'xls' => $mfilename,
        'xlsx' => $mfilename,
        'ppt' => 'ppt-pptx.png',
        'pptx' => 'ppt-pptx.png',
        'jpg' => $mfilename,
        'png' => $mfilename,
        'jpeg' => $mfilename,
        'pdf' => $mfilename,
        'psd' => 'psd.png',
        'txt' => 'text.png',
        'crd' => 'cdr.png',
        'apk' => 'apk.png',
        'zip' => 'zip-rar.png',
        'rar' => 'zip-rar.png',);
    if (isset($listarray[$ext])) {
        return $listarray[$ext];
    } else {
        return "http://bookbirdsview.com/post_image/defaultfile.png";
    }
}



?>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Approved Post Report</h3>
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
                                     <?php
                                    
                                   if($value['file_name']){ 
                                    
                                    
                                 $filepath = "";
                                    if (($value['user_type'] == 'Admin') or ( $value['user_type'] == 'Manager')) {
                                    $filepath = checkvalidext($value['file_name'], 'admin', $value['category_name']);
                                } else {
                                    $filepath = checkvalidext($value['file_name'], '', $value['category_name']);
                                }
                                
                                 ?>   
                                     
                                   <a href="<?php echo $filepath ?>"  target=\"_BLANK\">Download</a>
                                   <?php }else{
                                   
                                    }?>
                                     
                                     </td>
                                  
                                   <td>
                                   <a href="http://bookbirdsview.com/blog_detail.php?blog_id=<?php echo $value['id'] ?>">View More</a>
                                   </td>
                                   <td>
                                        <a class="btn btn-success" href="<?php echo base_url(); ?>index.php/QueryHandler/edit_post/<?php echo $value['id'];?>">Edit</a>
                                    </td>
                                     <td>
                                        <a class="btn btn-danger" href="<?php echo base_url(); ?>index.php/QueryHandler/delete_post/<?php echo $value['id'];?>/ap_post">Delete</a>
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