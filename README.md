# Expression  
  
Модуль **4slovo/expression** позволяет преобразовывать текстовое представление формул  
в алгоритмические выражения: это позволяет вынести логику расчётов на конфигурационный   
уровень.  
  
Пример, формулу расчёта площади круга можно записать как:  
```  
3.14 * ($radius ** 2)  
```  
что будет преобразовано в объект класса **Expression**, который  
имеет метод **calculate**, производящий расчёт площади круга в зависимости от  
переданной переменной **$radius**  

Пример:
```php  
$calculatingAreaOfCircleFormula = '3.14 * ($radius ** 2)';  
  
$variableList = new VariableList();  
$radius = TypeFactory::getInstance()->createInt();  
$variableList->append('radius', $radius->setValue(1));  
  
$textExpression = new TextExpression();  
$expression = $textExpression  
    ->setVariableList($variableList)
    ->setExpressionText($calculatingAreaOfCircleFormula);
    ->toExpression();  
  
echo $expression->calculate()->getValue(); # выведет 3.14  
$radius->setValue(2);  
echo $expression->calculate()->getValue(); # выведет 12.56  
```  
## Поддерживаемые операции 
### Сложение
**Знак** |  **Класс операции**
--- | ---
 `+` | addOperation
 
#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
IntType |  IntType |  IntType | 1 + 1 = 2
IntType | FloatType | FloatType | 1 + 1.1 = 2.1
FloatType | IntType | FloatType | 1.1 + 1 = 2.1
FloatType | FloatType | FloatType | 1.1 + 1.2 = 2.3
MoneyType | MoneyType | MoneyType | 1$ + 2$20 = 3$20
DateIntervalType | DateIntervalType | DateIntervalType | 1 day + 2 days = 3 days
DateIntervalType | DateTimeType | DateTimeType | 1 day + 2018.01.02 = 2018.01.03
DateTimeType | DateIntervalType | DateTimeType | 2018.01.02 + 1 day = 2018.01.03

### Вычитание
**Знак** |  **Класс операции**
--- | ---
 `-` | SubtractionOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
IntType |  IntType |  IntType | 2 - 1 = 1
IntType | FloatType | FloatType | 2 - 1.1 = 0.9
FloatType | IntType | FloatType | 1.1 - 2 = -0.9
FloatType | FloatType | FloatType | 2.2 - 1.1 = 1.1
MoneyType | MoneyType | MoneyType | 2$ - 1$ = 1$
DateIntervalType | DateIntervalType | DateIntervalType | 2 day - 1 day = 1 day
DateTimeType | DateTimeType | DateIntervalType | 2018.01.02 - 2018.01.01 = 1 day
DateTimeType | DateIntervalType | DateTimeType | 2018.01.02 - 1 day = 2018.01.01

### Умножение
**Знак** |  **Класс операции**
--- | ---
 `*` | MultiplyOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
IntType |  IntType |  IntType | 2 * 2 = 4
IntType | FloatType | FloatType | 2 * 1.1 = 2.2
FloatType | IntType | FloatType | 1.1 * 2 = 2.2
FloatType | FloatType | FloatType | 1.1 * 1.1 = 1.21
MoneyType | IntType | MoneyType | 2$ * 2 = 4$
MoneyType | FloatType | MoneyType | 2$ * 2.1 = 4$20

### Деление
**Знак** |  **Класс операции**
--- | ---
 `/` | DivisionOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
IntType |  IntType |  FloatType | 5 / 2 = 2.5
IntType | FloatType | FloatType | 5 * 1.1 = 2.2
FloatType | IntType | FloatType | 5 / 2.2 = 2.272727...
FloatType | FloatType | FloatType | 1.21 / 1.1 = 1.1
MoneyType | IntType | MoneyType | 2$ / 2 = 1$
MoneyType | FloatType | MoneyType | 2$ / 2.1 = $95

### Возведение в степень
**Знак** |  **Класс операции**
--- | ---
 `**` | ExponentiationOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
IntType |  IntType |  IntType | 2 ** 3 = 8
IntType | FloatType | FloatType | 2 ** 1.1 = 2.1435...
FloatType | IntType | FloatType | 2.2 ** 2 = 4.84
FloatType | FloatType | FloatType | 2.2 ** 2.2 = 5.6666...

### Остаток от деления
**Знак** |  **Класс операции**
--- | ---
 `%` | RemainderOfDivisionOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
