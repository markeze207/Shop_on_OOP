<?php

// Область видимости
// public - общедоступный, везде можно
// protected - только в классе, наследователей и родителей
// private - только в самом классе, где он был вызван



class MyClass
{
    public string $public = 'Public';  // Можно вызывать отовсюду
    protected string $protected = 'Protected'; // Разрешен только самому классу, наследователем и родителям
    private string $private = 'Private'; // Разрешен только в самом классе

    function printHello(): void
    {
        echo $this->public;
        echo $this->protected;
        echo $this->private;
    }
}

$obj = new MyClass();
echo $obj->public; // Мы можем его вывести, так как он общедоступный
// Остальные же мы не можем вызвать в общем доступе, так как они закрытые
// Мы их можем выводить только путем функций, т.е в нашем случае через printHello()

/**
 * Определение MyClass2
 */
class MyClass2 extends MyClass
{
    // Мы можем переопределить общедоступные и защищённые свойства, но не закрытые
    public string $public = 'Public2'; // Мы его можем переопределить, так как он общедоступный
    protected string $protected = 'Protected2'; // Мы его можем переопределить, так как он защищенный

    function printHello()
    {
        echo $this->public; // Мы его можем вывести, так как он защищенный и мы унаследовали первый класс
        echo $this->protected; // Мы его можем вывести, так как он защищенный и мы унаследовали первый класс
        echo $this->private; // Мы его не можем вывести, так как он закрытый и к нему имеет доступ только класс, где он был создан
    }
}

$obj2 = new MyClass2();
echo $obj2->public; // Работает
echo $obj2->private; // Неопределён, так как его вовсе нет в нашем втором классе
echo $obj2->protected; // Неисправимая ошибка, так как мы не можем вызвать защищенную переменную
$obj2->printHello(); // Выводит Public2, Protected2, Undefined, так как закрытой переменной у нас нет и она не унаследовалась



