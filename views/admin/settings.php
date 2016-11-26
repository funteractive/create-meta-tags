<div class="wrap">
  <h1><?php echo _('メタタグ設定'); ?></h1>
  <h2><?php echo _('デフォルト設定'); ?></h2>
  <div class="wrap-inner">
    <form action="" method="post">
      <table class="form-table">
        <tbody>
        <tr>
          <th>
            <?php echo _('keywords'); ?>
          </th>
          <td>
            <textarea name="" id="" cols="30" rows="3"></textarea>
            <p class="description"><?php echo _('meta keywordsのデフォルト値に使われます。'); ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo _('description'); ?>
          </th>
          <td>
            <fieldset>
              <label for="cmt-description-catchphrase">
                <input type="checkbox" name="" id="cmt-description-catchphrase" value="1">
                <?php echo _('キャッチフレーズを使う'); ?>
              </label>
            </fieldset>
            <textarea name="" id="" cols="30" rows="3"></textarea>
            <p class="description"><?php echo _('meta description, og:description, twitter:descriptionのデフォルト値に使われます。'); ?></p>
          </td>
        </tr>
        <tr>
          <th>
            <?php echo _('image'); ?>
          </th>
          <td>
            <div class="placeholder">画像未設定</div>
            <div class="alignright">
              <button type="button" class="button new" id="header_image-button">新規画像を追加</button>
            </div>
            <p class="description"><?php echo _('og:image, twitter:imageのデフォルト値に使われます。'); ?></p>
          </td>
        </tr>
        </tbody>
      </table>
      <p class="submit">
        <input type="submit" id="submit" name="submit" class="button button-primary" value="変更を保存">
      </p>
    </form>
  </div>
</div>
