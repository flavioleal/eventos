/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 1.8.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.8/admin/
*/
var handleBootstrapWizardsValidation = function() {
    "use strict";
    $("#wizard").bwizard({
        validating: function(e, t) {
            if (t.index == 0) {
                if (false === $('form[name="form-wizard"]').parsley().validate("wizard-step-1")) {
                    return false
                }else{
                    var $form = $('.wizard-step-1 form');
                    $form.trigger('submit');
                }
            } else if (t.index == 1) {
                if (false === $('form[name="form-wizard"]').parsley().validate("wizard-step-2")) {
                    return false
                }
            } else if (t.index == 2) {
                if (false === $('form[name="form-wizard"]').parsley().validate("wizard-step-3")) {
                    return false
                } else {
                    $('.wizard-step-3 form').trigger('submit');
                }
            }
        }
    });
};
var FormWizardValidation = function() {
    "use strict";
    return {
        init: function() {
            handleBootstrapWizardsValidation()
        }
    }
}()