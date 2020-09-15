<?php


namespace AppGraphQL\QueryTypes;
use GraphQL\Type\Definition\ObjectType;
use Bitrix\Main\UserTable;
use AppGraphQL\Types\BaseTypes;


class BaseQuery extends ObjectType
{
    public function __construct()
    {
        $config = [
            "fields" => [
                "user" => [
                    "type" => BaseTypes::user(),
                    "description" => "все пользователи",
                    "args" => [
                        'id' => [
                            'type' => BaseTypes::int(),
                        ]
                    ],
                    "resolve" => function ($root, $args){
                        return UserTable::query()
                            ->setSelect([
                                'NAME',
                                'ID',
                                'EMAIL',
                                'LOGIN'
                            ])
                            ->where('ACTIVE', 'Y')
                            ->exec()
                            ->fetch()
                            ;
                    }
                ],
                "allUser" => [
                    "type" => BaseTypes::listOf(BaseTypes::user()),
                    "description" => "все пользователи",
                    "resolve" => function (){
                        return UserTable::query()
                            ->setSelect([
                                'NAME',
                                'ID',
                                'EMAIL',
                                'LOGIN'
                            ])
                            ->where('ACTIVE', 'Y')
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