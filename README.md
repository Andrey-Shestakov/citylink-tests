# Тестовые задания для Ситилинка
Здравствуйте, компания "Ситилинк! Меня зовут Андрей - это открытый репозиторий специально для вас. Пусть этот документ будет своего рода пояснительной запиской к выполненным заданиям. Хорошего дня!

Я решил задание опубликовать именно на GitHub, чтобы показать, что я умею с ним взаимодействовать. Также в этом файле хотел бы дать более подробное описание к своим решениям.

## Задание 1
Не смотря на то, что в задании было четко указано, что необходимо написать функцию, которая выдаст ближайшего сотрудника к искомому району - я решил немного усложнить себе задачу. Мне нравится ООП и честно говоря без него сейчас сложно представляется программирование, особенно в веб-среде, поэтому я решил эту задачу именно через объектно-ориентированное программирование.

Думаю, вы обратили внимание, что я использовал статические методы. Дело в том, обычные методы (доступные после вызова конструктора) я связываю с конкретным сотрудником (от туда и наименование класса), говоря же про статичные методы - они работают с целым массивом данных. Предполагается, что они отрабатывают с базой данных (вместо нее уже готовые данные) и для этого не требуется создание класса Worker.

Сама функция (static): `Worker::get_login_by_area(string $area_title)`

**Из интересного:** реализовал также задачу "со звездочкой", где тербовалось вывести ближайших сотрудников.

## Задание 2
Веселое задание. Мне очень понравилось. Ранее мне не приходилось никогда работать с интервалами времени (мои проекты не требовали это), поэтому задание заставило мой мозг пошевелиться. Очень интересный опыт пришел при учете нового дня. Сначала я хотел решить с использованием кучи регулярных выражений, однако, вспомнил про **DateInterval** и сразу стало легче жить.

Функция проверки на валидность (static): `IntervalsBox::is_valid(string $interval)`

Функция проверки наложения: `$instance->overlay_check(string $interval)`

## Задание 3
Прошлые программисты - боль, а точнее их код, где нет описанной архитектуры. Для того, чтобы будущие программисты смогли поддерживать старый код и развивать его, дополняя новыми элементами (дочерними классами, например) - нужно четко описать родительский. Для этого я воспользовался абстрактым классом.

## Задание 4

## Задание 5

## Задание 6
Тут я решил пойти в раш и залить готовую адаптивную верстку на сайт своего проекта "Garbalo" - drelagas.garbalo.com.

## Общее пояснение
Я люблю чистоту кода. Я старался написать свой код максимально чисто и читабельно (именно поэтому все прокомментировано по адаптированному стандарту документирования PHPDoc, а наименование методов и переменных соответствуют смыслу своего существования). Не смотря на все это - я все равно считаю, что код недостаточно чист и хочу совершенствоваться в этом дальше.
