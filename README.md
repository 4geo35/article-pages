### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/article-pages/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/article-pages/src/resources/views/admin/**/*.blade.php",
    "./vendor/4geo35/article-pages/src/resources/views/livewire/admin/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/article-pages/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/article-pages/src/resources/views/web/**/*.blade.php",
    "./vendor/4geo35/article-pages/src/resources/views/livewire/web/**/*.blade.php",

Запустить миграции для создания таблиц `php artisan migrate`

Установить lightbox `npm install fslightbox`, добавить в `app.js`:

    import "fslightbox"

#### Views

Сокращение для представлений: `ap`  
Меню для панели администрирования: `<x-ap::menu-item/>`  

#### Livewire Components

Web

- `ap-web-article-index`: список тизеров статей

Admin

- `ap-article-index`: таблица в админке
- `ap-article-show`: страница просмотра в админке
- `ap-article-block-index`: управление блоками статьи

#### Config

Название файла: `article-pages`

- `pagePrefix` => `articles`: адрес страницы
- `useBreadcrumbs` => `true`: выводить хлебные крошки на странице
- `pageTitle` => `Статьи`: заголовок страницы
- `useH1` => `true`: выводить h1
- `disableCoverImage` => `false`: убирает изображение из тизера

#### Commands

    php artisan article:clear-images {--all} {--cover} {--blocks}

Команда удаляет изображения у статей. `cover` очистит только обложку статьи, `blocks` очистит изображения в блоках (если это текст + изображение, удалит изображение и изменит тип блока), `all` очистит все

#### Routes

Файл `admin.php`, `middleware(["web", "auth", "app-management"])`

- `admin.articles.index` => `admin/articles`
- `admin.articles.show` => `admin/articles/{article}`

Файл `web.php`, `middleware(["web"])`, `prefix(config("article-pages.pagePrefix"))`

- `web.articles.index` => `{prefix}`
- `web.articles.show` => `{prefix}/{article}`
