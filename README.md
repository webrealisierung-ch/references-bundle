# References Bundle for Contao Open Source CMS

This bundle adds functionality to manage references to the Contao Open Source Content Management System.

## Attention

**Breaking changes in the dev-master branch are possible. Do not use it in production!**

This bundle is currently under development. You can use it at your own risk! A stable version will be available soon. Of course you can submit issues and feature requests on the [repository issue section](https://github.com/webrealisierung-ch/wr_references_filter/issues). Thx! 

## Installation

### Contao Managed Edition

**Without the awesome Contao Manager**

Run in your project folder the following Composer command to add the References Bundle to your project:

```console
    composer require wr/references-bundle
```

Clear the cache and warmup the cache with the following two commands:

```console
    vendor/bin/contao-console cache:clear --no-warmup
    vendor/bin/contao-console cache:warmup
```

Go to the install tool and update the database. Then login into the back end.

**With the awesome Contao Manager**

1. Search in the Contao Manager search bar the bundle `wr/references-bundle` and click on the install button.
2. Go to the install tool and update the database. Then login into the back end.


## Dependencies

- `php ^7.0`
- `symfony/symfony ^3.3`
- `contao/core-bundle ^4.4`

## Licence

The References Bundle is published under the LGPLv3.

## Documentation

Unfortunately, at the moment there is no documentation available. But we will fix this as soon as there is a stable version.
 
 ## Contact
 
 For further information feel free and get in contact with us: mail@webrealisierung.ch
 
 ## Donation
 
 If you like our work feel free to donate.
 
 There are many ways to donate to the project. The following list contains some possibilities:
 
 - Contribute your code over pull requests.
 - Test, test, test and feedback.
 - Submit features or issues.
 - Tell us a joke.
 - [![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EHB7BYWLMPV7Y) You know that every coffee counts while coding:-)