IntType |  IntType |  IntType | 5 % 3 = 2
IntType | FloatType | IntType | 5 % 3.9 = 2
FloatType | IntType | IntType | 5.5 % 3 = 2
FloatType | FloatType | IntType | 5.5 % 3.9 = 2

### Приведение даты и времени к дате
**Знак** |  **Класс операции**
--- | ---
`{date}` | DateOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
NullType |  DateTimeType |  DateTimeType | {date} 2018.01.02 22:32:18 = 2018.01.02

### Определение числа дней в году для указанной даты
**Знак** |  **Класс операции**
--- | ---
`{days in year}` | DaysInYearOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
NullType |  DateTimeType |  IntType | {days in year} 2018.01.02 = 365<br> {days in year} 2016.01.02 = 366

### Определение числа дней во временном интервале
**Знак** |  **Класс операции**
--- | ---
`{days}` | DaysOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
NullType |  DateIntervalType |  IntType | {days} 2 days = 2<br> {days} (2016.01.03 - 2016.01.01)  = 2

##Операции сравнения

### Равно
**Знак** |  **Класс операции**
--- | ---
 `==` | EqualOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
IntType |  IntType |  BooleanType | 1 == 1 | true
IntType |  IntType |  BooleanType | 1 == 2 | false
FloatType | FloatType | BooleanType | 1.1 == 1.1 | true
FloatType | FloatType | BooleanType | 1.1 == 1.2 | false
MoneyType | MoneyType | BooleanType | 100$ == 100$ | true
MoneyType | MoneyType | BooleanType | 100$ == 200$ | false
DateIntervalType | DateIntervalType | BooleanType | 2 day == 2 day | true
DateIntervalType | DateIntervalType | BooleanType | 2 day == 3 day | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 == 2018.06.19 15:06:00 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 == 2018.06.19 15:06:01 | false

### Больше
**Знак** |  **Класс операции**
--- | ---
 `>` | GreaterOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
IntType |  IntType |  BooleanType | 3 > 2 | true
IntType |  IntType |  BooleanType | 3 > 3 | false
IntType |  IntType |  BooleanType | 3 > 4 | false
FloatType | FloatType | BooleanType | 3.14 > 3.13 | true
FloatType | FloatType | BooleanType | 3.14 > 3.14 | false
FloatType | FloatType | BooleanType | 3.14 > 3.15 | false
MoneyType | MoneyType | BooleanType | 301$ > 300$ | true
MoneyType | MoneyType | BooleanType | 300$ > 300$ | false
MoneyType | MoneyType | BooleanType | 300$ > 301$ | false
DateIntervalType | DateIntervalType | BooleanType | 6 day > 5 day | true
DateIntervalType | DateIntervalType | BooleanType | 6 day > 6 day | false
DateIntervalType | DateIntervalType | BooleanType | 6 day > 7 day | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 > 2018.06.19 15:05:59 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 > 2018.06.19 15:06:00 | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 > 2018.06.19 15:06:01 | false

### Меньше
**Знак** |  **Класс операции**
--- | ---
 `<` | LessOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
IntType |  IntType |  BooleanType | 3 < 4 | true
IntType |  IntType |  BooleanType | 3 < 3 | false
IntType |  IntType |  BooleanType | 3 < 2 | false
FloatType | FloatType | BooleanType | 3.14 < 3.15 | true
FloatType | FloatType | BooleanType | 3.14 < 3.14 | false
FloatType | FloatType | BooleanType | 3.14 < 3.13 | false
MoneyType | MoneyType | BooleanType | 300$ < 301$ | true
MoneyType | MoneyType | BooleanType | 300$ < 300$ | false
MoneyType | MoneyType | BooleanType | 301$ < 300$ | false
DateIntervalType | DateIntervalType | BooleanType | 6 day < 7 day | true
DateIntervalType | DateIntervalType | BooleanType | 6 day < 6 day | false
DateIntervalType | DateIntervalType | BooleanType | 6 day < 5 day | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 < 2018.06.19 15:06:01 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 < 2018.06.19 15:06:00 | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 < 2018.06.19 15:05:59 | false

### Больше или равно
**Знак** |  **Класс операции**
--- | ---
 `>=` | GreaterOrEqualOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
