<?php

class ConfigFormHelper_CTRM
{
    const TRUSTED_REVIEWS_FORM_NAME = 'submit_ceneo_trustedreviews';

    private $module;

    public function __construct($module)
    {
        $this->module = $module;
    }
   
    public function saveData()
    {
        $output = null;

        if (Tools::isSubmit(self::TRUSTED_REVIEWS_FORM_NAME))
        {
            $account_guid = strval(Tools::getValue(Config_CTRM::CENEO_ACCOUNT_GUID));

            if (!$account_guid  || empty($account_guid))
            {
                $output .= $this->module->displayError('GUID nie może być pusty');
            }
            else
            {
                Configuration::updateValue(Config_CTRM::CENEO_ACCOUNT_GUID, $account_guid);
                Configuration::updateValue(Config_CTRM::CENEO_WORK_DAYS_TO_SEND, 
                    strval(Tools::getValue(Config_CTRM::CENEO_WORK_DAYS_TO_SEND)));

                $output .= $this->module->displayConfirmation('Zmiany zostały zapisane');
            }
        }
        
        return $output;
    }

    public function displayForm()
    {
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => 'Konfiguracja skryptu Zaufanych Opinii',
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => 'GUID',
                    'name' => Config_CTRM::CENEO_ACCOUNT_GUID,
                    'size' => '25',
                    'required' => true
                ),
                array(
                    'type' => 'select',
                    'label' => 'Liczba dni roboczych do wysyłki ankiety',
                    'name' => Config_CTRM::CENEO_WORK_DAYS_TO_SEND,
                    'required' => true,
                    'options' => $this->GenerateWorkDaysToSendOptions()
                )
            ),
            'submit' => array(
                'title' => $this->module->l('Save'),
                'cass' => 'button',
            )
        );
        
        $helper = $this->CreateHelperForm(self::TRUSTED_REVIEWS_FORM_NAME);

        $helper->fields_value[Config_CTRM::CENEO_ACCOUNT_GUID] = Configuration::get(Config_CTRM::CENEO_ACCOUNT_GUID);
        $helper->fields_value[Config_CTRM::CENEO_WORK_DAYS_TO_SEND] = Configuration::get(Config_CTRM::CENEO_WORK_DAYS_TO_SEND);

        return $helper->generateForm($fields_form);
    }

    private function CreateHelperForm($submit_action)
    {
        $helper = new HelperForm();
        
        $helper->module = $this->module;
        $helper->name_controller = $this->module->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->module->name;
        
        $helper->title = $this->module->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = $submit_action;
        
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->module->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->module->name.'&save'.$this->module->name
                    . '&token='.Tools::getAdminTokenLite('AdminModules'),
            )
        );

        return $helper;
    }

    public function GenerateWorkDaysToSendOptions()
    {
        $workdays = array();

        for($i= 0; $i <= 21; $i++)
        {
            $workdays[] = array(
                'id_option' => $i,    
                'name'      => $i 
            );
        }

        return array(
            'query' => $workdays,
            'id'    => 'id_option', 
            'name'  => 'name'
        );
    }
}