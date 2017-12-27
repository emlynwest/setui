# SetUI

[![Latest Version](https://img.shields.io/packagist/v/stevewest/setui.svg?style=flat-square)](https://packagist.org/packages/stevewest/setui)

Module to provide basic user interfaces for FuelPHP's nested sets model.

# Install instructions

Just run `composer require emlynwest/setui`.

Or

Add the following to your `composer.json`:

```json
{
    "require": {
        "stevewest/setui": "dev-master"
    },
}
```

Then just run a `composer update`!

After that all you will need to do is enable the module in your FuelPHP application's config file.

## Custom module location

If your application uses a non-standard module location then you can add the below
to your `composer.json` to ensure the module is installed in the correct place.
(Make sure you keep the `{$name}`.)

```json
{
    "extra": {
        "installer-paths": {
            "my/custom/path/{$name}": ["stevewest/setui"]
        }
    }
}
```

# Usage

## Menu rendering

Using the `SetUI\Menu` class you can render a nested set model into a list. The constructor
takes an optional config array that can be used to control the behaviour of how the
set is rendered. Below is the default config for each item and an explanation of
what they can be used for.

```php
<?php
$config = [
    // This is each leaf of the tree, by default it has a link and a list of children
    'leafView' => 'setui::setui/leaf',
    
    // This is the list of children for each leaf
    'listView' => 'setui::setui/list',
    
    // This is the top level container, it can be used for adding style around the list
    'containerView' => 'setui::setui/container',
    
    // If not set to null will be treated as an instance of Theme for loading views
    'themeInstance' => null,
    
    // Property name of the model to load the leaf name from
    'nameProperty' => 'name',
    
    // Set to true to display the root node of the tree
    'includeRoot' => false,
    
    // What to prepend to the URL before it is passed to Uri::create()
    'uriPrefix' => '',
    
    // URI string that denotes the currently active node path (eg "parent/child/grandchild")
    'activePath' => '',
];
```

To render a set just create a new instance of `SetUI\Menu` and call the `build()`
method.

```php
<?php
$menu = new \SetUI\Menu($config);

$set = Model_Tree::forge()->set_tree_id(1)->root()->get_one();

// $tree contains the top level View object
$tree = $menu->build($set);
```

## Note on path generation

Path names are generated using nested sets' `path()` method, to ensure you are getting
the correct paths then make sure your nested set's tree config has the `title_field`
setting set to the correct column name. While SetUI does not care what this is it is
often best to use a URL friendly property, such as one generated with the slug observer.

# JavaScript

The module also includes some basic javascript to allow a slightly nicer user interaction.
To enable this you will want to symlink the files in `assets` to the appropriate asset
folders. While you can copy the files, doing so means you will manually have to update
the assets when the module is updated.

Once the JS is included in the page it will automatically collapse non-active
branches and allow branches to be opened and closed.

jQuery 1.7 or higher is required. 

# Testing

Currently the module is not unit tested due to the complications of testing FuelPHP
v1 modules outside of an application.

# Acknowledgements

Triangle icon by <a href="http://www.flaticon.com/authors/elegant-themes" title="Elegant Themes">Elegant Themes</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a>
