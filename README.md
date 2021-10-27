# Magento 2: Dara Ribbons Module 
This module will help you display a ribbo either on home page or all pages according to the conditions set in the backoffice.

## Installation without composer
1. Create directory  `app/code/Dara/` folder.
2. Copy all items to dara folder you created.
3. Run 

```bash
cd <magento_root>
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:clean 
php bin/magento cache:flush 
```
## Settings
1. Create a ribbon form the admin dashboard:Go To, Dara Extensions->Manage Ribbons->Add New Ribbon
2. Schedule your ribbon by specifying the start and end date
3. Enter title, description, color, link and pages to display.
4. Open you store fornt and see if the ribbon is visible on the specified page.