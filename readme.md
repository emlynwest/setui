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

# Testing

Currently the module is not unit tests due to the complications of testing FuelPHP
v1 modules outside of an application.
