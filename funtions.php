/*Extra field on the seller settings and show the value on the store banner -Dokan*/

// Add extra field in seller settings

add_filter( 'dokan_settings_form_bottom', 'extra_fields', 10, 2);

function extra_fields( $current_user, $profile_info ){
$shopgst= isset( $profile_info['shop_gst'] ) ? $profile_info['shop_gst'] : '';
$shoppan= isset( $profile_info['shop_pan'] ) ? $profile_info['shop_pan'] : '';
$shopfssai= isset( $profile_info['shop_fssai'] ) ? $profile_info['shop_fssai'] : '';
$shopnutrition= isset( $profile_info['shop_nutrition'] ) ? $profile_info['shop_nutrition'] : '';
?>
  <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="setting_shop_gst"><?php esc_html_e( 'GST No', 'dokan-lite' ); ?></label>
            <div class="dokan-w5 dokan-text-left">
                <input id="setting_shop_gst" value="<?php echo esc_attr( $shopgst ); ?>" name="setting_shop_gst" placeholder="<?php esc_attr_e( '15 Character GST Code', 'dokan-lite' ); ?>" class="dokan-form-control input-md" type="text">
            </div>
        </div>
        
        <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="setting_shop_pan"><?php esc_html_e( 'PAN No', 'dokan-lite' ); ?></label>
            <div class="dokan-w5 dokan-text-left">
                <input id="setting_shop_pan" value="<?php echo esc_attr( $shoppan ); ?>" name="setting_shop_pan" placeholder="<?php esc_attr_e( '10 Character Pan number', 'dokan-lite' ); ?>" class="dokan-form-control input-md" type="text">
            </div>
        </div>
        
        <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="setting_shop_fssai"><?php esc_html_e( 'FSSAI License', 'dokan-lite' ); ?></label>
            <div class="dokan-w5 dokan-text-left">
                <input id="setting_shop_fssai" value="<?php echo esc_attr( $shopfssai ); ?>" name="setting_shop_fssai" placeholder="<?php esc_attr_e( 'FSSAI License Number', 'dokan-lite' ); ?>" class="dokan-form-control input-md" type="text">
            </div>
        </div>
        
        <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="setting_shop_nutrition"><?php esc_html_e( 'Nutrition Label', 'dokan-lite' ); ?></label>
            <div class="dokan-w5 dokan-text-left">
                <input id="setting_shop_nutrition" value="<?php echo esc_attr( $shopnutrition ); ?>" name="setting_shop_nutrition" placeholder="<?php esc_attr_e( 'Nutrition Label', 'dokan-lite' ); ?>" class="dokan-form-control input-md" type="text">
            </div>
        </div>
        
    <?php
}
    //save the field value
add_action( 'dokan_store_profile_saved', 'save_extra_fields', 15 );
function save_extra_fields( $store_id ) {
    $dokan_settings = dokan_get_store_info($store_id);
    if ( isset( $_POST['shop_gst'] ) ) {
        $dokan_settings['shop_gst'] = $_POST['shop_gst'];
    }
    elseif  ( isset( $_POST['shop_pan'] ) ) {
        $dokan_settings['shop_pan'] = $_POST['shop_pan'];
    }
    elseif  ( isset( $_POST['shop_fssai'] ) ) {
        $dokan_settings['shop_fssai'] = $_POST['shop_fssai'];
    }
    elseif  ( isset( $_POST['shop_nutrition'] ) ) {
        $dokan_settings['shop_nutrition'] = $_POST['shop_nutrition'];
    }
    
 update_user_meta( $store_id, 'dokan_profile_settings', $dokan_settings );
}

  // adding field value in backend admin user profile area

add_action( 'dokan_seller_meta_fields', 'more_fields', 10 );
add_action( 'dokan_process_seller_meta_fields', 'process_more_fields', 10 );


function more_fields($user){
    
$store_settings        = dokan_get_store_info( $user->ID );

$gst = new Shop_Gst_info();

$shopgst        = isset( $store_settings['shop_gst'] ) ? $store_settings['shop_gst'] : '';
$shoppan        = isset( $store_settings['shop_pan'] ) ? $store_settings['shop_pan'] : '';
$shopfssai      = isset( $store_settings['shop_fssai'] ) ? $store_settings['shop_fssai'] : '';
$shopnutrition  = isset( $store_settings['shop_nutrition'] ) ? $store_settings['shop_nutrition'] : '';
?>
     <tr>
                    <th><?php esc_html_e( 'GST Number', 'dokan-lite' ); ?></th>
                    <td>
                        <input type="text" name="dokan_store_gst" class="regular-text" value="<?php echo esc_attr( $store_settings['shop_gst'] ); ?>">
                    </td>
                </tr>
                
                 <tr>
                    <th><?php esc_html_e( 'PAN Number', 'dokan-lite' ); ?></th>
                    <td>
                        <input type="text" name="dokan_store_pan" class="regular-text" value="<?php echo esc_attr( $store_settings['shop_pan'] ); ?>">
                    </td>
                </tr>
                
                <tr>
                    <th><?php esc_html_e( 'FSSAI License', 'dokan-lite' ); ?></th>
                    <td>
                        <input type="text" name="dokan_store_fssai" class="regular-text" value="<?php echo esc_attr( $store_settings['shop_fssai'] ); ?>">
                    </td>
                </tr>
                
                
                <tr>
                    <th><?php esc_html_e( 'Nutrition Label', 'dokan-lite' ); ?></th>
                    <td>
                        <input type="text" name="dokan_store_nutrition" class="regular-text" value="<?php echo esc_attr( $store_settings['shop_nutrition'] ); ?>">
                    </td>
                </tr>
    
 <?php
}
