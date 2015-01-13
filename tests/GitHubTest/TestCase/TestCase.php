<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\TestCase;

use GitHub\Adapter\GuzzleAdapter;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \GitHub\Adapter\GuzzleAdapter
     */
    private $adapter;

    private $history;

    protected function getMockHistory()
    {
        return $this->history;
    }

    protected function getMockData($type)
    {
        $path = sprintf('tests/data/%s.json', $type);
        return json_decode(file_get_contents($path), true);
    }

    protected function setMockResponse($statusCode, array $body = [])
    {
        $statusText = '';
        $bodyAsString = json_encode($body);
        switch($statusCode) {
            case 200:
                $statusText = 'OK';
                break;
        }
        $mockResponse = new Mock([sprintf(
            "HTTP/1.1 %d %s\r\nContent-Length: %d\r\n\r\n%s",
            $statusCode,
            $statusText,
            strlen($bodyAsString),
            $bodyAsString
        )]);
        $this->getAdapter()->getHttpClient()->getEmitter()->attach($mockResponse);
    }

    protected function getAdapter()
    {
        if (!$this->adapter) {
            $this->history = new History();
            $this->adapter = new GuzzleAdapter();
            $this->adapter->getHttpClient()->getEmitter()->attach($this->history);
        }
        return $this->adapter;
    }
}
