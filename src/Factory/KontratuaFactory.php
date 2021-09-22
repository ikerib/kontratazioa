<?php

namespace App\Factory;

use App\Entity\Kontratua;
use App\Repository\KontratuaRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Kontratua>
 *
 * @method static Kontratua|Proxy createOne(array $attributes = [])
 * @method static Kontratua[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Kontratua|Proxy find(object|array|mixed $criteria)
 * @method static Kontratua|Proxy findOrCreate(array $attributes)
 * @method static Kontratua|Proxy first(string $sortedField = 'id')
 * @method static Kontratua|Proxy last(string $sortedField = 'id')
 * @method static Kontratua|Proxy random(array $attributes = [])
 * @method static Kontratua|Proxy randomOrCreate(array $attributes = [])
 * @method static Kontratua[]|Proxy[] all()
 * @method static Kontratua[]|Proxy[] findBy(array $attributes)
 * @method static Kontratua[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Kontratua[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static KontratuaRepository|RepositoryProxy repository()
 * @method Kontratua|Proxy create(array|callable $attributes = [])
 */
final class KontratuaFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'espedientea' => self::faker()->text(),
            'izena_eus' => self::faker()->text(),
            'izena_es' => self::faker()->text(),
            'sinadura' => self::faker()->datetime(),
            'iraupena' => self::faker()->text(),
            'amaitua' => self::faker()->boolean(),
            'luzapena' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Kontratua $kontratua) {})
        ;
    }

    protected static function getClass(): string
    {
        return Kontratua::class;
    }
}
