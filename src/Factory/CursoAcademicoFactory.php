<?php

namespace App\Factory;

use App\Entity\CursoAcademico;
use App\Repository\CursoAcademicoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CursoAcademico>
 *
 * @method        CursoAcademico|Proxy                     create(array|callable $attributes = [])
 * @method static CursoAcademico|Proxy                     createOne(array $attributes = [])
 * @method static CursoAcademico|Proxy                     find(object|array|mixed $criteria)
 * @method static CursoAcademico|Proxy                     findOrCreate(array $attributes)
 * @method static CursoAcademico|Proxy                     first(string $sortedField = 'id')
 * @method static CursoAcademico|Proxy                     last(string $sortedField = 'id')
 * @method static CursoAcademico|Proxy                     random(array $attributes = [])
 * @method static CursoAcademico|Proxy                     randomOrCreate(array $attributes = [])
 * @method static CursoAcademicoRepository|RepositoryProxy repository()
 * @method static CursoAcademico[]|Proxy[]                 all()
 * @method static CursoAcademico[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static CursoAcademico[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static CursoAcademico[]|Proxy[]                 findBy(array $attributes)
 * @method static CursoAcademico[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static CursoAcademico[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class CursoAcademicoFactory extends ModelFactory
{
    private static $count = 0;
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
        $inicio = 2024 - self::$count;
        $final = 2025 - self::$count;

        self::$count++;

        return [
            'descripcion' => "$inicio/$final",
            'fechaInicio' => self::faker()->dateTimeInInterval("15 September $inicio"),
            'fechaFinal' => self::faker()->dateTimeInInterval("20 June $final"),
        ];
    }


    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CursoAcademico $cursoAcademico): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CursoAcademico::class;
    }
}
