(function($, Drupal) {
  /**
   * Add new command for logging a click.
   */
  Drupal.AjaxCommands.prototype.countThisClick = function(ajax, response, status){
    // This command do nothing because user don't need any visual animation
    // as the display of the information is done immediatelly by hideinfo_showbutton.js

    // display a success message
    //$('.field-section-contact').once().after('<h3 style="color:green">YES CA MARCHE !!!</h3>'+response.job_id)
  }
})(jQuery, Drupal);
