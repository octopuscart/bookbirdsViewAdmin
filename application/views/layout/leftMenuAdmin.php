<!-- begin #sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>assets_main/image/icon.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <?php
                $session_data = $this->session->userdata('logged_in');
                ?>
                <p><?php echo $session_data['first_name']; ?></p>


            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php if ($session_data['user_type'] == 'Admin') { ?>


                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/add_user">
                        <i class="active fa fa-plus "></i> <span>Add User</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/app_users">
                        <i class="active fa fa-list "></i> <span>Users Report</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/add_post">
                        <i class="active fa fa-plus "></i> <span>Add Post</span>

                    </a>
                </li>   
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/add_video_post">
                        <i class="active fa fa-plus "></i> <span>Add Video Post</span>

                    </a>
                </li> 
                 
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/post_comment_report">
                        <i class="active fa fa-calendar "></i> <span>Comment Report</span>

                    </a>
                </li>



                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/video_post_report">
                        <i class="active fa fa-calendar "></i> <span>Video Post Report</span>

                    </a>
                </li>


                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/user_post">
                        <i class="active fa fa-bell "></i> <span>Approve Post</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/post_approved_report">
                        <i class="active fa fa-check "></i> <span>Approved Post</span>

                    </a>
                </li>
            <?php } if ($session_data['user_type'] == 'Manager') { ?>

                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/add_post">
                        <i class="active fa fa-plus "></i> <span>Add Post</span>

                    </a>
                </li>   
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/add_video_post">
                        <i class="active fa fa-plus "></i> <span>Add Video Post</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/video_post_report">
                        <i class="active fa fa-calendar "></i> <span>Video Post Report</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/QueryHandler/user_post">
                        <i class="active fa fa-bell "></i> <span>Approve Status</span>

                    </a>
                </li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
