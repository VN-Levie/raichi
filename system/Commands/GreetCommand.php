<?php

namespace System\Commands;

class GreetCommand 
{
    public function getName()
    {
        return 'greet';
    }

    public function execute()
    {
        echo "Hello, User!\n";
    }
}
