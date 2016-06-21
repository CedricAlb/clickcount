<?php

namespace Drupal\clickcount\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Component\Datetime\DateTimePlus;

/**
 * Controller routines for clickcount report route.
 */
class ClickcountReportController extends ControllerBase {

    /**
     * The Database Connection
     *
     * @var \Drupal\Core\Database\Connection
     */
    protected $dbConnection;

    /**
     * CountclickReportController constructor.
     *
     * @param \Drupal\Core\Database\Connection $connection
     *   The database connection.
     */
    public function __construct(Connection $connection) {
        $this->dbConnection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('database')
        );
    }

    /**
     * Returns a statistics page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function report() {
        // Query the database on the 12 last months and group by month
        $sql  = "SELECT MONTH(FROM_UNIXTIME(cl.`created`)) AS mois , YEAR(FROM_UNIXTIME(cl.`created`)) AS annee, COUNT(*) AS nb_clics\n";
        $sql .= "FROM {click_log} cl\n";
        $sql .= "WHERE FROM_UNIXTIME(cl.`created`) > DATE_ADD(CURDATE(), INTERVAL -12 MONTH)\n";
        $sql .= "GROUP BY mois, annee\n";
        $sql .= "ORDER BY annee, mois DESC\n";
        $results = $this->dbConnection->query($sql)->fetchAll();

        $rows = array();
        foreach ($results as $row) {
            $dateObj = DateTimePlus::createFromFormat('m', $row->mois);
            $row->mois = t($dateObj->format('F'));
            $rows[] = array('data' => (array) $row);
        }

        // Build the table for the nice output.
        $header = array(
            array('data' => t('Month')),
            array('data' => t('Year')),
            array('data' => t('Click count')),
        );
        $build = array(
            '#markup' => '<p>' . t('This table provide the number of clicks on the "Apply" button per month for the last 12 months.') . '</p>',
        );
        $build['table'] = array(
            '#theme' => 'table',
            '#header' => $header,
            '#rows' => $rows,
        );

        return $build;
    }

}
