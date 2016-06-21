(function ($) {
  "use strict";
  Drupal.behaviors.hideInfosShowButton = {
    attach: function (context) {

      $('#clickcount').each(function () {
        $(this).css('display', 'inline-block');
        $('.field-section-contact, .field-precisions, .field-personne-a-contacter, .field-adresse, .field-telephone, .field-email, .field-date-limite').hide();
        $(this).click(function () {
          $(this).hide();
          $('.field-section-contact, .field-precisions, .field-personne-a-contacter, .field-adresse, .field-telephone, .field-email, .field-date-limite').show();
        });
      });

    }
  };

})(jQuery);

