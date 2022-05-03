<?php

namespace App\Model;

use Aternos\Model\Driver\Features\SavableInterface;
use Aternos\Model\ModelRegistry;
use Aternos\Model\Query\SelectQuery;

class Model extends \Aternos\Model\GenericModel
{
    // use model registry (default: true)
    protected static bool $registry = false;

    // cache the model for 60 seconds (default: null)
    protected static ?int $cache = 5;

    // configure the generic model drivers (this is the default)
    protected static array $drivers = [
        \Aternos\Model\Driver\Redis\Redis::ID,
        \Aternos\Model\Driver\Mysqli\Mysqli::ID
    ];

    public function save(): bool
    {
        // new model, generate id and save in registry
        if (!$this->getId()) {
//            $this->generateId();

            if (static::$registry) {
                ModelRegistry::getInstance()->save($this);
            }
        }

        foreach (static::getSavableDrivers() as $savableDriver) {
            /** @var SavableInterface $driver */
            $driver = static::getDriverRegistry()->getDriver($savableDriver);
            if (!$driver->save($this)) {
                return false;
            }
        }

        return true;
    }

    public static function getName(): string
    {
        return 'Model';
    }
}
