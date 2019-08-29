<?php
/**
 * This file is part of list-maker.
 * (c) Renan Taranto <renantaranto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Taranto\ListMaker\Board\Domain;

use Taranto\ListMaker\Board\Domain\Event\BoardClosed;
use Taranto\ListMaker\Board\Domain\Event\BoardCreated;
use Taranto\ListMaker\Board\Domain\Event\BoardReopened;
use Taranto\ListMaker\Board\Domain\Event\BoardTitleChanged;
use Taranto\ListMaker\Shared\Domain\Aggregate\AggregateRoot;
use Taranto\ListMaker\Shared\Domain\ValueObject\Title;

/**
 * Class Board
 * @package Taranto\ListMaker\Board\Domain
 * @author Renan Taranto <renantaranto@gmail.com>
 */
final class Board extends AggregateRoot
{
    /**
     * @var bool
     */
    private $open;

    /**
     * @param BoardId $boardId
     * @param Title $title
     * @return Board
     */
    public static function create(BoardId $boardId, Title $title): self
    {
        $instance = new self();

        $instance->recordThat(
            BoardCreated::occur((string) $boardId, ['title' => (string) $title])
        );

        return $instance;
    }

    /**
     * @param BoardCreated $event
     */
    protected function whenBoardCreated(BoardCreated $event): void
    {
        $this->aggregateId = $event->aggregateId();
        $this->open = true;
    }

    /**
     * @param Title $title
     */
    public function changeTitle(Title $title): void
    {
        $this->recordThat(
            BoardTitleChanged::occur((string) $this->aggregateId, ['title' => (string) $title])
        );
    }

    public function close(): void
    {
       if (!$this->open) {
           return;
       }

       $this->recordThat(BoardClosed::occur((string) $this->aggregateId));
    }

    /**
     * @param BoardClosed $event
     */
    protected function whenBoardClosed(BoardClosed $event): void
    {
        $this->open = false;
    }

    public function reopen(): void
    {
        if ($this->open) {
            return;
        }

        $this->recordThat(BoardReopened::occur((string) $this->aggregateId));
    }

    /**
     * @param BoardReopened $event
     */
    protected function whenBoardReopened(BoardReopened $event): void
    {
        $this->open = true;
    }
}
