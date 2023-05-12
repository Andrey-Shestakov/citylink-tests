<?php

/**
 * @charset UTF-8
 *
 * Задание 2. Работа с массивами и строками.
 *
 * Есть список временных интервалов (интервалы записаны в формате чч:мм-чч:мм).
 *
 * Необходимо написать две функции:
 *
 *
 * Первая функция должна проверять временной интервал на валидность
 * 	принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм)
 * 	возвращать boolean
 *
 *
 * Вторая функция должна проверять "наложение интервалов" при попытке добавить новый интервал в список существующих
 * 	принимать она будет один параметр: временной интервал (строка в формате чч:мм-чч:мм). Учесть переход времени на следующий день
 *  возвращать boolean
 *
 *  "наложение интервалов" - это когда в промежутке между началом и окончанием одного интервала,
 *   встречается начало, окончание или то и другое одновременно, другого интервала
 *
 *
 *
 *  пример:
 *
 *  есть интервалы
 *  	"10:00-14:00"
 *  	"16:00-20:00"
 *
 *  пытаемся добавить еще один интервал
 *  	"09:00-11:00" => произошло наложение
 *  	"11:00-13:00" => произошло наложение
 *  	"14:00-16:00" => наложения нет
 *  	"14:00-17:00" => произошло наложение
 */

/**
 * Класс для работы с интервалами
 * 
 * @property array $list Массив интервалов
 * 
 * @method void __construct() Конструктор класса
 * @method array get_list() Получение массива интервалов
 * @method bool overlay_check(string $interval) Проверка наложения интервала
 * @method bool add(string $interval) Добавление интервала
 * @method bool is_valid(string $interval) Проверка на валидацию формата интервала
 */
class IntervalsBox {
	private array $list = [];

	public function __construct() {
		// ...
	}

	/**
	 * Получение массива интервалов
	 * 
	 * @return array Массив интервалов
	 */
	public function get_list() : array {
		return $this->list;
	}

	/**
	 * Проверка наложения интервала
	 * 
	 * @param string $interval Интервал в формате чч:мм-чч:мм
	 */
	public function overlay_check(string $interval) : bool {
		/**
		 * @var array $interval_times Разбивка времени на часы и минуты проверяемого интервала
		 */
		$interval_times = explode('-', $interval);

		/**
		 * @var array $intervals_list Список существующих интервалов
		 */
		$intervals_list = $this->get_list();
		
		// Перебираем существующие интервалы
		foreach ($intervals_list as $interval_exists_index => $interval_exists_data) {

			/**
			 * @var array $interval_exists_times Разбивка времени на часы и минуты существующего интервала
			 */
			$interval_exists_times = explode('-', $interval_exists_data);
			
			/**
			 * @var DateTime $start_date Начальное время
			 */
			$start_date = date_create(sprintf('2023-05-%02d %s', 1, $interval_exists_times[0]));

			/**
			 * @var DateTime $end_date Конечное время
			 */
			$end_date = date_create(sprintf('2023-05-%02d %s', 1, $interval_exists_times[1]));
			if ($start_date > $end_date) {
				$end_date->modify('+1 day');
			}

			/**
			 * @var DateInterval $date_interval Экземпляр класса DateInterval с учетом шага в одну минуту
			 */
			$date_interval = DateInterval::createFromDateString('1 minute');

			/**
			 * @var DatePeriod $daterange Экземпляр класса DatePeriod
			 */
			$daterange = new DatePeriod($start_date, $date_interval, $end_date);
			// Перебираем массив $daterange для выявления наложения
			foreach ($daterange as $date) {
				if (($interval_times[0] == $date->format('H:i') || $interval_times[1] == $date->format('H:i')) && $start_date->format('d') == $date->format('d')) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Добавление интервала
	 * 
	 * @param string $interval Интервал в формате чч:мм-чч:мм
	 * @return bool Статус добавления интервал (был добавлен или нет)
	 */
	public function add(string $interval) : bool {
		if (self::is_valid($interval)) {
			/**
			 * @var bool $overlay_check Статус наложения интервала
			 */
			$overlay_check = $this->overlay_check($interval);
			/**
			 * @var string $overlay_text Текст отчета
			 */
			$overlay_text = ($overlay_check) ? sprintf('"%s" => произошло наложение', $interval) : sprintf('"%s" => наложения нет', $interval);
			echo $overlay_text . PHP_EOL;

			array_push($this->list, $interval);
			return true;
		}

		return false;
	}

	/**
	 * Проверка на валидацию формата интервала
	 * 
	 * @param string $interval Интервал
	 * @return bool Статус валидации (валиден или нет)
	 */
	public static function is_valid(string $interval) : bool {
		return preg_match('/\d{2}\:\d{2}\-\d{2}\:\d{2}/', $interval);
	}
}

// Тестирование

$intervals_box = new IntervalsBox();

$intervals_box->add('23:57-00:04');
$intervals_box->add('23:59-00:06');
$intervals_box->add('10:31-10:36');

?>