<?php

/**
 * Prevent Direct Access
 *
 * @since 0.1
 */
defined('ABSPATH') or die("Restricted access!");

/**
 * Render Settings Page
 *
 * @since 3.2
 */
function smbtoolbar_render_submenu_page() {

	// Declare variables
    $options = get_option( 'smbtoolbar_settings' );

	// Page
	?>
	<div class="wrap">
		<h2>
            <?php _e( 'Social Media Buttons Toolbar', 'social-media-buttons-toolbar' ); ?>
            <br/>
            <span>
                <?php _e( 'by <a href="http://www.arthurgareginyan.com" target="_blank">Arthur Gareginyan</a>', 'social-media-buttons-toolbar' ); ?>
            <span/>
		</h2>

        <div id="poststuff" class="metabox-holder has-right-sidebar">

            <!-- SIDEBAR -->
            <div class="inner-sidebar">
                <div id="side-sortables" class="meta-box-sortabless ui-sortable">

                    <div id="about" class="postbox">
                        <h3 class="title"><?php _e( 'About', 'social-media-buttons-toolbar' ); ?></h3>
                        <div class="inside">
                            <p><?php _e( 'This plugin allows you to easily add the social media buttons toolbar to any place of your website.', 'social-media-buttons-toolbar' ); ?></p>
                        </div>
                    </div>

                    <div id="help" class="postbox">
                        <h3 class="title"><?php _e( 'Help', 'social-media-buttons-toolbar' ); ?></h3>
                        <div class="inside">
                            <p><?php _e( 'Got something to say? Need help?', 'social-media-buttons-toolbar' ); ?></p>
                            <p><a href="mailto:arthurgareginyan@gmail.com?subject=Social Media Buttons Toolbar">arthurgareginyan@gmail.com</a></p>
                        </div>
                    </div>

                    <div id="donate" class="postbox">
                        <h3 class="title"><?php _e( 'Donate', 'social-media-buttons-toolbar' ); ?></h3>
                        <div class="inside">
                            <p><?php _e( 'If you like this plugin and find it useful, please help me to make this plugin even better and keep it up-to-date.', 'social-media-buttons-toolbar' ); ?></p>
                            <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8A88KC7TFF6CS" target="_blank" rel="nofollow">
                                <img src="<?php echo plugins_url('../img/btn_donateCC_LG.gif', __FILE__); ?>" alt="Make a donation">
                            </a>
                            <p><?php _e( 'Thanks for your support!', 'social-media-buttons-toolbar' ); ?></p>
                        </div>
                    </div>

                    <div id="advertisement" class="postbox">
                        <h3 class="title"><?php _e( 'Advertisement', 'social-media-buttons-toolbar' ); ?></h3>
                        <div class="inside">
                            <a href="http://www.elegantthemes.com/affiliates/idevaffiliate.php?id=36439_5_1_21" target="_blank" rel="nofollow"><img style="border:0px" src="http://www.elegantthemes.com/affiliates/media/banners/divi_250x250.jpg" width="250" height="250" alt="Divi WordPress Theme"></a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END-SIDEBAR -->

            <!-- FORM -->
            <div class="has-sidebar sm-padded">
                <div id="post-body-content" class="has-sidebar-content">
                    <div class="meta-box-sortabless">

                        <form name="smbtoolbar-form" action="options.php" method="post" enctype="multipart/form-data">
                            <?php settings_fields( 'smbtoolbar_settings_group' ); ?>

                            <div class="postbox" id="Buttons">
                                <h3 class="title"><?php _e( 'Buttons', 'social-media-buttons-toolbar' ); ?></h3>
                                <div class="inside">
                                    <p class="description"><?php _e( 'Just fill in the required fields to make a buttons. The social networking buttons will lead directly to your profile pages. If you don\'t want to use any of the following buttons, you can not fill them and then they do not appear.', 'social-media-buttons-toolbar' ); ?></p>
                                    <table class="form-table">
                                        <?php smbtoolbar_media( 'facebook',
                                                                'Facebook',
                                                                'https://www.facebook.com/arthur.gareginyan',
                                                                __( 'Enter the link to your Facebook profile page', 'social-media-buttons-toolbar' ),
                                                                'hhttps://www.facebook.com'
                                        );?>
                                        <?php smbtoolbar_media(  'twitter',
                                                                'Twitter',
                                                                'https://twitter.com/AGareginyan',
                                                                __( 'Enter the link to your Twitter profile page', 'social-media-buttons-toolbar' ),
                                                                'https://twitter.com'
                                        );?>
                                        <?php smbtoolbar_media( 'instagram',
                                                                'Instagram',
                                                                'http://instagram.com/arthur_gareginyan/',
                                                                __( 'Enter the link to your Instagram profile page', 'social-media-buttons-toolbar' ),
                                                                'http://instagram.com'
                                        );?>
                                        <?php smbtoolbar_media( 'google-plus',
                                                                'Google+',
                                                                'https://plus.google.com/u/0/+ArthurGareginyan/',
                                                                __( 'Enter the link to your Google+ profile page', 'social-media-buttons-toolbar' ),
                                                                'https://plus.google.com'
                                        );?>
                                        <?php smbtoolbar_media( 'youtube',
                                                                'YouTube',
                                                                'https://www.youtube.com/channel/UCvQenE1DumnZy1k5sTvgmSA',
                                                                __( 'Enter the link to your YouTube profile page', 'social-media-buttons-toolbar' ),
                                                                'https://www.youtube.com'
                                        );?>
                                        <?php smbtoolbar_media( 'blogger',
                                                                'Blogger',
                                                                'http://oneberserk.blogspot.com',
                                                                __( 'Enter the link to your Blogger profile page', 'social-media-buttons-toolbar' ),
                                                                'https://www.blogger.com'
                                        );?>
                                        <?php smbtoolbar_media( 'livejournal',
                                                                'LiveJournal',
                                                                'http://www.livejournal.com/',
                                                                __( 'Enter the link to your LiveJournal profile page', 'social-media-buttons-toolbar' ),
                                                                'http://www.livejournal.com'
                                        );?>
                                        <?php smbtoolbar_media( 'reddit',
                                                                'Reddit',
                                                                'https://www.reddit.com/',
                                                                __( 'Enter the link to your Reddit profile page', 'social-media-buttons-toolbar' ),
                                                                'https://www.reddit.com'
                                        );?>
                                        <?php smbtoolbar_media( 'linkedin',
                                                                'LinkedIn',
                                                                'https://linkedin.com/in/arthurgareginyan',
                                                                __( 'Enter the link to your LinkedIn profile page', 'social-media-buttons-toolbar' ),
                                                                'https://linkedin.com'
                                        );?>
                                        <?php smbtoolbar_media( 'pinterest',
                                                                'Pinterest',
                                                                'https://www.pinterest.com/',
                                                                __( 'Enter the link to your Pinterest profile page', 'social-media-buttons-toolbar' ),
                                                                'https://www.pinterest.com'
                                        );?>
                                        <?php smbtoolbar_media( 'tumblr',
                                                                'Tumblr',
                                                                'https://www.tumblr.com/',
                                                                __( 'Enter the link to your Tumblr profile page', 'social-media-buttons-toolbar' ),
                                                                'https://www.tumblr.com'
                                        );?>
                                        <?php smbtoolbar_media( 'meetvibe',
                                                                'MeetVibe',
                                                                'https://meetvibe.com/',
                                                                __( 'Enter the link to your MeetVibe profile page', 'social-media-buttons-toolbar' ),
                                                                'https://meetvibe.com'
                                        );?>
                                        <?php smbtoolbar_media( 'vkontakte',
                                                                'VKontakte',
                                                                'https://vk.com/',
                                                                __( 'Enter the link to your VKontakte profile page', 'social-media-buttons-toolbar' ),
                                                                'https://vk.com'
                                        );?>
                                        <?php smbtoolbar_media( 'odnoklassniki',
                                                                'Odnoklassniki',
                                                                'https://ok.ru/',
                                                                __( 'Enter the link to your Odnoklassniki profile page', 'social-media-buttons-toolbar' ),
                                                                'https://ok.ru'
                                        );?>
                                        <?php smbtoolbar_media( 'telegram',
                                                                'Telegram',
                                                                'https://telegram.org/',
                                                                __( 'Enter the link to your Telegram profile page', 'social-media-buttons-toolbar' ),
                                                                'https://telegram.org'
                                        );?>
                                        <?php smbtoolbar_media( 'github',
                                                                'GitHub',
                                                                'https://github.com/ArthurGareginyan',
                                                                __( 'Enter the link to your GitHub profile page', 'social-media-buttons-toolbar' ),
                                                                'https://github.com'
                                        );?>
                                        <?php smbtoolbar_media( 'wordpress',
                                                                'WordPress',
                                                                'https://profiles.wordpress.org/arthur-gareginyan/',
                                                                __( 'Enter the link to your WordPress profile page', 'social-media-buttons-toolbar' ),
                                                                'https://wordpress.org'
                                        );?>
                                        <?php smbtoolbar_media( 'codepen',
                                                                'CodePen',
                                                                'http://codepen.io/berserkr/',
                                                                __( 'Enter the link to your CodePen profile page', 'social-media-buttons-toolbar' ),
                                                                'http://codepen.io'
                                        );?>
                                        <?php smbtoolbar_media( 'skype',
                                                                'Skype',
                                                                'skype:YourName?call',
                                                                __( 'Enter your Skype name with prefix <b>skype:</b> and suffix <b>?call</b>, or <b>?add</b>, or <b>?chat</b>, or <b>?userinfo</b> for view profile.', 'social-media-buttons-toolbar' ),
                                                                'https://www.skype.com'
                                        );?>
                                        <?php smbtoolbar_media( 'website',
                                                                'Personal website',
                                                                'http://www.arthurgareginyan.com',
                                                                __( 'Enter the link to your personal website', 'social-media-buttons-toolbar' ),
                                                                ''
                                        );?>
                                        <?php smbtoolbar_media( 'email',
                                                                'Email',
                                                                'mailto:arthurgareginyan@gmail.com',
                                                                __( 'Enter your email address with prefix <b>mailto:</b>', 'social-media-buttons-toolbar' ),
                                                                ''
                                        );?>
                                        <?php smbtoolbar_media( 'rss-feed',
                                                                'RSS Feed',
                                                                'http://arthurgareginyan.com/feed',
                                                                __( 'Enter the link to your RSS Feed', 'social-media-buttons-toolbar' ),
                                                                ''
                                        );?>
                                    </table>
                                    <?php submit_button( __( 'Save Changes', 'social-media-buttons-toolbar' ), 'primary', 'submit', true ); ?>
                                </div>
                            </div>

                            <div class="postbox" id="DisplayOptions">
                                <h3 class="title"><?php _e( 'Display options', 'social-media-buttons-toolbar' ); ?></h3>
                                <div class="inside">
                                    <p class="description"></p>
                                    <table class="form-table">
                                        <?php smbtoolbar_setting('show_posts',
                                                                  __( 'Show on Posts', 'social-media-buttons-toolbar' ),
                                                                  __( 'Display toolbar below content on Posts', 'social-media-buttons-toolbar' ),
                                                                  'check'
                                        );?>
                                        <?php smbtoolbar_setting('show_pages',
                                                                  __( 'Show on Pages', 'social-media-buttons-toolbar' ),
                                                                  __( 'Display toolbar below content on Pages', 'social-media-buttons-toolbar' ),
                                                                  'check'
                                        );?>
                                        <?php smbtoolbar_setting('new_tab',
                                                                  __( 'Open link in new tab/window', 'social-media-buttons-toolbar' ),
                                                                  '',
                                                                  'check'
                                        );?>
                                        <?php smbtoolbar_setting('icon-size',
                                                                  __( 'Icon size', 'social-media-buttons-toolbar' ),
                                                                  __( 'Enter the size of icons (in px) in your social media buttons toolbar.', 'social-media-buttons-toolbar' ),
                                                                  'field',
                                                                  '64',
                                                                  '2'
                                        );?>
                                        <?php smbtoolbar_setting('margin-right',
                                                                  __( 'Margin right', 'social-media-buttons-toolbar' ),
                                                                  __( 'Enter the size of space (in px) between icons in your social media buttons toolbar.', 'social-media-buttons-toolbar' ),
                                                                  'field',
                                                                  '10',
                                                                  '2'
                                        );?>
                                        <?php smbtoolbar_setting('caption',
                                                                  __( 'Caption', 'social-media-buttons-toolbar' ),
                                                                  __( 'Enter the caption to your social media buttons toolbar. It will be displays before the toolbar.', 'social-media-buttons-toolbar' ),
                                                                  'field',
                                                                  'Follow me in social media:',
                                                                  '50'
                                        );?>
                                    </table>
                                    <?php submit_button( __( 'Save Changes', 'social-media-buttons-toolbar' ), 'primary', 'submit', true ); ?>
                                </div>
                            </div>

                            <div class="postbox" id="Preview">
                                <h3 class="title"><?php _e( 'Preview', 'social-media-buttons-toolbar' ); ?></h3>
                                <div class="inside">
                                    <p class="description"><?php _e( 'Click "Save Changes" to update this preview.', 'social-media-buttons-toolbar' ); ?></p></br>
                                    <?php echo smbtoolbar_shortcode(); ?>
                                </div>
                            </div>

                            <div class="postbox" id="Using">
                                <h3 class="title"><?php _e( 'Using', 'social-media-buttons-toolbar' ); ?></h3>
                                <div class="inside">
                                    <p><?php _e( 'You have several methods for display the social media buttons toolbar (further just "toolbar") on your website. But first, fill in the required fields, then click "Save Changes".', 'social-media-buttons-toolbar' ); ?></p>
                                    <p><?php _e( '<b>A)</b> For display the toolbar below content on every Posts or/and Pages, just check the checkbox "Show on Posts" or/and "Show on Pages" in the section "Display options", then click "Save Changes". It\'s that simple!', 'social-media-buttons-toolbar' ); ?></p>
                                    <p><?php _e( '<b>B)</b> For add the toolbar inside a post from WP Post/Page Editor use the following shortcode:', 'social-media-buttons-toolbar' ); ?></p>
                                    <p><?php highlight_string('[smbtoolbar]'); ?></p>
                                    <p><?php _e( '<b>C)</b> For add the toolbar to the widget area (in sidebar, footer etc.) use the "Text" widget and add inside it the following shortcode:', 'social-media-buttons-toolbar' ); ?></p>
                                    <p><?php highlight_string('[smbtoolbar]'); ?></p>
                                    <p><?php _e( '<b>D)</b> For add the toolbar directly to a theme files, just add one of the following code (both variants do the same) to needed place (where you want to display the toolbar) in your theme files:', 'social-media-buttons-toolbar' ); ?></p>
                                    <p><?php highlight_string('<?php echo do_shortcode("[smbtoolbar]"); ?>'); ?></p>
                                    <p><?php highlight_string('<?php echo smbtoolbar_shortcode(); ?>'); ?></p>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <!-- END-FORM -->

        </div>

	</div>
	<?php
}