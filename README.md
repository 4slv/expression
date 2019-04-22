# Expression  
  
Модуль **4slovo/expression** позволяет преобразовывать псевдокод в php-код, это позволяет:
1) вынести бизнес логику на конфигурационный уровень
2) ограничить языковые конструкции до разрешённых в псевдокоде
3) упрощать синтаксис операций (например, для сложения дат можно использовать операцию +)


Пример, формулу расчёта площади круга можно записать как:  
```
$area = 3.14 * ($radius ** 2);
```  
что будет преобразовано в php-код, производящий расчёт площади круга в зависимости от  
переданной переменной **$radius**  

Пример:
```php  
$expressionText = '$radius = 2; $area = 3.14 * ($radius ** 2);';
$codeContext = new CodeContext();
$codeExecutor = new CodeExecutor();
$variableName = '$result';
$areaResult = $codeExecutor
    ->setCode($expressionText)
    ->setCodeContext($codeContext)
    ->execute()
    ->getVariableByName('$area');

echo $areaResult; # выведет 12.56  
```  
## Поддерживаемые операции 
### Сложение
**Знак** |  **Класс операции**
--- | ---
 `+` | addOperation
 
#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
int |  int |  int | 1 + 1 == 2
int | float | float | 1 + 1.1 == 2.1
float | int | float | 1.1 + 1 == 2.1
float | float | float | 1.1 + 1.2 == 2.3
money | money | money | 1$ + 2$20 == 3$20
dateInterval | dateInterval | dateInterval | 1 day + 2 days == 3 days
dateInterval | dateTime | dateTime | 1 day + 2018.01.02 == 2018.01.03
dateTime | dateInterval | dateTime | 2018.01.02 + 1 day == 2018.01.03

### Вычитание
**Знак** |  **Класс операции**
--- | ---
 `-` | SubtractionOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
int |  int |  int | 2 - 1 == 1
int | float | float | 2 - 1.1 == 0.9
float | int | float | 1.1 - 2 == -0.9
float | float | float | 2.2 - 1.1 == 1.1
money | money | money | 2$ - 1$ == 1$
dateInterval | dateInterval | dateInterval | 2 day - 1 day == 1 day
dateTime | dateTime | dateInterval | 2018.01.02 - 2018.01.01 == 1 day
dateTime | dateInterval | dateTime | 2018.01.02 - 1 day == 2018.01.01

### Умножение
**Знак** |  **Класс операции**
--- | ---
 `*` | MultiplyOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
int |  int |  int | 2 * 2 == 4
int | float | float | 2 * 1.1 == 2.2
float | int | float | 1.1 * 2 == 2.2
float | float | float | 1.1 * 1.1 == 1.21
money | int | money | 2$ * 2 == 4$
money | float | money | 2$ * 2.1 == 4$20

### Деление
**Знак** |  **Класс операции**
--- | ---
 `/` | DivisionOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
int |  int |  float | 5 / 2 == 2.5
int | float | float | 5 * 1.1 == 2.2
float | int | float | 5 / 2.2 == 2.272727...
float | float | float | 1.21 / 1.1 == 1.1
money | int | money | 2$ / 2 == 1$
money | float | money | 2$ / 2.1 == $95

### Возведение в степень
**Знак** |  **Класс операции**
--- | ---
 `**` | ExponentiationOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
int |  int |  int | 2 ** 3 == 8
int | float | float | 2 ** 1.1 == 2.1435...
float | int | float | 2.2 ** 2 == 4.84
float | float | float | 2.2 ** 2.2 == 5.6666...

### Остаток от деления
**Знак** |  **Класс операции**
--- | ---
 `%` | RemainderOfDivisionOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример**
 --- | --- | --- | ---
int |  int |  int | 5 % 3 == 2
int | float | int | 5 % 3.9 == 2
float | int | int | 5.5 % 3 == 2
float | float | int | 5.5 % 3.9 == 2

##Операции сравнения

### Равно
**Знак** |  **Класс операции**
--- | ---
 `==` | EqualOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
