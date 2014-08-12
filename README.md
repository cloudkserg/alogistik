Архив vendor.tar.gz разворачиваем
Архив common.tar.gz разворачиваем

Создаем папки
protected/runtime admin/runtime webroot/assets webroot/file webroot/image с правами 777


Создаем базу для сайта
В файле common/config/params.php прописываем имя и пароль к базе данных, и название базы

Создаем конфиг common/config/params.php
Его похожее содержимое в common/config/params.php.dist
Меняем только пароль и имя к базе
USER и PASSWORD





Разворачиваем миграцию
admin/yiic migrate
