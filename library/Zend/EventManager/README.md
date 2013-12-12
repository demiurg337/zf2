EventManager Component from ZF2
===============================

This is the EventManager component for ZF2.

- File issues at https://github.com/zendframework/zf2/issues
- Create pull requests against https://github.com/zendframework/zf2
- Documentation is at http://framework.zend.com/docs

LICENSE
-------

The files in this archive are released under the [Zend Framework
license](http://framework.zend.com/license), which is a 3-clause BSD license.


-------------------------------------------------------------
Коментарии:

- Каждое событие ето отжедьный объект (Zend\EventManager\Event), слабая связаность.

- Много используеться интефрейсов один интерфес разшыряет другой интерфейс EventManagerInterface extends SharedEventManagerAwareInterface

- StaticEventManager (extends SharedEventManager) просто синглтон надстройка. 
    + Для Синглтона правильно дэлать конструктор protected.
    + Еще делать приватным __Clone чтобы не можно было клонировать объект.
    
    /**
     * Singleton
     */
    protected function __construct()
    {
    }

    /**
     * Singleton
     *
     * @return void
     */
    private function __clone()
    {

- Часто в методах проверяется правильный ли аргумент передан (ето наверное потому что php слабо типизированый
        
        // Null callback is invalid
        if (null === $callback) {
            throw new Exception\InvalidArgumentException(sprintf(
                '%s: expects a callback; none provided',
                __METHOD__
            ));
        }
        ==========
        if (!is_array($params) && !is_object($params)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Event parameters must be an array or object; received "%s"', gettype($params)
            ));
        }
- Часто видил чтобы в параметрах задавалось значение по умолчанию, которое возвращается. 
    public function getParam($name, $default = null)
    Здесь ето - $default = null
- Часто проверка осуществляется когда на первое место ставиться null (или false ...)        
        if (null !== $params) {
        
- !!!!!!!!!!!!! Метод вызывает сам себя !!!!!!!!!!!!
    public function attach($event, $callback = null, $priority = 1)
    {
        ...
        if (is_array($event)) {
            $listeners = array();
            foreach ($event as $name) {
                $listeners[] = $this->attach($name, $callback, $priority);
            }
            return $listeners;
        }
        ...
    }

- Результат возвращается как отдельный объект, поскольку можно возвраащать массив результатов откликов
- Даже объекты с глобальной области видимости рекомендовано оглашать через use
use ArrayAccess;
use ArrayObject;

