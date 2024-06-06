# ToDoList_Laravel

## Готовое приложение находится в ветке master
### Приложение было написано для обучения основам Laravel.
### Представляет собой Todo-list с регистрацие пользователей.
### В качетсве БД был использован MySQL

# Чтобы запустить приложение на своей Локальной машине следуёте следующим инструкциям:
1. В вашей Bash консоли после перехода в проект прописать git clone
   * "https://github.com/srunas/Testovoe_zadanie_dlia_otdela_Maksa/tree/master.git"
3. cd ваш-репозиторий.
4. Скопируйте файл .env.example в .env и настройте необходимые переменные окружения:
   * cp .env.example .env
6. Запустите Docker контейнеры:
   * docker-compose up --build
8. Выполните миграции и установите зависимости:
   * docker-compose exec app composer install
   * docker-compose exec app php artisan migrate
   * docker-compose exec app php artisan key:generate
9. Откройте браузер и перейдите по адресу
   * http://localhost:8000
