<?php

/**
 * Определение MyClass
 */
class MyClass
{
    // Объявление общедоступного конструктора
    public function __construct() { }

    // Объявление общедоступного метода
    public function MyPublic() { }

    // Объявление защищённого метода
    protected function MyProtected() { }

    // Объявление закрытого метода
    private function MyPrivate() { }

    // Это общедоступный метод
    function Foo()
    {
        $this->MyPublic();
        $this->MyProtected();
        $this->MyPrivate();
    }
}

$myclass = new MyClass;
$myclass->MyPublic(); // Работает
$myclass->MyProtected(); // Неисправимая ошибка, так как он защищенный и мы не можем его вызывать
$myclass->MyPrivate(); // Неисправимая ошибка, так как он закрытый и мы не можем его вызывать
$myclass->Foo(); // Работает общедоступный, защищённый и закрытый


/**
 * Определение MyClass2
 */
class MyClass2 extends MyClass
{
    // Это общедоступный метод
    function Foo2()
    {
        $this->MyPublic();
        $this->MyProtected();
        $this->MyPrivate(); // Неисправимая ошибка, потому-что закрытые методы не наследуются и можно юзать только в род. классе
    }
}

$myclass2 = new MyClass2;
$myclass2->MyPublic(); // Работает
$myclass2->MyProtected(); // Не работает, потому-что вызывать защищенный и закрытый метод - нельзя
$myclass2->Foo2(); // Работает общедоступный и защищённый, закрытый не работает, потому-что у нас его нет из-за наследования

class Bar
{
    public function test(): void
    {
        $this->testPrivate();
        $this->testPublic();
    }

    public function testPublic() {
        echo "Bar::testPublic\n";
    }

    protected function textProtected()
    {
        echo '1';
    }

    private function testPrivate() {
        echo "Bar::testPrivate\n";
    }
}

class Foo extends Bar
{
    public function testPublic() {
        echo "Foo::testPublic\n";
    }


    private function testPrivate() { // Мы не сможем его переопределить и вызвать, так как он приватный
        echo "Foo::testPrivate\n";
    }
}

$myFoo = new Foo();
$myFoo->test(); // Bar::testPrivate
// Foo::testPublic