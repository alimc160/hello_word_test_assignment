### Step 1
```bash
$ cp .env.example .env
```

### Step 2
```bash
$ composer install
```
### Step 3
```bash
$ npm install
$ npm run build
```
### Step 4

make the database with "test_db" name then after that run the below command to create schema
```bash
$ php artisan migrate
```

### Step 5
```bash
$ php artisan serve
```
