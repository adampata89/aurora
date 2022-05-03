<?php
$driver = (new \Aternos\Model\Driver\Mysqli\Mysqli())
    ->setDatabase(DATABASE_NAME)
    ->setHost(DATABASE_HOST)
    ->setPort(DATABASE_PORT)
    ->setUsername(DATABASE_USER)
    ->setPassword(DATABASE_PASSWORD);

\Aternos\Model\Driver\DriverRegistry::getInstance()->registerDriver($driver);
