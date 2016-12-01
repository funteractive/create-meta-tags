(function ($) {
  var CreateMetaTagsSettings = function() {
    this.$settings = $('#js-cmt-settings');
  };

  CreateMetaTagsSettings.prototype.init = function() {
    if(this.$settings.length <= 0) return false;
    var self = this;
    var useTagLine = Boolean(this.$settings.data('useTagline'));
    var imageId = this.$settings.data('imageId');
    var imageSrc = this.$settings.data('imageSrc');

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