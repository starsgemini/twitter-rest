<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Lists;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Lists show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/show
 *
 * @method string|null getListId()                           Gets the list id.
 * @method null        setListId(string $listId)             Sets the list id.
 * @method string|null getSlug()                             Gets the list slug.
 * @method null        setSlug(string $slug)                 Sets the list slug.
 * @method string|null getOwnerScreenName()                  Gets the screen name of the user owning the list.
 * @method null        setOwnerScreenName(string $screeName) Sets the screen name of the user owning the list.
 * @method string|null getOwnerId()                          Gets the id of the user owning the list.
 * @method null        setOwnerId(string $ownerId)           Sets the id of the user owning the list.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsShowRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('list_id')
            ->register('slug')
            ->register('owner_screen_name')
            ->register('owner_id');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['list_id']) && !isset($optionBag['slug'])) {
            throw new \RuntimeException('You must provide a list id or slug.');
        }

        if (isset($optionBag['list_id'])) {
            unset($optionBag['slug']);
        }

        if (isset($optionBag['slug']) && !isset($optionBag['owner_screen_name']) && !isset($optionBag['owner_id'])) {
            throw new \RuntimeException(
                'You must provide the owner screen name or id in conjuction with the slug parameter.'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/show.json';
    }
}
