# Neos CMS SCSS Parser

A Neos CMS plugin to compile SCSS for Neos CMS

## Installation

The NeosRulez.ScssParser package is listed on packagist (https://packagist.org/packages/neosrulez/scssparser) - therefore you don't have to include the package in your "repositories" entry any more.

Just add the following line to your require section:

```
"neosrulez/scssparser": "*"
```

And the run this command to fetch the plugin:

```
composer update
```

## Fusion

In your site package Fusion file you can add the .scss files to compile

```
prototype(Neos.Neos:Page) {
    head {
        yourcss1 = NeosRulez.ScssParser:ScssFile
        yourcss1 {
            source = 'resource://Your.Site/Private/Styles/app.scss'
            inline = FALSE
            format = 'compressed'
            #format = 'expanded'
            #format = 'nested'
            #format = 'compact'
            #format = 'crunched'
            # You need outputFolder only if inline = FALSE
            outputFolder = 'resource://Your.Site/Public/Styles/'
        }

        yourcss2 = NeosRulez.ScssParser:ScssFile
        yourcss2 {
            source = 'resource://Your.Site/Private/Styles/test.scss'
            inline = FALSE
            format = 'compressed'
            #format = 'expanded'
            #format = 'nested'
            #format = 'compact'
            #format = 'crunched'
            # You need outputFolder only if inline = FALSE
            outputFolder = 'resource://Your.Site/Public/Styles/'
        }
    }
}
```

## Author

* E-Mail: mail@patriceckhart.com 
* URL: http://www.patriceckhart.com 