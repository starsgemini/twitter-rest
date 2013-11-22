<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Favorites;

use Widop\Twitter\AbstractRequest;
use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;

/**
 * Favorites destroy request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/favorites/destroy
 *
 * @method string       getId()                                      Gets the tweet ID to unfavorite.
 * @method null         setId(string $id)                            Sets the tweet ID to unfavorite.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FavoritesDestroyRequest extends AbstractRequest
{
    /**
     * Creates a favorites destroy request.
     *
     * @param string $id The Tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setId($id);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('id', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['id'])) {
            throw new \RuntimeException('You must specify an id.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/favorites/destroy.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}