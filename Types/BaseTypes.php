<?php


namespace AppGraphQL\Types;
use GraphQL\Type\Definition\Type;
use AppGraphQL\QueryTypes\BaseQuery;
use AppGraphQL\DataTypes\UserType;
use AppGraphQL\DataTypes\BasketType;


class BaseTypes extends Type
{
    private static $baseQuery;
    private static $user;
    private static $basket;

    public static function baseQuery(){
        return self::$baseQuery?:(self::$baseQuery = new BaseQuery());
    }

    public static function user(){
        return self::$user?:(self::$user = new UserType());
    }

    public static function basket(){
        return self::$basket?:(self::$basket = new BasketType());
    }
}