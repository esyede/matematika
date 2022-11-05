# matematika

Simple mathematical equation parser for PHP.


#### Installation

```sh
composer require esyede/matematika
```

#### Usage

```php
require __DIR__ . '/vendor/autoload.php';

$math = new Esyede\Matematika\Math();

// Positive Integer Tests

var_dump($math->evaluate('10 / 5'));                      echo '<br><br>'; // int(2)
var_dump($math->evaluate('(2 + 3) * 4'));                 echo '<br><br>'; // int(20)
var_dump($math->evaluate('1 + 2 * ((3 + 4) * 5 + 6)'));   echo '<br><br>'; // int(83)
var_dump($math->evaluate('9 * (3+8) - 6 - 45'));          echo '<br><br>'; // int(48)
var_dump($math->evaluate('1 * 2 + ((3 + 4) * 5 + 6)'));   echo '<br><br>'; // int(43)
var_dump($math->evaluate('(1 + 2) * (3 + 4) * (5 + 6)')); echo '<br><br>'; // int(231)

$math->put('a', 4);
var_dump($math->evaluate('($a + 3) * 4')); echo '<br><br>'; // int(28)

$math->put('a', 5);
var_dump($math->evaluate('($a + $a) * 4')); echo '<br><br>'; // int(40)

// Float Tests

var_dump($math->evaluate('1.45 + 3'));                                 echo '<br><br>'; // float(4.45)
var_dump($math->evaluate('0.45 + 3.5'));                               echo '<br><br>'; // float(3.95)
var_dump($math->evaluate('10.6 / 1.2'));                               echo '<br><br>'; // float(8.83333333333)
var_dump($math->evaluate('(1.65 + 2) * (3.1415 + 4) * (5 + 6.8989)')); echo '<br><br>';
// float(310.162379378) (but 310.1623793775 in Apple and Windows Calculators)

$math->put('a', 5.36464);
var_dump($math->evaluate('($a + $a) * 4')); echo '<br><br>'; // float(42.91712)


// Negative Unary Operator Tests

var_dump($math->evaluate('3 - -3'));                      echo '<br><br>'; // int(6)
var_dump($math->evaluate('-2 + -3'));                     echo '<br><br>'; // int(-5)
var_dump($math->evaluate('-2.5 / 0.5'));                  echo '<br><br>'; // float(-5)
var_dump($math->evaluate('-9 * (-3+8) - 6 - -45'));       echo '<br><br>'; // int(-6)
var_dump($math->evaluate('(10 / 5 * -(1 + 2))'));         echo '<br><br>'; // int(-6)
var_dump($math->evaluate('-7.3 * (-3.2+8) - 6 - -45.5')); echo '<br><br>'; // float(4.460000000000001)

$math->put('a', - 5.5);
var_dump($math->evaluate('($a + $a) * 4')); echo '<br><br>'; // float(-44)


// Variable Name With Number Test

$math->put('a1', 5)->put('a2', 5);
var_dump($math->evaluate('($a1 + $a2) * 4')); echo '<br><br>'; // int(40)

// Math Functions Test

$math->put('a', 5);
var_dump($math->evaluate('10 + CEIL($a / 4)'));  echo '<br><br>'; // int(12)
var_dump($math->evaluate('10 + FLOOR($a / 4)')); echo '<br><br>'; // int(11)

$math->put('a', 9);
var_dump($math->evaluate('10 + SQRT($a)')); echo '<br><br>'; // int(13)

$math->put('a', 10);
var_dump($math->evaluate('10 + CEIL(SQRT($a))')); echo '<br><br>'; // int(14)
```
