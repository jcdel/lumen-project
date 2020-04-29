## Lumen Rest Api Using Vue, React and Angular

Technologies used:

### LUMEN:Backend
  - [Lumen 7.0](https://lumen.laravel.com/docs/7.x)
  - [JWT Authentication](https://github.com/tymondesigns/jwt-auth)
  - [Laravel-cors](https://github.com/fruitcake/laravel-cors)
  - [Lumen Generator](https://packagist.org/packages/flipbox/lumen-generator)

### VUE:Frontend
  - [Vue v2.6.11](https://vuejs.org/)
  - [Vue Router](https://router.vuejs.org/)
  - [Vuex](https://vuex.vuejs.org/)
  - [Vue Cli 3](https://cli.vuejs.org/)
  - [Laravel-vue-pagination](https://github.com/gilbitron/laravel-vue-pagination)
  - [Bootstrap-vue](https://bootstrap-vue.js.org/)

### React:Frontend
  - [React v16.13.1](https://reactjs.org/)


### Angular:Frontend
  - [Angular v9.1.3](https://angular.io/)



### Usage Instruction:

Run Lumen Rest API:

```bash
cd backend-lumen
composer install
# configure your key, database, etc in `.env` file
php artisan migrate --seed
# generate jwt token
php artisan jwt:secret
php artisan serve
```

Run Vue:

```bash
cd frontend-vue
npm install
npm run serve
```
Run React:

```bash
cd frontend-react
npm install
npm start
```

Run Angular:

```bash
cd frontend-angular
npm install
ng serve -o
```

Login credentials for testing the API:

Login: jc@mail.com
Password: admin
