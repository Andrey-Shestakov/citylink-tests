<?php

/**
 * @charset UTF-8
 *
 * Задание 1. Работа с массивами.
 *
 * Есть 2 списка: общий список районов и список районов, которые связаны между собой по географии (соседние районы).
 * Есть список сотрудников, которые работают в определённых районах.
 *
 * Необходимо написать функцию, что выдаст ближайшего сотрудника к искомому району. 
 * Если в списке районов, нет прямого совпадения, то должно искать дальше по соседним районам.
 * Необязательное усложение: выдавать список из сотрудников по близости к искомой функции.
 *
 * Функция должна принимать 1 аргумент: название района (строка).
 * Возвращать: логин сотрудника или null.
 *
 */

/**
 * Класс сотрудника
 *
 * @property int $id Идентификатор сотрудника
 * @property string $login Логин сотрудника
 * @property string $area_name Наименование сотрудника
 *	
 * @method void __construct() Конструктор класса
 * @method int get_id() Получение идентификатор сотрудника
 * @method string get_login() Получение логина сотрудника
 * @method string get_area_name() Наименование региона
 * @method void set_data() Установка значений для сотрудника
 * @method mixed get_data() Получение данных из псевдо-БД
 * @method array get_areas_data() Массив данных по региону
 * @method mixed get_area_data_by_area_id(int $area_id) Получение данных по региону череш идентификатор региона
 * @method array get_nearby_areas_data() Получение данных по соседним регионам
 * @method array get_workers_data() Получение данных по сотрудникам
 * @method array get_nearby_areas_by_area_id(int $area_id) Получение идентификаторов соседних регионов
 * @method mixed get_login_by_area(string $area_title) Получение логина сотрудника по наименованию региона
 * @method array get_logins_in_nearby_areas(string $area_title) Получение массива логинов ближайших сотрудников
 * @method mixed get_area_id_by_title(string $area_title)  Получение идентификатор региона по наименованию
 */
class Worker {
	private int $id;
	private string $login;
	private string $area_name;

	function __construct(int $worker_area_id) {
		$this->set_data($worker_area_id);
	}

	/**
	 * Получение идентификатор сотрудника
	 * 
	 * @return int Идентификатор сотрулника
	 */
	private function get_id() : int {
		return $this->id;
	}

	/**
	 * Получение логина сотрудника
	 * 
	 * @return string Логин сотрулника
	 */
	private function get_login() : string {
		return $this->login;
	}

	/**
	 * Получение наименования региона сотрудника
	 * 
	 * @return string Наименование региона
	 */
	private function get_area_name() : string {
		return $this->area_name;
	}

	/**
	 * Установка значений для сотрудника
	 * 
	 * @param int $id Идентификатор сотрудника
	 */
	private function set_data(int $id) : void {
		$this->id = $id;

		/**
		 * @var array $data Массив данных о сотруднике
		 */
		$data = $this->get_data();
		if (!is_null($data)) {
			$this->login = $data['login'];
			$this->area_name = $data['area_name'];
		}
	}

	/**
	 * Получение данных из псевдо-БД
	 * 
	 * @return mixed Данные по сотруднику
	 */
	private function get_data() : mixed {
		/**
		 * @var int $worker_id Идентификатор сотрудника
		 */
		$worker_id = $this->get_id();

		/**
		 * @var array $areas Массив данных по сотрудникам 
		 */
		$workers = self::get_workers_data();

		return (array_key_exists($worker_id, $workers)) ? $workers[$worker_id] : null;
	}

	/**
	 * Получение данных по регионам
	 * 
	 * @return array $data Массив данных по региону
	 */
	private static function get_areas_data() : array {
		// Представим, что вытащили данные из БД
		/**
		 * @var array $data Массив данных по регионам
		 */
		$data = [
			1 => '5-й поселок',
			2 => 'Голиковка',
			3 => 'Древлянка',
			4 => 'Заводская',
			5 => 'Зарека',
			6 => 'Ключевая',
			7 => 'Кукковка',
			8 => 'Новый сайнаволок',
			9 => 'Октябрьский',
			10 => 'Первомайский',
			11 => 'Перевалка',
			12 => 'Сулажгора',
			13 => 'Университетский городок',
			14 => 'Центр'
		];

		return $data;
	}

	/**
	 * Получение данных по региону череш идентификатор региона
	 * 
	 * @var int $area_id Идентификатор региона
	 * @return mixed Данные по региону
	 */
	private static function get_area_data_by_area_id(int $area_id) : mixed {
		/**
		 * @var array $areas Массив данных по регионам
		 */
		$areas = self::get_areas_data();
		return (array_key_exists($area_id, $areas)) ? $areas[$area_id] : null;
	}

	/**
	 * Получение данных по соседним регионам
	 * 
	 * @return array $data Массив данных по соседним регионам
	 */
	private static function get_nearby_areas_data() : array {
		// Представим, что вытащили данные из БД
		/**
		 * @var array $data Массив данных по соседним регионам
		 */
		$data = [
			1 => [2, 11],
			2 => [12, 3, 6, 8],
			3 => [11, 13],
			4 => [10, 9, 13],
			5 => [2, 6, 7, 8],
			6 => [10, 2, 7, 8],
			7 => [2, 6, 8],
			8 => [6, 2, 7, 12],
			9 => [10, 14],
			10 => [9, 14, 12],
			11 => [13, 1, 9],
			12 => [1, 10],
			13 => [11, 1, 8],
			14 => [9, 10]
		];

		return $data;
	}

