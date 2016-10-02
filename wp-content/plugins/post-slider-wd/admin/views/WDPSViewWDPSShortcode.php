<?php

class WDPSViewWDPSShortcode {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;


  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display() {
    $rows = $this->model->get_row_data();
    wp_print_scripts('jquery');
    ?>
    <link rel="stylesheet" href="<?php echo site_url(); ?>/wp-includes/js/tinymce/<?php echo ((get_bloginfo('version') < '3.8') ? 'themes/advanced/skins/wp_theme' : 'plugins/compat3x/css'); ?>/dialog.css" />
    <div class="tabs" role="tablist" tabindex="-1">
      <ul>
        <li id="display_tab" class="current" role="tab" tabindex="0">
          <span>
            <a href="javascript:mcTabs.displayTab('display_tab','display_panel');" onMouseDown="return false;" tabindex="-1"><?php echo __('Post Slider WD','wdps_back'); ?></a>
          </span>
        </li>
      </ul>
    </div>
    <div class="panel_wrapper">
      <div id="display_panel" class="panel current" style="height: 90px !important;">
        <table>
          <tr>
            <td style="vertical-align: middle; text-align: left;"><?php echo __('Select a Slider','wdps_back'); ?></td>
            <td style="vertical-align: middle; text-align: left;">
              <select name="wdps_id" id="wdps_id" style="width: 230px; text-align: left;">
                <option value="0" selected="selected"><?php echo __('- Select a Slider -','wdps_back'); ?></option>
                <?php
                foreach ($rows as $row) {
                  ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                  <?php
                }
                ?>
              </select>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="mceActionPanel">
      <div style="float: left;">
        <input type="button" id="cancel" name="cancel" value="Cancel" onClick="window.parent.tb_remove();" />
      </div>
      <div style="float: right;">
        <input type="submit" id="insert" name="insert" value="Insert" onClick="wdps_insert_shortcode();" />
      </div>
    </div>
    <script type="text/javascript">
      function wdps_insert_shortcode() {
        if (document.getElementById("wdps_id").value) {
          window.parent.send_to_editor('[wdps id="' + document.getElementById('wdps_id').value + '"]');
        }
        window.parent.tb_remove();
      }
    </script>
    <?php
    die();
  }

  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}