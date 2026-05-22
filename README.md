# [智慧建築] SmartCore

### 系統
    Laravel 12.x
    Filament 5.x
    Filament Shield 4.x

### Docker操作
```bash
# 進入容器
docker-compose exec workspace bash
# 切換角色(檔案權限問題)
su laradock
# 重啟容器
docker-compose restart nginx
```

### 安裝
```bash
# 套件安裝
composer install
# 複製環境設定
cp .env.example .env
# 設定資料庫
vi .env
# 進入容器 workspace 調整目錄權限
chown -R laradock:laradock storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
# 產生應用程式金鑰
php artisan key:generate
# 進入容器 workspace 建立資料庫
php artisan migrate

# 1.透過 Shield 指令建立權限跟管理員
# 重新產生 Shield 權限(或是透過 Sedder 匯入)
php artisan shield:generate
# 建立管理員帳號
php artisan make:filament-user
# 調整管理員角色為 super_admin (PHP操作)
php artisan tinker
> $user = App\Models\User::find(1);
> $user->assignRole('super_admin');

# 2.透過 Laravel Seeder 建立權限跟管理員
php artisan migrate:fresh --seed
php artisan shield:generate --all
```

#### ENV資料庫設定
```md
APP_LOCALE=zh_TW

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel12
DB_USERNAME=default
DB_PASSWORD=secret
```

### Git拉版本
```bash
git fetch origin main
git checkout -b main origin/main
git checkout main
git reset --hard origin/main
```
