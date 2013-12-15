HTTP Component from ZF2
=======================

This is the HTTP component for ZF2.

- File issues at https://github.com/zendframework/zf2/issues
- Create pull requests against https://github.com/zendframework/zf2
- Documentation is at http://framework.zend.com/docs

LICENSE
-------

The files in this archive are released under the [Zend Framework
license](http://framework.zend.com/license), which is a 3-clause BSD license.

-----------------------------------------------------------------------------
- всезаголовки бурутся через метод getHeaders() (в класах Response и Request)
    Но сам с заголовками работае сам клас. Клас инициализируется только раз
        //проверка
        if ($this->headers === null || is_string($this->headers)) {

    Как етот прием называется

- Есть свой клиет для осуществления запросов на другой сервер (работае вреде на Curl)

- Adapter, Proxy, Socket - паттерны адаптеры.

- Адаптер Test можно использовать для тестов, чтобы имитировать запросы. 
- Можно легко создавать свой адаптер. Он полюбом должен реализовать AdapterInterface.

- Можно инициализировать несколько запросов за один раз.

Потом доделать ... (простые адаптеры)
