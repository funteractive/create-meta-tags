<div class="wrap">
  <h1><?php echo _('メタタグ設定'); ?></h1>
  <h2><?php echo _('デフォルト設定'); ?></h2>
  <div class="wrap-inner">
    <form action="options.php" method="post">
      <?php settings_fields(CREATE_META_TAGS_TEXT_DOMAIN); ?>
      <table class="form-table">
        <tbody>
        <tr>
          <th>
            <?php echo _('keywords'); ?>
          </th>
          <td>
            <textarea name="create_meta_tags_keywords" cols="30" rows="3"><?php echo get_option('create_meta_tags_keywords'); ?></textarea>
            <p class="description"><?php echo _('meta keywordsのデフォルト値に使われます。'); ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo _('description'); ?>
          </th>
          <td>
            <fieldset>
              <label for="create_meta_tags_use_blogdescription">
                <input type="checkbox" name="create_meta_tags_use_blogdescription[]" id="create_meta_tags_use_blogdescription" value="1"<?php if(get_option('create_meta_tags_use_blogdescription')) echo ' checked'; ?>>
                <?php echo _('キャッチフレーズを使う'); ?>
              </label>
            </fieldset>
            <textarea name="create_meta_tags_description" cols="30" rows="3"><?php echo get_option('create_meta_tags_description'); ?></textarea>
            <p class="description"><?php echo _('meta description, og:description, twitter:descriptionのデフォルト値に使われます。'); ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo _('image'); ?>
          </th>
          <td>
            <div class="placeholder">画像未設定</div>
            <input type="hidden" name="create_meta_tags_image" value="<?php echo get_option('create_meta_tags_image'); ?>">
            <p class="inner" style="text-align: right;">
              <button type="button" class="button new" id="header_image-button">新規画像を追加</button>
            </p>
            <p class="description"><?php echo _('og:image, twitter:imageのデフォルト値に使われます。'); ?></p>
          </td>
        </tr>
        </tbody>
      </table>
      <?php do_settings_sections(CREATE_META_TAGS_TEXT_DOMAIN); ?>
      <?php submit_button(); ?>
    </form>
  </div>
</div>
