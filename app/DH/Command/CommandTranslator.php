<?php


namespace DH\Command;


class CommandTranslator
{
    public static function toCommandHandler($command)
    {
        $handler = substr_replace(get_class($command), 'CommandHandler', -7);

        if (!class_exists($handler))
            throw new \Exception("Command handler [$handler] does not exist.");

        return $handler;
    }
} 