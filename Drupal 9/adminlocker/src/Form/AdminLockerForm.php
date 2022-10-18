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
    $form['adminlocker_block'] = [
      '#type' => 'textarea',
      '#rows' => 20,
      '#title' => $this->t('AdminLocker blocked paths'),
      '#default_value' => $config->get('adminlocker.adminlocker_block'),
      '#description' => $this->t('URLs that should be blocked for admins. Enter one path per line. Paths start with `/`.'),
    ];

    // Source text field.
    $form['adminlocker_allow'] = [
      '#type' => 'textarea',
      '#rows' => 20,
      '#title' => $this->t('AdminLocker allowed paths'),
      '#default_value' => $config->get('adminlocker.adminlocker_allow'),
      '#description' => $this->t('URLs that should be allowed for admins. These paths override blocked paths. Enter one path per line. Paths start with `/`.'),
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
    $config->set('adminlocker.adminlocker_block', $form_state->getValue('adminlocker_block'));
    $config->set('adminlocker.adminlocker_allow', $form_state->getValue('adminlocker_allow'));
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