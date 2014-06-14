<?php

namespace DH\Command;

class CommandBus
{

    public static function execute($command)
    {
        $handler = CommandTranslator::toCommandHandler($command);

        return \App::make($handler)->handle($command);
    }
} 