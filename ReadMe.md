# ChristopherL

A website. [See it in action.](http://christopherl.com)

### Contents
- [Build](#build)
- [Tests](#tests)
- [Libraries](#libraries)
- [Requirements](#requirements)
- [Feedback](#feedback)
- [License](#license)

## Build

Gulp is used to automate creation of JavaScript and CSS assets.

#### CSS

* Source: `/_build/sass/`
* Output: `/css/`

#### JavaScript

* Source: `/_build/javascript/`
* Output: `/js/`

## Tests

Unit tests are included at `/_tests/`. 

Test classes are written for PHPUnit v6.0+. They might work with 5.7 thanks to it's forward compatibility, but are not developed or tested against the 5.x branch.

## Libraries

This code is better because of the the generosity of a whole bunch of people.

* [Smarty](http://www.smarty.net/)
* [jQuery](https://jquery.com/)
* [Parsley](http://parsleyjs.org/)
* [Featherlight](https://noelboss.github.io/featherlight/)
* [Skeleton](http://getskeleton.com/)
* [include-media](http://include-media.com/)
* [Normalize.css](https://necolas.github.io/normalize.css/)


## Requirements

PHP. 7.0+ is required. While 5.6 probably works (for the site, tests require 7+) 5.x releases are not used in development or testing.

Node is required for local build process. `npm install` from inside `/_build/` should get you up and running.

Finished site should be well behaved in all modern browsers, desktop and mobile. 

Additionally, if you use this code you are required to have fun while you do it. Seriously. This is very important.

## Feedback

If you have something nice to say about this code, [please do so publicly](https://twitter.com/intent/tweet?original_referer=http://github.com/chrislarrycarl/ChristopherL&text=.%40chrislarrycarl%20Was%20checking%20out%20your%20ChristopherL%20repo%20and...).

If you have some insight for improvement, [please submit it here](https://github.com/chrislarrycarl/ChristopherL/issues).

## License
[Built with love](https://www.youtube.com/watch?v=Xe1TZaElTAs) and shared under [GNU GPL 2.0](http://www.gnu.org/licenses/gpl-2.0.html)
