<?php


namespace DH\Command;


interface CommandHandlerInterface
{
    public function handle(CommandInterface $command);
} 