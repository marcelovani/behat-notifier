Behat Notifier Extension
=========================
Allows sending notifications to various channels i.e.
- Microsoft Teams
- Slack
- Email
- Any custom endpoint

This Behat extension integrates with:
- [Behat Teams Notifier](https://github.com/marcelovani/behat-teams-notifier)


Installation
------------

Install by adding to your `composer.json`:

```bash
composer require --dev marcelovani/behat-notifier
```

Configuration
-------------

Enable the extension in `behat.yml` like this:

The configuration goes in the `Marcelovani\Behat\Notifier` extension, under `notifiers`

```yml
default:
  extensions:
    Marcelovani\Behat\Notifier:
      screenshotExtension: Bex\Behat\ScreenshotExtension
      notifiers:
        # See https://github.com/marcelovani/behat-email-notifier
        Marcelovani\Behat\Notifier\Teams\EmailNotifier:
          recipients:
          - email1@foo.bar
          - email2@foo.bar
        # See https://github.com/marcelovani/behat-teams-notifier
        Marcelovani\Behat\Notifier\Teams\TeamsNotifier:
          webhook: 'https://www.foo.bar'
```

Todo
-------------
- Add example Features and Unit tests
- Add Github actions
- List package on https://packagist.org/
