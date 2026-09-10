### Установка

Добавить `"./vendor/4geo35/article-pages/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/article-pages/src/resources/views/admin/**/*.blade.php",
"./vendor/4geo35/article-pages/src/resources/views/livewire/admin/**/*.blade.php",` в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

Добавить `"./vendor/4geo35/article-pages/src/resources/views/components/**/*.blade.php",
"./vendor/4geo35/article-pages/src/resources/views/web/**/*.blade.php",
"./vendor/4geo35/article-pages/src/resources/views/livewire/web/**/*.blade.php",` в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

Запустить миграции для создания таблиц `php artisan migrate`

Установить lightbox `npm install fslightbox`, добавить в `app.js`:

    import "fslightbox"

#### Commands

    php artisan article:clear-images {--all} {--cover} {--blocks}

Команда удаляет изображения у статей. `cover` очистит только обложку статьи, `blocks` очистит изображения в блоках (если это текст + изображение, удалит изображение и изменит тип блока), `all` очистит все