IntType |  IntType |  BooleanType | 3 >= 2 | true
IntType |  IntType |  BooleanType | 3 >= 3 | true
IntType |  IntType |  BooleanType | 3 >= 4 | false
FloatType | FloatType | BooleanType | 3.14 >= 3.13 | true
FloatType | FloatType | BooleanType | 3.14 >= 3.14 | true
FloatType | FloatType | BooleanType | 3.14 >= 3.15 | false
MoneyType | MoneyType | BooleanType | 301$ >= 300$ | true
MoneyType | MoneyType | BooleanType | 300$ >= 300$ | true
MoneyType | MoneyType | BooleanType | 300$ >= 301$ | false
DateIntervalType | DateIntervalType | BooleanType | 6 day >= 5 day | true
DateIntervalType | DateIntervalType | BooleanType | 6 day >= 6 day | true
DateIntervalType | DateIntervalType | BooleanType | 6 day >= 7 day | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 >= 2018.06.19 15:05:59 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 >= 2018.06.19 15:06:00 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 >= 2018.06.19 15:06:01 | false

### Меньше или равно
**Знак** |  **Класс операции**
--- | ---
 `<=` | LessOrEqualsOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
IntType |  IntType |  BooleanType | 3 <= 4 | true
IntType |  IntType |  BooleanType | 3 <= 3 | true
IntType |  IntType |  BooleanType | 3 <= 2 | false
FloatType | FloatType | BooleanType | 3.14 <= 3.15 | true
FloatType | FloatType | BooleanType | 3.14 <= 3.14 | true
FloatType | FloatType | BooleanType | 3.14 <= 3.13 | false
MoneyType | MoneyType | BooleanType | 300$ <= 301$ | true
MoneyType | MoneyType | BooleanType | 300$ <= 300$ | true
MoneyType | MoneyType | BooleanType | 301$ <= 300$ | false
DateIntervalType | DateIntervalType | BooleanType | 6 day <= 7 day | true
DateIntervalType | DateIntervalType | BooleanType | 6 day <= 6 day | true
DateIntervalType | DateIntervalType | BooleanType | 6 day <= 5 day | false
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 <= 2018.06.19 15:06:01 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 <= 2018.06.19 15:06:00 | true
DateTimeType | DateTimeType | BooleanType | 2018.06.19 15:06:00 <= 2018.06.19 15:05:59 | false

### Условный оператор

Выражение записывается в фигурных скобках.  
Возвращает первый аргумент, если выражение верно, и второй - если нет.

**Пример** | **Результат**
 --- | ---
{3 == 3} | 3
{3.14 == 3.14} | 3.14
{2018.06.19 15:06:00 == 2018.06.19 15:06:00} | 2018.06.19 15:06:00
{3.14 > 3.15} | 3.15
{6 day > 5 day} | 6 day
{300$ > 301$} | 301$
{3 < 4} | 3
{3.14 < 3.15} | 3.14
{2018.06.19 15:06:00 < 2018.06.19 15:06:01} | 2018.06.19 15:06:00
{3.14 >= 3.13} | 3.14
{6 day >= 7 day} | 7 day
{3 <= 2} | 2
{300$ <= 301$} | 300$

## Приоритет операций
Чем больше приоритет, тем раньше будет выполнена операция

Обозначение операции | Приоритет
--- | ---
`{date}`<br> `{days in year}`<br> `{days}`| 10
`**` | 3
`*`, `/`, `%` | 2
`+`, `-` | 1

В выражениях можно использовать скобки для изменения стандартных приоритетов

## Переменные
Переменные в выражениях должны начинаться с символа `$`, например, $creditAmount, $creditPeriod ...
Переменные могут быть типа Type (т.е. уже рассчитанные) или Expression (будут рассчитываться в момент вычисления)
Пример использования переменной можно найти в тесте: 
**TestTextExpression::testExpressionVariables**

## Пользовательские функции
В выражения можно внедрять пользовательские функции для расширения базового функционала
Пример пользовательской функции: `$annuityPayment[$yearPercent, $creditAmount, $creditMonths]`.
Название функции должно начинаться с символа `$` и иметь набор параметров, заключённых в квадратные скобки, если параметров нет, то скобки `[]` всё-равно должны присутствовать.
В качестве параметров функции могут использоваться переменные, выражения и типы.
При объявлении пользовательской функции в качестве параметров и возвращаемого значения необходимо использовать типы или выражения.
Пример использования пользовательской функции можно найти в тесте: 
**TestTextExpression::testExpressionFunctions**