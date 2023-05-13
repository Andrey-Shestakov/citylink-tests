/* В базе данных shop и sample присутствуют одни и те же таблицы.
 * Переместите запись id = 1 из таблицы shop.users в таблицу sample.users.
 * Используйте транзакции. */

/* Отключаем автокоммит */
SET AUTOCOMMIT = 0;
/* Начинаем транзакцию */
START TRANSACTION;
/* Добавляем новую запись в таблицу users */
INSERT INTO sample.users (name, birthday_at)
/* Берем данные из старой таблицы для переноса */
SELECT shop.users.name, shop.users.birthday_at 
FROM shop.users
/* Идентификатор должен быть равен единице (условие задания) */
WHERE (id = 1);
/* Записываем данные (при отключенном AUTOCOMMIT не будет автоматической записи) */
COMMIT;