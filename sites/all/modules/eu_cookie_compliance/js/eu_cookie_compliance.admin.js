(function ($) {
  'use strict';

  $(function () {
    $('#edit-eu-cookie-compliance-use-bare-css').click(eu_cookie_compliance_admin_bare_css);
    eu_cookie_compliance_admin_bare_css();
  });

  function eu_cookie_compliance_admin_bare_css() {
    var $form_selectors = $('.form-item-eu-cookie-compliance-popup-text-hex, .form-item-eu-cookie-compliance-popup-bg-hex, .form-item-eu-cookie-compliance-popup-height, .form-item-eu-cookie-compliance-popup-width');
    if ($('#edit-eu-cookie-compliance-use-bare-css').is(':checked')) {
      $form_selectors.hide();
    }
    else {
      $form_selectors.show();
    }
  };

})(jQuery);
