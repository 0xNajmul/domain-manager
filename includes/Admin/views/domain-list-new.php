<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Add New Domain' , 'domain-manager') ?></h1>

    <?php var_dump($this->errors); ?>

    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="domain_name"><?php _e('Domain Name','domain-manager') ?></label>
                </th>
                <td>
                    <input type="text" name="domain_name" class="regular-text" value="" placeholder="Enter Domain Name">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="priority"><?php _e('Prioriry','domain-manager') ?></label>
                </th>
                <td>
                    <select class="" name="priority" id="priority">
                        <option value="no">No</option>
                        <option value="low">Low</option>
                        <option value="basic" selected="selected">Basic</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>                        
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="category"><?php _e('Category','domain-manager') ?></label>
                </th>
                <td>
                    <select class="" name="category" id="priority">
                        <option value="local">Local</option>
                        <option value="international" selected="selected">International</option>
                        <option value="regional">Regional</option>
                        <option value="vip">Vip</option>                       
                        <option value="others">Others</option>                        
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="description"><?php _e('Description','domain-manager') ?></label>
                </th>
                <td>
                   <textarea class="regular-text" name="description" id="description" rows="5"></textarea>
                </td>
            </tr>
        </table>
        <?php wp_nonce_field('new-domain') ?>
        <?php submit_button(__('Add Domain', 'domain-manager'), 'primary' ,'submit_domain') ?>
    </form>


</div>