	/**
	 * Получение данных по сотрудникам
	 * 
	 * @return array $data Массив данных по сотрудникам
	 */
	private static function get_workers_data() : array {
		// Представим, что вытащили данные из БД
		/**
		 * @var array $data Массив данных по соседним регионам
		 */
		$data = [
			0 => [
				'login' => 'login1',
				'area_name' => 'Октябрьский' //9
			],
			1 => [
					'login' => 'login2',
					'area_name' => 'Зарека' //5
			],
			2 => [
					'login' => 'login3',
					'area_name' => 'Сулажгора' //12
			],
			3 => [
					'login' => 'login4',
					'area_name' => 'Древлянка' //3
			],
			4 => [
					'login' => 'login5',
					'area_name' => 'Центр' //14
			]
		];

		return $data;
	}

	/**
	 * Получение идентификаторов соседних регионов
	 * 
	 * @param int $area_id Идентификатор целевого региона
	 * @return array Массив идентификаторов соседних регионов
	 */
	public static function get_nearby_areas_by_area_id(int $area_id) : array {
		/**
		 * @var array $nearby_areas Получение данных по соседним регионам
		 */
		$nearby_areas = self::get_nearby_areas_data();

		// Если соседние региона не найдены, то выдается пустой массив
		return (array_key_exists($area_id, $nearby_areas)) ? $nearby_areas[$area_id] : [];
	}

	/**
	 * Получение логина сотрудника по наименованию региона
	 * 
	 * @var string $area_title Наименование региона
	 * @return mixed Логин сотрудника (либо null)
	 */
	public static function get_login_by_area(string $area_title) : mixed {
		/**
		 * @var array $workers Массив данных с сотрудниками
		 */
		$workers = self::get_workers_data();

		// Перебираем всех сотрудников
		foreach ($workers as $worker_id => $worker_data) {
			/**
			 * @var Worker $worker Экземпляр объекта класса сотрудника
			 */
			$worker = new Worker($worker_id);

			/**
			 * @var string $regex_pattern Шаблон с регулярным выражением наименования региона
			 */
			$regex_pattern = sprintf('/(%s)/iu', $area_title);
			if (preg_match($regex_pattern, $worker->get_area_name(), $matches)) {
				return $worker->get_login();
			}
		}

		return null;
	}

	/**
	 * Получение массива логинов ближайших сотрудников
	 * 
	 * @param string $area_title Наименование региона
	 * @return array Массив логинов ближайших сотрудников
	 */
	public static function get_logins_in_nearby_areas(string $area_title) : array {
		/**
		 * @var int $area_id Идентификатор региона
		 */
		$area_id = self::get_area_id_by_title($area_title);
		
		// Если регион не найден, то сотрудника нет смысла искать
		if (is_null($area_id)) {
			return null;
		}

		/**
		 * @var array $nearby_areas Массив данных по соседним регионам
		 */
		$nearby_areas = self::get_nearby_areas_by_area_id($area_id);
		
		// Если соседних регионов нет, то нет смысла искать сотрудника
		if (empty($nearby_areas)) {
			return null;
		}

		/**
		 * @var array $workers Массив данных по сотрудникам
		 */
		$workers = self::get_workers_data();
		$workers_nearby = [];
		foreach ($nearby_areas as $nearby_area_index => $nearby_area_id) {
			$nearby_area_title = self::get_area_data_by_area_id($nearby_area_id);
			
			foreach ($workers as $worker_id => $worker_data) {
				/**
				 * @var Worker $worker Экземпляр объекта класса сотрудника
				 */
				$worker = new Worker($worker_id);
				
				if ($worker->get_area_name() == $nearby_area_title) {
					array_push($workers_nearby, $worker->get_login());
				}
			}
		}

		return $workers_nearby;
	}

	/**
	 * Получение идентификатор региона по наименованию
	 * 
	 * @param string $area_title Наименование региона
	 * @return mixed Идентификатор региона
	 */
	public static function get_area_id_by_title(string $area_title) : mixed {
		/**
		 * @var array $areas Массив регионов
		 */
		$areas = self::get_areas_data();

		// Перебираем всех сотрудников
		foreach ($areas as $area_id => $area_data) {
			/**
			 * @var string $regex_pattern Шаблон с регулярным выражением наименования региона
			 */
			$regex_pattern = sprintf('/(%s)/iu', $area_title);
			if (preg_match($regex_pattern, $area_data, $matches)) {
				return $area_id;
			}
		}

		return null;
	}
}

// Тестирование

/**
 * @var string $area_title Наименование региона
 */
$area_title = 'ПервоМАЙский'; // Использованные флаги в регулярных выражениях позволяют игнорировать регистр букв

/**
 * @var string $worker_login Логин сотрудника в регионе
 */
$worker_login = Worker::get_login_by_area($area_title);
echo (!is_null($worker_login)) ? sprintf('Логин сотрудника: %s' . PHP_EOL, $worker_login) : 'Сотрудник не найден. Ищем ближайших...' . PHP_EOL;

if (is_null($worker_login)) {
	/**
	 * @var array $workers_logins Массив логинов сотрудников
	 */
	$workers_logins = Worker::get_logins_in_nearby_areas($area_title);
	echo (!empty($workers_logins)) ? sprintf('Ближайшие сотрудники: %s' . PHP_EOL, implode(', ', $workers_logins)) : 'Ближайших сотрудников не найдено.' . PHP_EOL;
}

?>