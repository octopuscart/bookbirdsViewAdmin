<?php
$this->load->view('layout/layoutTop');
?>
<!-- Main content -->
<section class="content">
    <div class="">

         <h2>Not Authorized</h2>
        
        
    </div>
</section>
<!-- end col-6 -->
</div>

<script src="<?php echo base_url(); ?>assets_main/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({selector: 'textarea', plugins: 'advlist autolink link image lists charmap print preview'});</script>
<?php
$this->load->view('layout/layoutFooter');
?> 

