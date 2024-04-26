<?php

namespace App\Factory;

use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Usuario>
 *
 * @method        Usuario|Proxy                     create(array|callable $attributes = [])
 * @method static Usuario|Proxy                     createOne(array $attributes = [])
 * @method static Usuario|Proxy                     find(object|array|mixed $criteria)
 * @method static Usuario|Proxy                     findOrCreate(array $attributes)
 * @method static Usuario|Proxy                     first(string $sortedField = 'id')
 * @method static Usuario|Proxy                     last(string $sortedField = 'id')
 * @method static Usuario|Proxy                     random(array $attributes = [])
 * @method static Usuario|Proxy                     randomOrCreate(array $attributes = [])
 * @method static UsuarioRepository|RepositoryProxy repository()
 * @method static Usuario[]|Proxy[]                 all()
 * @method static Usuario[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Usuario[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Usuario[]|Proxy[]                 findBy(array $attributes)
 * @method static Usuario[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Usuario[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class UsuarioFactory extends ModelFactory
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
            'apellidos' => self::faker()->text(255),
            'esAdmin' => self::faker()->boolean(),
            'esConserje' => self::faker()->boolean(),
            'esDocente' => self::faker()->boolean(),
            'nombre' => self::faker()->text(255),
            'pass' => self::faker()->text(255),
            'username' => self::faker()->text(255),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Usuario $usuario): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Usuario::class;
    }
}
