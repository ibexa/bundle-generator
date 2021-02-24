# Ibexa Bundle Generator

Symfony Bundle generator for Ibexa DXP based projects.

## Using generator as standalone application

Bundle generator could be used in standalone application mode. Minimal usage is:

```
$ php ./ibexa-bundle-generator video-editor  
```

You will be asked about the following parameters:

* package name e.g `video-editor`
* vendor name e.g. `ibexa`
* bundle name e.g. `VideoEditor`
* vendor namespace e.g. `Ibexa`
* skeleton name e.g. `ibexa-ee`

Package structure will be generated into `./target` directory.

Usage with all available options:

```
$ php ./ibexa-bundle-generator video-editor  video-editor-dir  --vendor-name=ibexa --vendor-namespace=Ibexa --bundle-name=VideoEditor  --skeleton-name=ibexa-ee
```

### Full synopsis

```
Usage:
  generate-bundle [options] [--] [<package-name> [<target-dir>]]

Arguments:
  package-name                             Package name e.g page-builder
  target-dir                               Target directory [default: "target"]

Options:
      --vendor-name=VENDOR-NAME            Package vendor name e.g. ibexa
      --vendor-namespace=VENDOR-NAMESPACE  e.g. Ibexa
      --bundle-name=BUNDLE-NAME            e.g. IbexaPageBuilder
      --skeleton-name=SKELETON-NAME        Skeleton name
  -h, --help                               Display help for the given command. When no command is given display help for the generate-bundle command
  -q, --quiet                              Do not output any message
  -V, --version                            Display this application version
      --ansi                               Force ANSI output
      --no-ansi                            Disable ANSI output
  -n, --no-interaction                     Do not ask any interactive question
  -v|vv|vvv, --verbose                     Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

## COPYRIGHT

Copyright (C) 1999-2021 Ibexa AS (formerly eZ Systems AS). All rights reserved.

## LICENSE

This source code is available separately under the following licenses:

A - Ibexa Business Use License Agreement (Ibexa BUL),  
version 2.3 or later versions (as license terms may be updated from time to time)  
Ibexa BUL is granted by having a valid Ibexa DXP (formerly eZ Platform Enterprise) subscription,  
as described at: https://www.ibexa.co/product  
For the full Ibexa BUL license text, please see:  
https://www.ibexa.co/software-information/licenses-and-agreements (latest version applies)

AND

B - GNU General Public License, version 2  
Grants an copyleft open source license with ABSOLUTELY NO WARRANTY. For the full GPL license text, please see:  
https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
