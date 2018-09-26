# Contributing to copilot-markdown-generator

## Code Contributions

### Requirements

You will need to have installed on your machine:

* PHP 5.6. If you're using macOS, it's easiest to install this with [Homebrew]:
  ```shell
  $ brew install php@5.6
  ```
* Composer. [Download Composer][Composer] or install it with [Homebrew]:
  ```shell
  $ brew install composer
  ```

There are useful links in the [see also][CONTRIBUTING see also]
section below, as well as in the [readme][README see also].

### Step 1: Fork

Fork (or branch) the project [on GitHub][GitHub repo] and then clone it locally:

```bash
$ git clone git@github.com:username/copilot-markdown-generator-php.git
$ git remote add upstream https://github.com/conde-nast-international/copilot-markdown-generator-php.git
```

### Step 2: Install

Install project dependencies to `vendor/` by running:

```bash
$ composer install
```

### Step 3: Commit

Commit your changes:

```bash
$ git add [paths...]
$ git commit
```

### Step 4: Rebase

Synchronise with the main repository:

```bash
$ git fetch upstream
$ git rebase upstream/master
```

### Step 5: Test

Test cases go in the `tests/` directory and must end with `*Test.php` and
extend `PHPUnit\Framework\TestCase`. Take a look at the existing tests for
examples.

To run all tests, run:

```shell
$ composer install
$ composer run-script test
```

This will also run the example script. To run only unit tests, run the [PHPUnit]
binary:

```shell
$ vendor/bin/phpunit
```

### Step 6: Push

```shell
$ git push origin [branch-name]
```

### Step 7: Pull request

Open [a pull request][GitHub pull request] for your fork/branch.

### Step 8: Review and merging

In order to merge a pull request, it needs to be reviewed and approved by at
least one member and pass a CI test run. Commits on your branch will be
squashed into a single commit when merging into the `master` branch.

## Publishing

This project is published on [Packagist][Packagist copilot-markdown-generator].
To publish a new version, create a release [on GitHub][GitHub new release].
Composer uses version control tags to determine the latest version of the
project.

See existing [releases][GitHub releases] for examples.

## Additional notes

### Autoloading

This project uses the [PSR-4 autoloading standard][PSR-4]
in production and development.

[Composer] will generate a development autoloader (`vendor/autoload.php`) when
you run `composer install` locally, which can be used anywhere in the project
and will allow you to access project namespaces.

For example, the following allows access to `Text` in the `CopilotTags`
namespace:

```php
<?php
require __DIR__ . '/../vendor/autoload.php';
use CopilotTags\Text;

$text = new Text("Hello world!");
```

### PHPUnit

We use [PHPUnit] for unit testing. PHPUnit has it's own autoloader, so the
development autoloader is not required in test cases.

See [PHPUnit 4.8 documentation][PHPUnit manual].

## See also

* [PHP manual]
* [Composer documentation]
* [PHPUnit manual]
* [Composer]
* [PHPUnit]
* [Packagist]

[README see also]: https://github.com/conde-nast-international/copilot-markdown-generator-php/blob/master/README.md#see-also
[CONTRIBUTING see also]: https://github.com/conde-nast-international/copilot-markdown-generator-php/blob/master/CONTRIBUTING.md#see-also
[GitHub repo]: https://github.com/conde-nast-international/copilot-markdown-generator-php
[GitHub pull request]: https://github.com/conde-nast-international/copilot-markdown-generator-php/compare?expand=1
[GitHub releases]: https://github.com/conde-nast-international/copilot-markdown-generator-php/releases
[GitHub new release]: https://github.com/conde-nast-international/copilot-markdown-generator-php/releases/new
[Packagist]: https://packagist.org/
[Packagist copilot-markdown-generator]: https://packagist.org/packages/conde-nast-international/copilot-markdown-generator
[PHP manual]: https://secure.php.net/manual/en/
[Composer]: https://getcomposer.org/
[Composer documentation]: https://getcomposer.org/doc/
[PHPUnit]: https://phpunit.de/
[PHPUnit manual]: https://phpunit.de/manual/4.8/en/
[PSR-4]: http://www.php-fig.org/psr/psr-4/
[Homebrew]: https://brew.sh/