int |  int |  boolean | 1 == 1 | true
int |  int |  boolean | 1 == 2 | false
float | float | boolean | 1.1 == 1.1 | true
float | float | boolean | 1.1 == 1.2 | false
money | money | boolean | 100$ == 100$ | true
money | money | boolean | 100$ == 200$ | false
dateInterval | dateInterval | boolean | 2 day == 2 day | true
dateInterval | dateInterval | boolean | 2 day == 3 day | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 == 2018.06.19 15:06:00 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 == 2018.06.19 15:06:01 | false
string | string | boolean | 'a' == 'a' | true
string | string | boolean | 'a' == 'b' | false

### Не равно
**Знак** |  **Класс операции**
--- | ---
 `!=` | EqualOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
int |  int |  boolean | 1 != 1 | false
int |  int |  boolean | 1 != 2 | true
float | float | boolean | 1.1 != 1.1 | false
float | float | boolean | 1.1 != 1.2 | true
money | money | boolean | 100$ != 100$ | false
money | money | boolean | 100$ != 200$ | true
dateInterval | dateInterval | boolean | 2 day != 2 day | false
dateInterval | dateInterval | boolean | 2 day != 3 day | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 != 2018.06.19 15:06:00 | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 != 2018.06.19 15:06:01 | true
string | string | boolean | 'a' != 'a' | false
string | string | boolean | 'a' != 'b' | true

### Больше
**Знак** |  **Класс операции**
--- | ---
 `>` | GreaterOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
int |  int |  boolean | 3 > 2 | true
int |  int |  boolean | 3 > 3 | false
int |  int |  boolean | 3 > 4 | false
float | float | boolean | 3.14 > 3.13 | true
float | float | boolean | 3.14 > 3.14 | false
float | float | boolean | 3.14 > 3.15 | false
money | money | boolean | 301$ > 300$ | true
money | money | boolean | 300$ > 300$ | false
money | money | boolean | 300$ > 301$ | false
dateInterval | dateInterval | boolean | 6 day > 5 day | true
dateInterval | dateInterval | boolean | 6 day > 6 day | false
dateInterval | dateInterval | boolean | 6 day > 7 day | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 > 2018.06.19 15:05:59 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 > 2018.06.19 15:06:00 | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 > 2018.06.19 15:06:01 | false
string | string | boolean | 'a' > 'a' | false
string | string | boolean | 'a' > 'b' | false
string | string | boolean | 'b' > 'a' | true

### Меньше
**Знак** |  **Класс операции**
--- | ---
 `<` | LessOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
int |  int |  boolean | 3 < 4 | true
int |  int |  boolean | 3 < 3 | false
int |  int |  boolean | 3 < 2 | false
float | float | boolean | 3.14 < 3.15 | true
float | float | boolean | 3.14 < 3.14 | false
float | float | boolean | 3.14 < 3.13 | false
money | money | boolean | 300$ < 301$ | true
money | money | boolean | 300$ < 300$ | false
money | money | boolean | 301$ < 300$ | false
dateInterval | dateInterval | boolean | 6 day < 7 day | true
dateInterval | dateInterval | boolean | 6 day < 6 day | false
dateInterval | dateInterval | boolean | 6 day < 5 day | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 < 2018.06.19 15:06:01 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 < 2018.06.19 15:06:00 | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 < 2018.06.19 15:05:59 | false
string | string | boolean | 'a' < 'a' | false
string | string | boolean | 'a' < 'b' | true
string | string | boolean | 'b' < 'a' | false

### Больше или равно
**Знак** |  **Класс операции**
--- | ---
 `>=` | GreaterOrEqualOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
int |  int |  boolean | 3 >= 2 | true
int |  int |  boolean | 3 >= 3 | true
int |  int |  boolean | 3 >= 4 | false
float | float | boolean | 3.14 >= 3.13 | true
float | float | boolean | 3.14 >= 3.14 | true
float | float | boolean | 3.14 >= 3.15 | false
money | money | boolean | 301$ >= 300$ | true
money | money | boolean | 300$ >= 300$ | true
money | money | boolean | 300$ >= 301$ | false
dateInterval | dateInterval | boolean | 6 day >= 5 day | true
dateInterval | dateInterval | boolean | 6 day >= 6 day | true
dateInterval | dateInterval | boolean | 6 day >= 7 day | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 >= 2018.06.19 15:05:59 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 >= 2018.06.19 15:06:00 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 >= 2018.06.19 15:06:01 | false
string | string | boolean | 'a' >= 'a' | true
string | string | boolean | 'a' >= 'b' | false
string | string | boolean | 'b' >= 'a' | true

