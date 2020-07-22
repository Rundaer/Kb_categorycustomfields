# Kb_categorycustomfields

### Requirements

1. Composer, see [Composer](https://getcomposer.org/) to learn more

### How to install

1. Put all content inside `modules/kb_categorycustomfields`.'
2. `cd` into module's directory and run following commands:
    - `composer dumpautoload` to generate autoloader for module
3. Go to install module.
4. Clean cache in the admin area `Advanced Parameters / Performance`.

### What it does

Module adds extra custom field to category page

Now you can use `$category->seo_text`(seo_text it's just mine field value, place any as you would like)

### Warning

If override class does not work, place it in root/override folder

### Thanks to

Thanks to
- https://github.com/friends-of-presta/demo-cqrs-hooks-usage-module
- https://github.com/frederic-benoist/fbsample-extracustomerfield
- https://github.com/wfpaisa/prestashop-custom-field