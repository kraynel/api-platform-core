<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Bridge\Doctrine\Orm\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Cache\QueryExpander;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface as LegacyQueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;

/**
 * Enables doctrine cache on the Doctrine query for resource item or collection when enabled.
 */
final class QueryCacheExtension implements QueryItemExtensionInterface, QueryCollectionExtensionInterface
{
    /** @var QueryExpander */
    private $queryExpander;

    public function __construct(QueryExpander $queryExpander)
    {
        $this->queryExpander = $queryExpander;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(QueryBuilder $queryBuilder, LegacyQueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->queryExpander->expand($resourceClass, $queryBuilder->getQuery());
    }

    /**
     * {@inheritdoc}
     */
    /**
     * @param QueryNameGeneratorInterface|LegacyQueryNameGeneratorInterface $queryNameGenerator
     */
    public function applyToItem(QueryBuilder $queryBuilder, LegacyQueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->queryExpander->expand($resourceClass, $queryBuilder->getQuery());
    }

}
