	
Установите зависимость для composer  

    composer require webonyx/graphql-php  

Создайте файл с кодом ниже:  

```php
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use AppGraphQL\Types\BaseTypes;

$input = file_get_contents("php://input");
$input = json_decode($input, true);

$query = $input['query'];

$result = GraphQL::execute(new Schema(['query' => BaseTypes::baseQuery()]),$query);

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);

die();
?>
```

В папке `DataTypes` содержатся классы для описания сущностей в БД  
В папке `QueryTypes` содержатся классы с запросами  
в папке `Types` содержатся классы с со всеми типами описанными в папке `DataTypes`
