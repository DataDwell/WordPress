<div class="wrap" id="datadwell_settings">
    <h2><?php echo __( 'Data Dwell', 'datadwell' ); ?></h2>
    <form method="post" action="options-general.php?page=datadwell-settings">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label for="datadwell_domain"><?php echo __( 'Data Dwell Domain', 'datadwell' ); ?></label></th>
                <td>
                    <input name="datadwell_domain" type="text" id="datadwell_domain" value="<?php echo get_option('datadwell_domain'); ?>" placeholder="something.datadwell.com" class="regular-text" />
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="datadwell_apikey"><?php echo __( 'API Key', 'datadwell' ); ?></label></th>
                <td>
                    <input name="datadwell_apikey" type="text" id="datadwell_apikey" value="<?php echo get_option('datadwell_apikey'); ?>" placeholder="api_key-moon-abcdef0123456789" class="regular-text" />
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
    </form>
</div>