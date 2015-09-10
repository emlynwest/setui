# SetUI

Module to provide basic user interfaces for FuelPHP's nested sets model.

# Install instructions

Add the following to your `composer.json`:

```json
{
    "repositories": [
        { "type": "vcs", "url": "git@bitbucket.org:stevewest/setui.git" }
    ],
    "require": {
        "stevewest/setui": "dev-master"
    },
}
```

Then just run a `composer update`! 
> You will be asked for your BitBucket login if this is the first time installing.

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
];
```

To render a set just create a new instance of `SetUI\Menu` and call the `build()`
method.

```php
<?php
$menu = new \SetUI\Menu();

$set = Model_Tree::forge()->set_tree_id(1)->root()->get_one();

// $tree contains the top level View object
$tree = $menu->build($set);
```

# Testing

Currently the module is not unit tests due to the complications of testing FuelPHP
v1 modules outside of an application.
