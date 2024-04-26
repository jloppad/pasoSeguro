<?php

namespace App\Factory;

use App\Entity\Registro;
use App\Repository\RegistroRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Registro>
 *
 * @method        Registro|Proxy                     create(array|callable $attributes = [])
 * @method static Registro|Proxy                     createOne(array $attributes = [])
 * @method static Registro|Proxy                     find(object|array|mixed $criteria)
 * @method static Registro|Proxy                     findOrCreate(array $attributes)
 * @method static Registro|Proxy                     first(string $sortedField = 'id')
 * @method static Registro|Proxy                     last(string $sortedField = 'id')
 * @method static Registro|Proxy                     random(array $attributes = [])
 * @method static Registro|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RegistroRepository|RepositoryProxy repository()
 * @method static Registro[]|Proxy[]                 all()
 * @method static Registro[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Registro[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Registro[]|Proxy[]                 findBy(array $attributes)
 * @method static Registro[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Registro[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RegistroFactory extends ModelFactory
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
            'horaSalida' => self::faker()->dateTime(),
            'llave' => LlaveFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Registro $registro): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Registro::class;
    }
}