### Меньше или равно
**Знак** |  **Класс операции**
--- | ---
 `<=` | LessOrEqualsOperation

#### Допустимые операции с типами
**Тип левого операнда** | **Тип правого операнда** | **Тип результата** | **Пример** | **Результат**
 --- | --- | --- | --- | ---
int |  int |  boolean | 3 <= 4 | true
int |  int |  boolean | 3 <= 3 | true
int |  int |  boolean | 3 <= 2 | false
float | float | boolean | 3.14 <= 3.15 | true
float | float | boolean | 3.14 <= 3.14 | true
float | float | boolean | 3.14 <= 3.13 | false
money | money | boolean | 300$ <= 301$ | true
money | money | boolean | 300$ <= 300$ | true
money | money | boolean | 301$ <= 300$ | false
dateInterval | dateInterval | boolean | 6 day <= 7 day | true
dateInterval | dateInterval | boolean | 6 day <= 6 day | true
dateInterval | dateInterval | boolean | 6 day <= 5 day | false
dateTime | dateTime | boolean | 2018.06.19 15:06:00 <= 2018.06.19 15:06:01 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 <= 2018.06.19 15:06:00 | true
dateTime | dateTime | boolean | 2018.06.19 15:06:00 <= 2018.06.19 15:05:59 | false
string | string | boolean | 'a' <= 'a' | true
string | string | boolean | 'a' <= 'b' | true
string | string | boolean | 'b' <= 'a' | false

## Встроенные функции

### date - приведение даты и времени к дате
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
dateTime |  dateTime | (dateTime) date(2018.01.02 22:32:18) == 2018.01.02

### daysInYear - определение числа дней в году для указанной даты
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
dateTime |  int | (int) daysInYear(2018.01.02) == 365<br> (int) daysInYear(2016.01.02) == 366

### days - определение числа дней во временном интервале
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
dateInterval |  int | (int) days(2 days) == 2<br> (int) days(2016.01.03 - 2016.01.01) == 2
int |  dateInterval | (dateInterval) days(1) == 1 day

### firstYearDay - преобразование даты в дату первого числа года
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
dateTime |  dateTime | (dateTime) firstYearDay(2018.06.12 08:56:10) == 2018.01.01 00:00:00

### int - преобразование числа с плавающей точкой в целое число
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
float |  int | int(1.1) == 1
float |  int | int(3.9) == 3
money | int | int(1$01) == 101

### money - преобразование числа в деньги
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
float |  money | money(100.1) == 1$
int |  money | money(100) == 1$

### min - определение минимального значения
#### Допустимые операции с типами
**Тип параметра 1** | **Тип параметра N** | **Тип результата** | **Пример**
--- | --- | --- | ---
int |  int | int | (int) min(3,1,2) == 1
float |  float | float | (float) min(3.1, 1.2, 2.3) == 1.2
money | money | money | (money) min(3$, 1$, 2$) == $1
dateTime | dateTime | dateTime | (dateTime) min(2018.01.01, 2019.01.01, 2015.01.01) == 2015.01.01
dateInterval | dateInterval | dateInterval | (dateInterval) min(3 days, 1 day, 2 days) == 1 day

### max - определение минимального значения
#### Допустимые операции с типами
**Тип параметра 1** | **Тип параметра N** | **Тип результата** | **Пример**
--- | --- | --- | ---
int |  int | int | (int) max(3,1,2) == 3
float |  float | float | (float) max(3.1, 1.2, 2.3) == 3.1
money | money | money | (money) max(3$, 1$, 2$) == $3
dateTime | dateTime | dateTime | (dateTime) max(2018.01.01, 2019.01.01, 2015.01.01) == 2019.01.01
dateInterval | dateInterval | dateInterval | (dateInterval) max(3 days, 1 day, 2 days) == 3 days

