/* Выведите одного случайного пользователя из таблицы shop.users,
 * старше 30 лет, сделавшего минимум 3 заказа за последние полгода */

/* Выбираем базу */
USE shop;
/* ВЫбираем поле для вывода */
SELECT users.name
/* Сопоставляем таблицы по идентификатору пользователя */
FROM users INNER JOIN orders ON (users.id = orders.user_id)
/* Пользователь должен быть старше 30 лет и сделать минимум 3 заказа за последние полгода */
WHERE (TIMESTAMPDIFF(YEAR, users.birthday_at, CURDATE()) > 30) AND (orders.created_at >= (NOW() - INTERVAL 6 MONTH))
/* Группируем результат имени пользователя */
GROUP BY users.name
/* Выбираем тех, кто сделал минимум три заказа */
HAVING COUNT(orders.id) >= 3
/* Сортируем результаты случайным образом и выбираем одну запись */
ORDER BY RAND() LIMIT 1;