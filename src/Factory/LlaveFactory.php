<?php

namespace App\Factory;

use App\Entity\Llave;
use App\Repository\LlaveRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Llave>
 *
 * @method        Llave|Proxy                     create(array|callable $attributes = [])
 * @method static Llave|Proxy                     createOne(array $attributes = [])
 * @method static Llave|Proxy                     find(object|array|mixed $criteria)
 * @method static Llave|Proxy                     findOrCreate(array $attributes)
 * @method static Llave|Proxy                     first(string $sortedField = 'id')
 * @method static Llave|Proxy                     last(string $sortedField = 'id')
 * @method static Llave|Proxy                     random(array $attributes = [])
 * @method static Llave|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LlaveRepository|RepositoryProxy repository()
 * @method static Llave[]|Proxy[]                 all()
 * @method static Llave[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Llave[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Llave[]|Proxy[]                 findBy(array $attributes)
 * @method static Llave[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Llave[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LlaveFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'descripcion' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Llave $llave): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Llave::class;
    }
}
