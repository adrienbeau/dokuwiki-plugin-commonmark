<?php

/*
 * This file is part of the clockoon/dokuwiki-commonmark-plugin package.
 *
 * (c) Sungbin Jeon <clockoon@gmail.com>
 *
 * Original code based on the followings:
 * - CommonMark JS reference parser (https://bitly.com/commonmark-js) (c) John MacFarlane
 * - league/commonmark (https://github.com/thephpleague/commonmark) (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DokuWiki\Plugin\Commonmark\Extension\Renderer\Inline;

use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Emphasis;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;

final class EmphasisRenderer implements NodeRendererInterface
{
    /**
     * @param Emphasis                 $inline
     * @param ElementRendererInterface $DWRenderer
     *
     * @return string
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Emphasis::assertInstanceOf($node);

        return '//' .  $DWRenderer->renderNodes($node->children()) . '//';
    }
}
