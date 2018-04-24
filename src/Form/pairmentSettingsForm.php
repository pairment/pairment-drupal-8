<?php

namespace Drupal\pairment\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure pairment settings for this site.
 */
class pairmentSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pairment_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'pairment.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('pairment.settings');

    $form['public_id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Public site ID'),
      '#default_value' => $config->get('public_id'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

       $this->configFactory->getEditable('pairment.settings')
      ->set('public_id', $form_state->getValue('public_id'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
