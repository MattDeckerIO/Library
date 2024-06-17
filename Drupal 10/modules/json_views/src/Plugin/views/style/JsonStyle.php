<?php

namespace Drupal\json_views\Plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render views results in JSON.
 *
 * @ViewsStyle(
 *   id = "json",
 *   title = @Translation("JSON"),
 *   help = @Translation("Render the views output as JSON."),
 *   theme = "views_view_json",
 *   display_types = {"normal"}
 * )
 */
class JsonStyle extends StylePluginBase {

  /**
   * Does the style plugin support grouping?
   *
   * @var bool
   */
  protected $usesGrouping = FALSE;

  /**
   * Does the style plugin support fields?
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  public function render() {
    $rows = [];

    foreach ($this->view->result as $row) {
        $entity = $row->_entity;

        if (!$entity) { return; }
        $field_data = $entity->getData();
        if (!$field_data) { return; }

        $rendered_row = $this->renderFields($field_data);
        if (!empty($rendered_row)) {
            $rows[] = $rendered_row;
        } else {
            // Debugging: log or print when a row has no rendered fields.
            \Drupal::logger('json_views')->debug('No fields rendered for row: @row', ['@row' => print_r($row, TRUE)]);
        }
    }

    $output = json_encode($rows, JSON_PRETTY_PRINT);
    return [
      '#type' => 'markup',
      // '#markup' => $output,
      '#theme' => 'views_view_json',
      '#view' => $this->view,
      '#rows' => $output,
      '#cache' => [
        'max-age' => 0,
      ],
      '#headers' => [
        'Content-Type' => 'application/json',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function renderFields(array $field_data) { 
    $fields = [];

    foreach ($field_data as $field_name => $field_value) {
      $fields[$field_name] = $field_value;
    }
    return $fields;
  }
}