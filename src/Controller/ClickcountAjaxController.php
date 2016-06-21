<?php
/**
 * @file
 * Contains \Drupal\clickcount\Controller\ClickcountController.
 */

namespace Drupal\clickcount\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\clickcount\Ajax\CountThisClickCommand;
use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class ClickcountAjaxController extends ControllerBase {
  
  /**
   * AJAX Callback to log +1 click in database.
   *
   * @param $job_id
   *    A reference to a node of the type 'job'
   *
   * @return AjaxResponse
   *    An ajax response.
   */
  public function countThisClickCallback($job_id) {
   // Create AJAX Response object.
    $response = new AjaxResponse();
    // Call the countThisClick javascript function.
    $response->addCommand(new CountThisClickCommand($job_id));
    // Return ajax response.
    return $response;
  }

}