<?php
if (!defined('_PS_VERSION_'))
  exit;

define('__CENEO_TR_MODULE_PATH__', _PS_MODULE_DIR_ . DIRECTORY_SEPARATOR . 'ceneotrustedreviews' . DIRECTORY_SEPARATOR); 

require_once(__CENEO_TR_MODULE_PATH__ . 'classes'. DIRECTORY_SEPARATOR . 'Config_CTRM.php'); 
require_once(__CENEO_TR_MODULE_PATH__ . 'helpers'. DIRECTORY_SEPARATOR . 'ConfigFormHelper_CTRM.php'); 
require_once(__CENEO_TR_MODULE_PATH__ . 'helpers'. DIRECTORY_SEPARATOR . 'ProductIdsListBuilder_CTRM.php'); 
require_once(__CENEO_TR_MODULE_PATH__ . 'classes'. DIRECTORY_SEPARATOR . 'CeneoTrustedReviewsScript_CTRM.php'); 
require_once(__CENEO_TR_MODULE_PATH__ . 'helpers'. DIRECTORY_SEPARATOR . 'PrestaShopHelper_CTRM.php'); 

class CeneoTrustedReviews extends Module
{
    public function __construct()
    {        
        //hack for version 1.5
        $ps_version_max = PrestaShopHelper_CTRM::GetPSVersionBasePart(_PS_VERSION_) == '1.5' ? '1.6' : _PS_VERSION_;
        
        $this->name = 'ceneotrustedreviews';
        $this->tab = 'market_place';
        $this->version = '1.0.0';
        $this->author = 'Ceneo Sp. z o.o.';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => $ps_version_max); 
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Ceneo Trusted Reviews');
        $this->description = $this->l('Moduł integrujący program "Zaufane Opinie Ceneo" ze sklepem opartym na PrestaShop. 
                                        Bardzo prosta instalacja i konfiguracja. Program "Zaufane Opinie Ceneo" to 
                                        najpopularniejszy system rekomendacji sklepów internetowych w Polsce. 
                                        Opiera się o internetowe ankiety, które są wypełniane przez tych klientów, 
                                        którzy dokonali faktycznego zakupu w konkretnym sklepie internetowym.');

        $this->confirmUninstall = $this->l('Czy na pewno chcesz odinstalować moduł Ceneo Trusted Reviews?');
        
        $this->config_form_helper = new ConfigFormHelper_CTRM($this);
    }

    public function install()
    {
        return parent::install() && 
            $this->registerHook('displayOrderConfirmation') && 
            Configuration::updateValue(Config_CTRM::CENEO_WORK_DAYS_TO_SEND, Config_CTRM::WORK_DAYS_TO_SEND_DEFAULT);
    }
    
    public function uninstall()
    {
        return parent::uninstall() && 
            Configuration::deleteByName(Config_CTRM::CENEO_ACCOUNT_GUID) && 
            Configuration::deleteByName(Config_CTRM::CENEO_WORK_DAYS_TO_SEND);
    }
        
    public function getContent()
    {	    
        $output = $this->config_form_helper->saveData();

        return $output.$this->config_form_helper->displayForm();
    }
    
    public function hookdisplayOrderConfirmation($params)
    {
        $account_guid = Configuration::get(Config_CTRM::CENEO_ACCOUNT_GUID);
        
        if($account_guid && !empty($account_guid) && isset($params['objOrder']))
        {
           $order = $params['objOrder'];
          
           return CeneoTrustedReviewsScript_CTRM::getScript(
                            $account_guid, 
                            $order->getCustomer()->email, 
                            $order->reference, 
                            ProductIdsListBuilder_CTRM::Build($order->getProductsDetail()),
                            Configuration::get(Config_CTRM::CENEO_WORK_DAYS_TO_SEND)
            );
        }
        
        return null;
    }
}