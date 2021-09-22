<?php

namespace Flasher\Console\Prime\Notifier;

use Flasher\Console\Prime\System\Command;
use Flasher\Console\Prime\System\OS;
use Flasher\Prime\Envelope;

final class NotifySendNotifier extends AbstractNotifier
{
    public function renderEnvelope(Envelope $envelope)
    {
        $cmd = new Command($this->getProgram());

        $cmd
            ->addOption('--urgency', 'normal')
            ->addOption('--app-name', 'notify')
            ->addOption('--icon', $this->getIcon($envelope->getType()))
            ->addOption('--expire-time', $this->getExpireTime())
            ->addArgument($this->getTitle())
            ->addArgument($envelope->getMessage())
        ;

        $cmd->run();
    }

    public function isSupported()
    {
        return $this->isEnabled() && OS::isUnix() && $this->getProgram();
    }

    public function getExpireTime()
    {
        return (int) $this->options['expire_time'];
    }

    public function configureOptions(array $options)
    {
        $default = array(
            'binary' => 'notify-send',
            'expire_time' => 0,
        );

        $options = array_replace($default, $options);

        parent::configureOptions($options);
    }
}
