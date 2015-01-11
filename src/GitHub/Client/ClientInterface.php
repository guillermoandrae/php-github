<?php

namespace GitHub\Client;

use GitHub\Adapter\AdapterInterface;

interface ClientInterface
{
    public function getResource($name);
    public function getAdapter();
    public function setAdapter(AdapterInterface $adapter);
}