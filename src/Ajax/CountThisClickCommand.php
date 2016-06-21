<?php

namespace Drupal\clickcount\Ajax;

use Drupal\clickcount\Entity\ClickLog;
use Drupal\Core\Ajax\CommandInterface;
use Drupal\node\Entity\Node;

class CountThisClickCommand implements CommandInterface {

  protected $job_id;

  // Constructs a CountThisClickCommand object.
  public function __construct($job_id) {
    $this->job_id = $job_id;
  }

  // Implements Drupal\Core\Ajax\CommandInterface:render().
  public function render() {
    // Log the click in the database
    $clicklog = ClickLog::create(array(
      'job_id' => $this->job_id,
    ));
    $clicklog->save();

    //The only required key in the returned associative array is ‘command’, the value of which is the name of a
    // javascript function to be invoked on the client side. All other elements returned to the array will be passed as
    // part of the data argument sent to the javascript function.
    return array(
      'command' => 'countThisClick',
      'job_id' => $this->job_id,
    );
  }

}
