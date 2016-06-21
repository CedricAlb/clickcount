<?php
/**
 * @file
 * Contains \Drupal\clickcount\Entity\ClickLog.
 */

namespace Drupal\clickcount\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the ClickLog entity.
 *
 * @ingroup clickcount
 *
 * @ContentEntityType(
 *   id = "click_log",
 *   label = @Translation("Click log"),
 *   base_table = "click_log",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "job_id" = "job_id",
 *   },
 * )
 */

class ClickLog extends ContentEntityBase implements ContentEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getJob() {
    return $this->get('job_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getJobId() {
    return $this->get('job_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setJobId($job_id) {
    $this->set('job_id', $job_id);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setJob(EntityTypeInterface $entity) {
    $this->set('job_id', $entity->id());
    return $this;
  }


  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   *
   * Field name, type and size determine the table structure.
   *
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    //$fields = parent::baseFieldDefinitions($entity_type);

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
        ->setLabel(t('ID'))
        ->setDescription(t('The ID of the Click Log entity.'))
        ->setReadOnly(TRUE);

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
        ->setLabel(t('UUID'))
        ->setDescription(t('The UUID of the Click Log entity.'))
        ->setReadOnly(TRUE);

    // Entity reference field, holds the reference to the job object.
    $fields['job_id'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('Job ID'))
        ->setDescription(t('The reference to a Job entity.'))
        ->setReadOnly(TRUE)
        ->setSetting('target_type', 'node')
        ->setSetting('handler', 'job');

    $fields['created'] = BaseFieldDefinition::create('created')
        ->setLabel(t('Created'))
        ->setDescription(t('The time that the entity was created.'));

    return $fields;
  }

}
