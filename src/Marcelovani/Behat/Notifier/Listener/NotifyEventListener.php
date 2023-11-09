<?php

namespace Marcelovani\Behat\Notifier\Listener;

use Behat\Behat\EventDispatcher\Event as BehatEvent;
use Behat\Testwork\EventDispatcher\Event as TestworkEvent;
use Marcelovani\Behat\Notifier\ServiceContainer\Config;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * This class is responsible listen to Behat events and forward it to the notifier classes.
 */
class NotifyEventListener implements EventSubscriberInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * The screenshot service, if available.
     */
    private $screenshotService;

    /**
     * List of notifiers.
     */
    private $notifiers;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config,
               $screenshotService = null,
               $notifiers = [],
    )
    {
        $this->config = $config;
        $this->screenshotService = $screenshotService;
        $this->notifiers = $notifiers;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            TestworkEvent\SuiteTested::BEFORE => ['onBeforeSuiteTested', -10],
            TestworkEvent\SuiteTested::AFTER => ['onAfterSuiteTested', -10],
            BehatEvent\FeatureTested::BEFORE => ['onBeforeFeatureTested', -10],
            BehatEvent\FeatureTested::AFTER => ['onAfterFeatureTested', -10],
            BehatEvent\ScenarioTested::BEFORE => ['onBeforeScenarioTested', -10],
            BehatEvent\ScenarioTested::AFTER => ['onAfterScenarioTested', -10],
            BehatEvent\OutlineTested::BEFORE => ['onBeforeOutlineTested', -10],
            BehatEvent\OutlineTested::AFTER => ['onAfterOutlineTested', -10],
            BehatEvent\StepTested::BEFORE => ['onBeforeStepTested', -10],
            BehatEvent\StepTested::AFTER => ['onAfterStepTested', -10],
        ];
    }

    /**
     * @param TestworkEvent\BeforeSuiteTested $event
     */
    public function onBeforeSuiteTested(TestworkEvent\BeforeSuiteTested $event): void
    {
        $details = [
            'eventId' => __FUNCTION__,
            'event' => $event,
            'screenshotService' => $this->screenshotService,
        ];

        $this->notify($details);
    }

    /**
     * @param TestworkEvent\SuiteTested $event
     */
    public function onAfterSuiteTested(TestworkEvent\SuiteTested $event): void
    {
        $details = [
            'eventId' => __FUNCTION__,
            'event' => $event,
            'screenshotService' => $this->screenshotService,
        ];

        $this->notify($details);
    }

    /**
     * @param BehatEvent\FeatureTested $event
     */
    public function onBeforeFeatureTested(BehatEvent\FeatureTested $event)
    {

    }

    /**
     * @param BehatEvent\FeatureTested $event
     */
    public function onAfterFeatureTested(BehatEvent\FeatureTested $event)
    {

    }

    /**
     * @param BehatEvent\ScenarioTested $event
     */
    public function onBeforeScenarioTested(BehatEvent\ScenarioTested $event)
    {

    }

    /**
     * @param BehatEvent\ScenarioTested $event
     */
    public function onAfterScenarioTested(BehatEvent\ScenarioTested $event)
    {
        $details = [
            'eventId' => __FUNCTION__,
            'event' => $event,
            'screenshotService' => $this->screenshotService,
        ];

        $this->notify($details);
    }

    /**
     * @param BehatEvent\OutlineTested $event
     */
    public function onBeforeOutlineTested(BehatEvent\OutlineTested $event)
    {

    }

    /**
     * @param BehatEvent\OutlineTested $event
     */
    public function onAfterOutlineTested(BehatEvent\OutlineTested $event)
    {

    }

    /**
     * @param BehatEvent\StepTested $event
     */
    public function onBeforeStepTested(BehatEvent\StepTested $event)
    {

    }

    /**
     * @param BehatEvent\StepTested $event
     */
    public function onAfterStepTested(BehatEvent\StepTested $event)
    {

    }

    /**
     * Calls the notify method on notifiers.
     *
     * @param array $details
     *   The notification details.
     */
    private function notify($details)
    {
        foreach ($this->notifiers as $notifier) {
            $notifier->notify($details);
        }
    }
}
