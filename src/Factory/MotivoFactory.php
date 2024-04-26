<?php

namespace App\Factory;

use App\Entity\Motivo;
use App\Repository\MotivoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Motivo>
 *
 * @method        Motivo|Proxy                     create(array|callable $attributes = [])
 * @method static Motivo|Proxy                     createOne(array $attributes = [])
 * @method static Motivo|Proxy                     find(object|array|mixed $criteria)
 * @method static Motivo|Proxy                     findOrCreate(array $attributes)
 * @method static Motivo|Proxy                     first(string $sortedField = 'id')
 * @method static Motivo|Proxy                     last(string $sortedField = 'id')
 * @method static Motivo|Proxy                     random(array $attributes = [])
 * @method static Motivo|Proxy                     randomOrCreate(array $attributes = [])
 * @method static MotivoRepository|RepositoryProxy repository()
 * @method static Motivo[]|Proxy[]                 all()
 * @method static Motivo[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Motivo[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Motivo[]|Proxy[]                 findBy(array $attributes)
 * @method static Motivo[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Motivo[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class MotivoFactory extends ModelFactory
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
            'numeroOrden' => self::faker()->randomNumber(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Motivo $motivo): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Motivo::class;
    }
}
