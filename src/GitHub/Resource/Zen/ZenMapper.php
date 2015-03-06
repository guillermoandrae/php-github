<?php

namespace GitHub\Resource\Zen;

use GitHub\Resource\Collection;
use GitHub\Resource\ResourceMapperAbstract;

class ZenMapper extends ResourceMapperAbstract
{
    public function findOne()
    {
        $result = $this->getAdapter()->get('/zen');
        return new Zen($result);
    }
}
