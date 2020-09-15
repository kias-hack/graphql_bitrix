<?php
namespace AppGraphQL\DataTypes;
use AppGraphQL\Types\BaseTypes;
use Bitrix\Main\Loader;
use Bitrix\Sale\Internals\BasketTable;
use GraphQL\Type\Definition\ObjectType;

Loader::includeModule('sale');

class UserType extends ObjectType{
    public function __construct()
    {
        $config = [
            "name" => "User",
            "fields" => [
                "NAME" => [
                    'type' => BaseTypes::string(),
                    'description' => 'имя пользователя'
                ],
                "ID" => [
                    'type' => BaseTypes::int(),
                    'description' => 'ID пользователя'
                ],
                "EMAIL" => [
                    'type' => BaseTypes::string(),
                    'description' => 'email'
                ],
                "LOGIN" => [
                    'type' => BaseTypes::string(),
                    'description' => 'login'
                ],
                "BASKET" => [
                    'type' => BaseTypes::listOf(BaseTypes::basket()),
                    'description' => 'Заказы пользователя',
                    'args' => [
                        'limit' => [
                            'type' => BaseTypes::int(),
                        ]
                    ],
                    'resolve' => function($root, $args){
                        return BasketTable::query()
                            ->setSelect(['*'])
                            ->where('USER.ID', $root['ID'])
                            ->setLimit($args['limit'])
                            ->exec()
                            ->fetchAll()
                            ;
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}