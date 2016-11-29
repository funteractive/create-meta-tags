(function ($) {
  var CreateMetaTagsSettings = function() {
  };

  CreateMetaTagsSettings.prototype.init = function() {
    var self = this;
    var $imageHidden = $('#js-cmt-image-hidden');
    var useTagLine = $('#create_meta_tags_use_tag_line').prop('checked');
    var imageId = $imageHidden.data('id');
    var imageSrc = $imageHidden.data('src');

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
        },
        removeMedia: function(evt) {
          evt.preventDefault();
          Vue.set(self.vue, 'imageId', 0);
          Vue.set(self.vue, 'imageSrc', '');
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
          Vue.set(self.vue, 'imageId', file.id);
          Vue.set(self.vue, 'imageSrc', file.attributes.url);
        });
      }
    });
  };

  var createMetaTagsSettings = new CreateMetaTagsSettings();
  createMetaTagsSettings.init();
})(jQuery);