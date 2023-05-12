<?php

/**
 * @charset UTF-8
 *
 * Задание 3
 * В данный момент компания X работает с двумя перевозчиками
 * 1. Почта России
 * 2. DHL
 * У каждого перевозчика своя формула расчета стоимости доставки посылки
 * Почта России до 10 кг берет 100 руб, все что cвыше 10 кг берет 1000 руб
 * DHL за каждый 1 кг берет 100 руб
 * Задача:
 * Необходимо описать архитектуру на php из методов или классов для работы с
 * перевозчиками на предмет получения стоимости доставки по каждому из указанных
 * перевозчиков, согласно данным формулам.
 * При разработке нужно учесть, что количество перевозчиков со временем может
 * возрасти. И делать расчет для новых перевозчиков будут уже другие программисты.
 * Поэтому необходимо построить архитектуру так, чтобы максимально минимизировать
 * ошибки программиста, который будет в дальнейшем делать расчет для нового
 * перевозчика, а также того, кто будет пользоваться данным архитектурным решением.
 *
 */

# Использовать данные:
# любые

/**
 * Абстрактный класс компании
 */
abstract class Company {
  abstract public function __construct();
  abstract public function set_title(string $title) : void;
  abstract public function get_title() : string;
  abstract public function get_cost(int $weight) : int;
}

/**
 * Класс компании "Почта России"
 * 
 * @property string $title Заголовок компании
 * 
 * @method void __construct() Конструктор класса
 * @method string get_title() Получение заголовка компании
 * @method void set_title(string $title) Задать заголовок компании
 * @method int get_cost(int $weight)  Получить стоимость за вес
 */
class CompanyMailRussia extends Company {
  private string $title;
  
  public function __construct() {
    // ...
  }

  /**
   * Получение заголовка компании
   * 
   * @return string Заголовок компании
   */
  public function get_title() : string {
    return $this->title;
  }

  /**
   * Задать заголовок компании
   */
  public function set_title(string $title) : void {
    $this->title = $title;
  }

  /**
   * Получить стоимость за вес
   * 
   * @param int $weight Вес груза
   * 
   * @return int Стоимость перевозки
   */
  public function get_cost(int $weight) : int {
    return ($weight < 10) ? 100 : 1000;
  }
}

/**
 * Класс компании "DHL"
 * 
 * @property string $title Заголовок компании
 * 
 * @method void __construct() Конструктор класса
 * @method string get_title() Получение заголовка компании
 * @method void set_title(string $title) Задать заголовок компании
 * @method int get_cost(int $weight)  Получить стоимость за вес
 */
class CompanyDHL extends Company {
  private string $title;
  
  public function __construct() {
    // ...
  }

  /**
   * Получение заголовка компании
   * 
   * @return string Заголовок компании
   */
  public function get_title() : string {
    return $this->title;
  }

  /**
   * Задать заголовок компании
   */
  public function set_title(string $title) : void {
    $this->title = $title;
  }

  /**
   * Получить стоимость за вес
   * 
   * @param int $weight Вес груза
   * 
   * @return int Стоимость перевозки
   */
  public function get_cost(int $weight) : int {
    return $weight * 100;
  }
}

// Тестирование

/**
 * @var CompanyMailRussia $company_mail_russia Экземпляр класса CompanyMailRussia
 */
$company_mail_russia = new CompanyMailRussia();
// Задаем заголовок компании
$company_mail_russia->set_title('Почта России');

/**
 * @var array $company_mail_russia_test Массив с данными о весе грузов
 */
$company_mail_russia_test = [2, 6, 10, 24];
foreach ($company_mail_russia_test as $weight) {
  echo sprintf('%s: %d рублей за %dкг', $company_mail_russia->get_title(), $company_mail_russia->get_cost($weight), $weight) . PHP_EOL;
}

/**
 * @var CompanyDHL $company_dhl Экземпляр класса CompanyDHL
 */
$company_dhl = new CompanyDHL();
// Задаем заголовок компании
$company_dhl->set_title('DHL');

/**
 * @var array $company_dhl_test Массив с данными о весе грузов
 */
$company_dhl_test = [2, 6, 10, 24];
foreach ($company_dhl_test as $weight) {
  echo sprintf('%s: %d рублей за %dкг', $company_dhl->get_title(), $company_dhl->get_cost($weight), $weight) . PHP_EOL;
}

?>