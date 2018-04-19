# Ceneo Trusted Reviews PrestaShop module

Ceneo Trusted Reviews PrestaShop module allows you to easily embed the Ceneo Trusted Reviews Script in a PrestaShop store.

## Documentation links

* [Ceneo Trusted Reviews PrestaShop module installation documentation (in Polish)](https://www.ceneo.pl/poradniki/Podrecznik-integracji-ZO-prestashop)
* [Ceneo Trusted Reviews Script documentation (in Polish)](https://shops.ceneo.pl/documents/InstrukcjaInstalacjiMarkeraZO_v1_2.pdf)
* [PrestaShop documentation for developers](https://developers.prestashop.com/)

## Developers guide
### How does it work?

Ceneo Trusted Reviews module injects Ceneo Trusted Reviews Script into ***PrestaShop store order confirmation page*** using ***hookdisplayOrderConfirmation*** method.

### Module constraints
* It's dedicated to 1.5.x.x and 1.6.x.x versions of PrestaShop
* Currently supports only Polish language

### Coding conventions
All module class are marked with **"_CTRM"** suffix to easily distinguish Ceneo Trusted Reviews module classes from others.

### Module classes description
* ***ceneotrustedreviews.php*** - main module class

* ***classes/CeneoTrustedReviewsScript_CTRM.php*** - responsible for generating and returning Ceneo Trusted Reviews script content
* ***classes/Config_CTRM.php*** - stores configuration key names, that will be saved in the configuration data table

* ***helpers/ConfigFormHelper_CTRM.php*** - helper methods for Ceneo Trusted Reviews configuration form
* ***helpers/PrestaShopHelper_CTRM.php*** - helper methods connected stricly with PrestaShop engine
* ***helpers/ProductIdsListBuilder_CTRM.php*** - builds product ids string from order products for Ceneo Trusted Reviews script 

* ***tests*** - unit tests for module classes
