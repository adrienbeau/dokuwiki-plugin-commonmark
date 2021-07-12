<?php

declare(strict_types=1);

/*
 * This file is part of the clockoon/dokuwiki-commonmark-plugin package.
 *
 * (c) Sungbin Jeon <clockoon@gmail.com>
 *
 * Original code based on the followings:
 * - CommonMark JS reference parser (https://bitly.com/commonmark-js) (c) John MacFarlane
 * - league/commonmark (https://github.com/thephpleague/commonmark) (c) Colin O'Dell <colinodell@gmail.com>
 * - Commonmark Table extension  (c) Martin Hasoň <martin.hason@gmail.com>, Webuni s.r.o. <info@webuni.cz>, Colin O'Dell <colinodell@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DokuWiki\Plugin\Commonmark\Extension\Renderer\Block;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Renderer\BlockRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\Table\TableCell;

final class TableCellRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $DWRenderer, bool $inTightList = false)
    {
        if (!$block instanceof TableCell) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        # block type indicator on DW
        $separator = '';
        switch ($block->type) {
            case 'td':
                $separator = '|';
                break;
            case 'th':
                $separator = '^';
                break;
        }

        # align indicator on DW
        $lmargin = ' ';
        $rmargin = ' ';
        switch($block->align) {
            case "right":
                $lmargin = '  ';
                break;
            case "center":
                $lmargin = '  ';
                $rmargin = '  ';
                break;
        }

        $result = $separator . $lmargin . $DWRenderer->renderInlines($block->children()) . $rmargin;
        return $result;

    }
}
