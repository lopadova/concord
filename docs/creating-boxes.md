# Creating Boxes

> Compared to Modules there's not much sense to create an in-app box, even if it's technically possible. The reason is that a Box can be considered an application boilerplate, so why define a template and immediately overwrite it? Your application is responsible for everything an in-app Box would do.

## Creating An External Box (With Git And Composer)

1. Init a git repo in an empty folder: `git init .`
2. Add composer.json:

    ```
    {
        "name": "vendor/mybox",
        "description": "My Box Rulez",
        "type": "library",
        "require": {
            "php": ">=7.0.0"
        },
        "autoload": {
            "psr-4": { "Vendor\\MyBox\\": "src/" }
        }
    }
    ```

3. Create the file `src/Providers/ModuleServiceProvider.php`:

    ```php
    namespace Vendor\MyBox\Providers;
    
    use Konekt\Concord\AbstractBoxServiceProvider;
    
    class ModuleServiceProvider extends AbstractBoxServiceProvider
    {
    }
    ```

4. Create `src/resources/manifest.php`:

    ```php
    <?php
    
    use Konekt\Concord\Module\Kind;
    
    return [
       'name'    => 'My Box',
       'version' => '1.0.0',
       'kind'    => Kind::BOX()
    ];
    ```

5. Commit all the stuff, and publish it (github and packagist if it's open source)

## Adding Modules To The Box

Boxes have their primary config file located in (`src/`)`resources/config/box.php`. Modules need to be added here:

```php
<?php

return [
    'modules' => [
        Vendor\MyModule\Providers\ModuleServiceProvider::class => [],
        Vendor\AnotherModule\Providers\ModuleServiceProvider::class => []
    ]
];
```

The empty arrays in the example mean that everything from those modules will be imported according to the defaults.

### Overriding Module Parts

#### Suppressing Migrations

```php
<?php

return [
    'modules' => [
        Vendor\MyModule\Providers\ModuleServiceProvider::class => [
            'migrations' => false    
        ],
        Vendor\AnotherModule\Providers\ModuleServiceProvider::class => [
            'migrations' => false            
        ]
    ]
];
```

## Adding A Box The An Application

1. In the laravel application: `composer require vendor/mybox`
2. Add the module to `config/concord.php`:

    ```php
    <?php
    
    return [
       'modules' => [
           Vendor\MyBox\Providers\ModuleServiceProvider::class,
       ]
    ];
    ```

#### Next: [Configuration &raquo;](configuration.md)