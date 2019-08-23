Barcelona en Comu - Civi CRM API Instructions
=========

We must put this in the settings.php or secret.settings.php:

```
$conf['civicrm_api'] = array(
  'endpoint' => 'API_ENDPOINT_URI',
  'apikey' => 'API_USER_KEY',
  'key' => 'API_SECRET_KEY',
);
$conf['civicrm_form_ids'] = array(
  'contacte_form' => 'CONTACTE_FORM_ID',
  'participa_form' => 'PARTICIPA_FORM_ID',
  'butlletins_form' => 'BUTLLETINS_FORM_ID',
);
```