### isNull - определение является ли значение нулевым
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
null | boolean | (boolean) isNull(null) == true
int |  boolean | (boolean) isNull(3) == false
float |  boolean | (boolean) isNull(3.1) == false
money | boolean | (boolean) isNull(3$) == false
dateTime | boolean | (boolean) isNull(2018.01.01) == false
dateInterval | boolean | (boolean) isNull(3 days) == false

### isNotNull - определение является ли значение не нулевым
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
null | boolean | (boolean) isNull(null) == false
int |  boolean | (boolean) isNull(3) == true
float |  boolean | (boolean) isNull(3.1) == true
money | boolean | (boolean) isNull(3$) == true
dateTime | boolean | (boolean) isNull(2018.01.01) == true
dateInterval | boolean | (boolean) isNull(3 days) == true

### floor - округление до ближайшего меньшего целого (для денег до мажорных единиц)
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
float | float | (int) floor(100.23) == 100
money |  money | (money) floor(1$23) == 1$

### ceil - округление до ближайшего большего целого (для денег до мажорных единиц)
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
float | float | (int) ceil(100.23) == 101
money |  money | (money) ceil(1$23) == 2$

### round - округление по математическим правилам (для денег до мажорных единиц)
#### Допустимые операции с типами
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
float | float | (int) round(100.5) == 101
money |  money | (money) round(1$50) == 2$

### printR - вывод значения в формате print_r
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
произвольный тип | null | printR(1); // выведет 1

### varDump - вывод значения в формате var_dump
**Тип параметра** | **Тип результата** | **Пример**
--- | --- | ---
произвольный тип | null | varDump(1); // выведет int(1)

## Встроенные функции для работы с массивами

### array - создание массива
**Тип параметра 1** | **Тип параметра N** | **Тип результата** | **Пример**
--- | --- | --- | ---
произвольный тип | произвольный тип | array | array(1$, 2.0, 3);

### getArrayValue - получение значения из массива по ключу
**Тип параметра 1** | **Тип параметра 2** | **Тип результата** | **Пример**
--- | --- | --- | ---
array | int или string (ключ) | произвольный тип (значение) | $list = array(1, 2, 3);<br>$result = (int)getArrayValue($list, 2); <br>// переменная $result будет содержать значение 3его элемента массива

### setArrayValue - установка значения в массив по ключу
**Тип параметра 1** | **Тип параметра 2** | **Тип параметра 3** | **Тип результата** | **Пример**
--- | --- | --- | --- | ---
array | int или string (ключ) | произвольный тип (значение) | null | $list = array(1, 2, 3);<br>setArrayValue($list, 2, 5); <br>// 3ий элемент массива будет содержать значение 5

### arrayKeyExists - проверка существования ключа в массиве
**Тип параметра 1** | **Тип параметра 2** | **Тип результата** | **Пример**
--- | --- | --- | ---
int или string (ключ) | array | boolean | $list = array(1, 2, 3); <br>$resultTrue = arrayKeyExists(0, $list);<br>$resultFalse = arrayKeyExists(3, $list);

### reset - сброс указателя массива на первый элемент
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | произвольный тип (значение) | $list = array(1, 2, 3); <br> $firstElement = (int) reset($list);<br> // $firstElement = 1

### end - сброс указателя массива на последний элемент
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | произвольный тип (значение) | $list = array(1, 2, 3); <br> $lastElement = (int) end($list);<br> // $lastElement = 3

### next - передвинуть указатель массива вперёд
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | произвольный тип (значение) | $list = array(1, 2, 3); <br> $secondElement = (int) next($list);<br> // $secondElement = 2

### prev - передвинуть указатель массива назад
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | произвольный тип (значение) | $list = array(1, 2, 3, 4); <br> end($list); <br> $thirdElement = (int) prev($list);<br> // $thirdElement = 3

### key - получение ключа элемента на котором находится указатель массива
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | int или string (или null если указатель находится вне массива) |  $list = array(1, 2, 3, 4); <br> $firstElementKey = key($list);<br> // $firstElementKey = 0

