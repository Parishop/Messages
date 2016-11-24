# Messages

Уведомления для PHPixie 3

Данная библиотека позволяет выводить уведомления в шаблоне

## Установка
1 Подключаем библиотеку
```sh
composer require parishop/messages:~1.0
```
2 Добавляем расширение для шаблона
```php
// /src/Project/Framework/Extensions.php
    public function templateExtensions()
    {
        return array_merge(
            parent::templateExtensions(), array(
                new \Parishop\Messages($this->builder->context()->httpContext()),
            )
        );
    }
```
3 Добавляем расширение в проект
```php
// /bundles/app/src/Project/App/Builder.php
    /**
     * @return \Parishop\Messages
     */
    public function messages()
    {
        return $this->components()->template->builder()->extensions()->get('messages');
    }
```

## Использование

### В Процессоре
Доступны все методы класса \Psr\Log\LoggerTrait для всех уровней класса \Psr\Log\LogLevel

1. LogLevel::EMERGENCY
    ```php
        $this->builder->messages()->emergency($message, array $context = array())
     ```
     
2. LogLevel::ALERT
    ```php
        $this->builder->messages()->alert($message, array $context = array())
     ```
     
3. LogLevel::CRITICAL
    ```php
        $this->builder->messages()->critical($message, array $context = array())
     ```
     
4. LogLevel::ERROR
    ```php
        $this->builder->messages()->error($message, array $context = array())
     ```
     
5. LogLevel::WARNING
    ```php
        $this->builder->messages()->warning($message, array $context = array())
     ```
     
6. LogLevel::NOTICE
    ```php
        $this->builder->messages()->notice($message, array $context = array())
     ```
     
7. LogLevel::INFO
    ```php
        $this->builder->messages()->info($message, array $context = array())
     ```
     
8. LogLevel::DEBUG
    ```php
        $this->builder->messages()->debug($message, array $context = array())
     ```
     
9. Отдельный уровень danger
    ```php
        $this->builder->messages()->danger($message, array $context = array())
     ```
     
10. А так же общий метод с любым уровнем
    ```php
        $this->builder->messages()->log($level, $message, array $context = array())
     ```
     
### В Шаблоне
```php
<?php foreach($this->messages() as $message){ ?>
    <div class="alert alert-<?= $message->level(); ?>">
        <?= $message; ?>
    </div>
<?php } ?>
```
