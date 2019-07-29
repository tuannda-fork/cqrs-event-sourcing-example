<?php
/**
 * This file is part of list-maker.
 * (c) Renan Taranto <renantaranto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Taranto\ListMaker\Ui\Web\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Taranto\ListMaker\Infrastructure\Validation\ConstraintViolationsTranslator;

/**
 * Class ResponseOnValidationException
 * @package Taranto\ListMaker\Ui\Web\EventListener
 * @author Renan Taranto <renantaranto@gmail.com>
 */
final class ResponseOnValidationException
{
    /**
     * @var ConstraintViolationsTranslator
     */
    private $constraintViolationsTranslator;

    /**
     * ResponseOnValidationException constructor.
     * @param ConstraintViolationsTranslator $constraintViolationsTranslator
     */
    public function __construct(ConstraintViolationsTranslator $constraintViolationsTranslator)
    {
        $this->constraintViolationsTranslator = $constraintViolationsTranslator;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        if ($event->getException() instanceof ValidationFailedException) {
            $violations = $this->constraintViolationsTranslator->translate($event->getException()->getViolations());
            $response = new JsonResponse(['errors' => $violations], JsonResponse::HTTP_BAD_REQUEST);
            $event->setResponse($response);
        }
    }
}