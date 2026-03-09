# Laravel Coding Standard

This repository contains the coding standards configurations used for our packages and projects.

## installation

Installation is not strictly necessary, you could simply copy the files you care about and update the paths.
This way you will not get any updates in the future.

Run
```shell-script
composer require --dev "justbetter/laravel-coding-standard"
```

### Editorconfig

The editorconfig is made so your editors are in sync with each other, to prevent different editor from constantly causing changes and conflicts with each other or other tools.

```shell-script
\ln -sf vendor/justbetter/laravel-coding-standard/.editorconfig .editorconfig
```

## PHPStan

First you should install [Larastan](https://github.com/larastan/larastan).

```shell-script
composer require --dev "larastan/larastan"
```

then copy the sample configuration file, this includes larastan with some basic setup from laravel-coding-standard, like the editor url button.

```shell-script
\cp vendor/justbetter/laravel-coding-standard/phpstan.sample.neon phpstan.neon
```

### Optional - Copy workflow

Once you've installed PHPStan you could copy the analyse workflow to automatically run it for PRs

```shell-script
\mkdir -p .github/workflows
\cp vendor/justbetter/laravel-coding-standard/.github/sample-workflows/analyse.yml .github/workflows/analyse.yml
```

## Rector

As a good companion to PHPStan we also have configuration for Rector which can in some cases fix PHPStan issues, and improve the results given by PHPStan

First you should install [rector-laravel](https://github.com/driftingly/rector-laravel)

```shell-script
composer require --dev "driftingly/rector-laravel"
```

then copy the sample configuration file, this includes Rector with some basic setup from laravel-coding-standard.

```shell-script
\cp vendor/justbetter/laravel-coding-standard/rector.sample.php rector.php
```

Rector is much more stable in it's changes than it ever was, rarely (if at all) making breaking changes.
We still recommend running it manually instead of using workflows.

## Prettier formatter

To get prettier working in blade and frontend you will need to install prettier

```shell-script
yarn add --dev prettier prettier-plugin-tailwindcss @shufo/prettier-plugin-blade
```

and add a .prettierrc

```shell-script
\ln -sf vendor/justbetter/laravel-coding-standard/.prettierrc .prettierrc
```

### Optional - Copy workflow

Once you've installed PHPStan you could copy the prettier workflow to automatically run it for PRs

```shell-script
\mkdir -p .github/workflows
\cp vendor/justbetter/laravel-coding-standard/.github/sample-workflows/prettier.yml .github/workflows/prettier.yml
```
