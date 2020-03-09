<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Domain Lists' , 'domain-manager') ?></h1>
    <a class="page-title-action" href="<?php echo admin_url('admin.php?page=domain-manager&action=new') ?>"><?php _e('Add New' , 'domain-manager') ?></a>

    <a class="page-title-action" href="<?php echo admin_url('admin.php?page=domain-manager&action=check') ?>"><?php _e('Check' , 'domain-manager') ?></a>
    <span style="float:right">Last Updated : 12 Minutes Ago</span>

    

    <form action="" method="post">
        <?php
        $table = new Domain\Manager\Admin\Domain_List();
        $table->prepare_items();
        $table->search_box( 'search', 'search_id' );
        $table->display();
        ?>
    </form>

</div>