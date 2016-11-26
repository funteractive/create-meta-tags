(function ($) {
  var CreateMetaTagsSettings = function() {
  };

  CreateMetaTagsSettings.prototype.init = function() {
    var self = this;
    var useTagLine = $('#create_meta_tags_use_tag_line').prop('checked');
    var imageId = 0;
    var imageSrc = '';

    this.vue = new Vue({
      el: '#js-cmt-settings',
      data: {
        useTagLine: useTagLine,
        imageId: imageId,
        imageSrc: imageSrc
      },
      methods: {
        openMedia: function(evt) {
          evt.preventDefault();
          self.uploader.open();
        }
      }
    });

    this.uploader = wp.media({
      title: 'Select or Upload Media Of Your Chosen Persuasion',
      button: {
        text: 'Use this media'
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    this.setEvents();
  };

  CreateMetaTagsSettings.prototype.setEvents = function() {
    var self = this;
    this.uploader.on('select', function() {
      var images = self.uploader.state().get('selection');
      if(images) {
        images.each(function(file) {
          self.vue.$set('imageId', file.id);
          // apiを叩いて画像srcを取得
        });
      }
    });
  };

  var createMetaTagsSettings = new CreateMetaTagsSettings();
  createMetaTagsSettings.init();
})(jQuery);