(function ($) {
  var CreateMetaTagsSettings = function() {
    this.$uploaders = $('.js-cmt-uploader');
  };

  CreateMetaTagsSettings.prototype.init = function() {
    if(this.$uploaders.length <= 0) return false;

    this.media = wp.media({
      title: 'Select or Upload Media Of Your Chosen Persuasion',
      button: {
        text: 'Use this media'
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    this.setEvents();
  };

  CreateMetaTagsSettings.prototype.setEvents = function() {
  };

  var createMetaTagsSettings = new CreateMetaTagsSettings();
  createMetaTagsSettings.init();
})(jQuery);