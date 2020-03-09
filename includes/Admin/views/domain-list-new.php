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
                        <option value="No">No</option>
                        <option value="Low">Low</option>
                        <option value="Basic" selected="selected">Basic</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>                        
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="category"><?php _e('Category','domain-manager') ?></label>
                </th>
                <td>
                    <select class="" name="category" id="category">
                        <option value="Local">Local</option>
                        <option value="International" selected="selected">International</option>
                        <option value="Regional">Regional</option>
                        <option value="Vip">Vip</option>                       
                        <option value="Others">Others</option>                        
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="status"><?php _e('Status','domain-manager') ?></label>
                </th>
                <td>
                    <select class="" name="status" id="status">
                        <option value="Free" selected="selected">Free</option>
                        <option value="Parked">Parked</option>
                        <option value="Taken">Taken</option>
                        <option value="Other">Other</option>                      
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