### count - определение размера массива
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | int | $list = array(1, 2, 3);<br> $listSize = (int) count($list);<br> // $listSize = 3

### arrayKeys - получение ключей массива
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | array | $list = (array) arrayKeys(array(1, 3, 2)); // $list = array(0, 1, 2)

### sort - сортировка элементы массива в порядке возрастания
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | array | $list = (array) sort(array(1, 3, 2)); // $list = array(1, 2, 3)

### rsort - сортировка элементы массива в порядке убывания
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | array | $list = (array) rsort(array(1, 3, 2)); // $list = array(3, 2, 1)

### asort - сортировка ключей массива в порядке возрастания
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | array | $list = (array) arrayKeys(asort(array(1, 3, 2))); // $list = array(0, 2, 1)

### arsort - сортировка ключей массива в порядке убывания
**Тип параметра 1** | **Тип результата** | **Пример**
--- | --- | ---
array | array | $list = (array) arrayKeys(arsort(array(1, 3, 2))); // $list = array(0, 2, 1)

## Присваивание
**Пример** | **Результат**
 --- | ---
$a = 1; | создаётся переменная $a со значением 1
$i = 1; $i = $i + 1; | создаётся переменная $i со значением 1, а затем инициализируется значением 2

### Тернарный условный оператор

**Пример** | **Результат**
 --- | ---
1 > 2 ? 1 : 2 | 2
1 < 2 ? 1 : 2 | 1
1 < 2 && 2 < 3 ? 1 : 2 | 1
1 < 2 && 2 > 3 ? 1 : 2 | 2
1 < 2 ? 1 + 1 : 2 + 2 | 2
1 > 2 ? 1 + 1 : 2 + 2 | 4

### Условный оператор if
**синтаксис:**<br>
**if**(conditionExpression){ doStatementList }<br>
, где<br>
**conditionExpression** - логическое выражение, пока оно возвращает true - цикл не завершается<br>
**doStatementList** - список инструкций который необходимо многократно выполнить<br>

**Пример** | **Результат**
--- | ----
if(1 > 2) { $a = 1; } | переменная $a будет содержать значение 1

### Цикл for

**синтаксис:**<br>
**for**(firstStatement; conditionExpression, eachStepStatement){ doStatementList }<br>
, где<br>
**firstStatement** - инструкция выполняющаяся первой<br>
**conditionExpression** - логическое выражение, пока оно возвращает true - цикл не завершается<br>
**eachStepStatement** - инструкция выполняющаяся каждый шаг<br>
**doStatementList** - список инструкций который необходимо многократно выполнить<br>

**Пример** | **Результат**
--- | ----
for($i = 1; $i < 10; $i = $i + 1) { $a = $i; } | переменная $a будет содержать значение 9


## Приоритет операций
Чем больше приоритет, тем раньше будет выполнена операция

Обозначение операции | Приоритет
--- | ---
`!` | 17
`*`, `/`, `%` | 16
`+`, `-` | 15
`>`<br> `>=`<br> `<`<br> `<=`| 13
`==` | 12
`&&` | 8
`\|\|` | 7
`=` | 4

В выражениях можно использовать скобки для изменения стандартных приоритетов

## Переменные
Переменные в выражениях должны начинаться с символа `$`, например, $creditAmount, $creditPeriod ...

## Типы
Поддерживается работа с типами: boolean, int, float, money, dateTime, dateInterval, null, string

## Пользовательские функции
В выражения можно внедрять пользовательские функции для расширения базового функционала
Пример пользовательской функции: `(money) annuityPayment($yearPercent, $creditAmount, $creditMonths)`.
Название функции должно начинаться с указания возвращаемого типа и иметь набор параметров, заключённых в круглые скобки,
если параметров нет, то скобки `()` всё-равно должны присутствовать.
В качестве параметров функции могут использоваться переменные, выражения и типы.
Пример использования пользовательской функции можно найти в тесте: 
**TestExpression::testExpressionFunction**

## Комментарии
**синтаксис:**<br>
/\* многострочный комментарий \*/

**Пример** | **Результат**
 --- | ---
/\* Пример \*/ 1 + 1 /\* комментария \*/ | 2
