<?php

namespace App\Factory;

use App\Entity\Grupo;
use App\Repository\GrupoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Grupo>
 *
 * @method        Grupo|Proxy                     create(array|callable $attributes = [])
 * @method static Grupo|Proxy                     createOne(array $attributes = [])
 * @method static Grupo|Proxy                     find(object|array|mixed $criteria)
 * @method static Grupo|Proxy                     findOrCreate(array $attributes)
 * @method static Grupo|Proxy                     first(string $sortedField = 'id')
 * @method static Grupo|Proxy                     last(string $sortedField = 'id')
 * @method static Grupo|Proxy                     random(array $attributes = [])
 * @method static Grupo|Proxy                     randomOrCreate(array $attributes = [])
 * @method static GrupoRepository|RepositoryProxy repository()
 * @method static Grupo[]|Proxy[]                 all()
 * @method static Grupo[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Grupo[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Grupo[]|Proxy[]                 findBy(array $attributes)
 * @method static Grupo[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Grupo[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class GrupoFactory extends ModelFactory
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
            // ->afterInstantiate(function(Grupo $grupo): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Grupo::class;
    }
}
