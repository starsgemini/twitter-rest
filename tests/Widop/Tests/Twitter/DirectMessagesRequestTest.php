<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter;

use Widop\Twitter\DirectMessagesRequest;

/**
 * Direct messages request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\DirectMessagesRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new DirectMessagesRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Widop\Twitter\AbstractRequest', $this->request);
        $this->assertSame('/direct_messages.json', $this->request->getPath());
        $this->assertSame('GET', $this->request->getMethod());

        $this->assertNull($this->request->getSinceId());
        $this->assertNull($this->request->getMaxId());
        $this->assertNull($this->request->getCount());
        $this->assertNull($this->request->getIncludeEntities());
        $this->assertNull($this->request->getSkipStatus());
    }

    public function testSinceId()
    {
        $this->request->setSinceId('0123456789');

        $this->assertSame('0123456789', $this->request->getSinceId());
    }

    public function testMaxId()
    {
        $this->request->setMaxId('0123456789');

        $this->assertSame('0123456789', $this->request->getMaxId());
    }

    public function testCount()
    {
        $this->request->setCount(20);

        $this->assertSame(20, $this->request->getCount());
    }

    public function testIncludeEntities()
    {
        $this->request->setIncludeEntities(true);

        $this->assertTrue($this->request->getIncludeEntities());
    }

    public function testSkipStatus()
    {
        $this->request->setSkipStatus(true);

        $this->assertTrue($this->request->getSkipStatus());
    }

    public function testGetGetParametersWithoutParameters()
    {
        $this->assertEmpty($this->request->getGetParameters());
    }

    public function testGetGetParametersWithParameters()
    {
        $this->request->setSinceId('0123456789');
        $this->request->setMaxId('9876543210');
        $this->request->setCount(50);
        $this->request->setIncludeEntities(true);
        $this->request->setSkipStatus(true);

        $expected = array(
            'since_id'         => '0123456789',
            'max_id'           => '9876543210',
            'count'            => '50',
            'include_entities' => '1',
            'skip_status'      => '1',
        );

        $this->assertSame($expected, $this->request->getGetParameters());
    }
}
