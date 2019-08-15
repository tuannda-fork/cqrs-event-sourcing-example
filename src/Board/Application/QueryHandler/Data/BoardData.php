<?php
/**
 * This file is part of list-maker.
 * (c) Renan Taranto <renantaranto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Taranto\ListMaker\Board\Application\QueryHandler\Data;

/**
 * Class BoardData
 * @package Taranto\ListMaker\Board\Application\QueryHandler\Data
 * @author Renan Taranto <renantaranto@gmail.com>
 */
final class BoardData
{
    /**
     * @var string
     */
    private $boardId;

    /**
     * @var string
     */
    private $title;

    /**
     * BoardData constructor.
     * @param string $boardId
     * @param string $title
     */
    public function __construct(string $boardId, string $title)
    {
        $this->boardId = $boardId;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBoardId(): string
    {
        return $this->boardId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}