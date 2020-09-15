<?php


namespace AppGraphQL\DataTypes;
use AppGraphQL\Types\BaseTypes;
use GraphQL\Type\Definition\ObjectType;

class BasketType extends ObjectType{
    public function __construct()
    {
        $config = [
            'name' => 'Корзина',
            'fields' => [
                'ID' => [
                    'type' => BaseTypes::int(),
                ],
                'PRODUCT_ID' => [
                    'type' => BaseTypes::int(),
                ],
                'NAME' => [
                    'type' => BaseTypes::string(),
                ],
                'PRICE' => [
                    'type' => BaseTypes::int(),
                ],
            ]
        ];
        parent::__construct($config);
    }
}