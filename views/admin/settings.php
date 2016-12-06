<?php
$use_tag_line = get_option('create_meta_tags_use_tag_line') ? 1 : 0;
$image_id = get_option('create_meta_tags_image');
if($image_id) {
  $src = wp_get_attachment_image_src($image_id, 'full');
  if($src) {
    $image_src = current($src);
  }
}
?>
<div class="wrap">
  <h1><?php echo __('Create Meta Tags Settings', CREATE_META_TAGS_TEXT_DOMAIN); ?></h1>
  <h2><?php echo __('General Settings', CREATE_META_TAGS_TEXT_DOMAIN); ?></h2>
  <div class="wrap-inner">
    <form action="options.php" method="post" id="js-cmt-settings" data-use-tagline="<?php echo $use_tag_line; ?>" data-image-id="<?php if($image_id) echo esc_html($image_id); ?>" data-image-src="<?php if(isset($image_src)) echo esc_url($image_src); ?>">
      <?php settings_fields(CREATE_META_TAGS_TEXT_DOMAIN); ?>
      <table class="form-table">
        <tbody>
        <tr>
          <th>
            <?php echo __('Facebook App ID', CREATE_META_TAGS_TEXT_DOMAIN); ?>
          </th>
          <td>
            <input type="text" class="regular-text" name="create_meta_tags_facebook_app_id" value="<?php echo get_option('create_meta_tags_facebook_app_id'); ?>">
            <p class="description"><?php echo __('OGP will not be displayed if there is no input.', CREATE_META_TAGS_TEXT_DOMAIN); ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo __('Twitter Site', CREATE_META_TAGS_TEXT_DOMAIN); ?>
          </th>
          <td>
            <input type="text" class="regular-text" name="create_meta_tags_twitter_site" value="<?php echo get_option('create_meta_tags_twitter_site'); ?>">
            <p class="description">
              <?php echo __('Twitter Cards will not be displayed if there is no input.', CREATE_META_TAGS_TEXT_DOMAIN); ?><br>
              <a href="https://dev.twitter.com/cards/getting-started#card-and-content-attribution" target="_blank">
                <?php echo __('See twitter:cards in detail.', CREATE_META_TAGS_TEXT_DOMAIN); ?>
              </a>
            </p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo __('Keywords', CREATE_META_TAGS_TEXT_DOMAIN); ?>
          </th>
          <td>
            <textarea name="create_meta_tags_keywords" cols="30" rows="3"><?php echo get_option('create_meta_tags_keywords'); ?></textarea>
            <p class="description"><?php echo __('It is used as the default value of meta keywords.', CREATE_META_TAGS_TEXT_DOMAIN); ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo __('Description', CREATE_META_TAGS_TEXT_DOMAIN); ?>
          </th>
          <td>
            <fieldset>
              <label for="create_meta_tags_use_tag_line">
                <input v-model="useTagLine" type="checkbox" name="create_meta_tags_use_tag_line[]" id="create_meta_tags_use_tag_line" value="1">
                <?php echo __('Use Tagline', CREATE_META_TAGS_TEXT_DOMAIN); ?>
              </label>
            </fieldset>
            <textarea name="create_meta_tags_description" cols="30" rows="3" v-bind:disabled="useTagLine"><?php echo get_option('create_meta_tags_description'); ?></textarea>
            <p class="description">
              <?php echo __('It is used as the default value of meta description, og:description and twitter:description.', CREATE_META_TAGS_TEXT_DOMAIN); ?>
            </p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo __('Image', CREATE_META_TAGS_TEXT_DOMAIN); ?>
          </th>
          <td>
            <div v-if="imageSrc" class="inner">
              <img v-bind:src="imageSrc" alt="" style="max-width: 100%; height: auto;">
            </div>
            <div v-else class="placeholder">
              <template><?php echo __('Image not set', CREATE_META_TAGS_TEXT_DOMAIN); ?></template>
            </div>
            <input type="hidden" name="create_meta_tags_image" id="js-cmt-image-hidden" :value="imageId">
            <p class="inner" style="text-align: right;">
              <button type="button" class="button" v-on:click="removeMedia" v-if="imageId">
                <?php echo __('Remove', CREATE_META_TAGS_TEXT_DOMAIN); ?>
              </button>
              <button type="button" class="button" v-on:click="openMedia">
                <?php echo __('Select Image', CREATE_META_TAGS_TEXT_DOMAIN); ?>
              </button>
            </p>
            <p class="description"><?php echo __('It is used as the default value of og:image and twitter:image.', CREATE_META_TAGS_TEXT_DOMAIN); ?></p>
          </td>
        </tr>
        </tbody>
      </table>
      <?php do_settings_sections(CREATE_META_TAGS_TEXT_DOMAIN); ?>
      <?php submit_button(); ?>
    </form>
  </div>
</div>
