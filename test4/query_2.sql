/* Выведите список товаров products и разделов catalogs, который соответствует товару. */

/* Выбираем базу данных */
USE shop;
/* Выбираем колонки для отображения */
SELECT catalogs.name, products.name
/* Сопоставляем две таблицы с учетом совпадения идентификаторов каталогов товара */
FROM products INNER JOIN catalogs ON (products.catalog_id = catalogs.id)
/* Группируем по идентификатору товара */
ORDER BY products.id;