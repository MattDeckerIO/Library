<?php

/**
 * @file
 * Contains Drupal\adminlocker\Form\AdminLockerForm.
 */

namespace Drupal\adminlocker\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AdminLockerForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'adminlocker_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('adminlocker.settings');

    // Source text field.
    $form['adminlocker_settings'] = [
      '#type' => 'textarea',
      '#rows' => 20,
      '#title' => $this->t('AdminLocker settings'),
      '#default_value' => $config->get('adminlocker.adminlocker_settings'),
      '#description' => $this->t('URLs that should be blocked for non-admins. Enter one path per line. Paths start with `/`.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('adminlocker.settings');
    $config->set('adminlocker.adminlocker_settings', $form_state->getValue('adminlocker_settings'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'adminlocker.settings',
    ];
  }

}