## Instalation:
Docker required to run application.
```
git clone git@github.com:Pyslar-Dmitriy/Dmytro-Pyslar-test.git
cd Dmytro-Pyslar-test
composer update
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail up -d
```
Then You need to manually rename `.env.example` to `.env`
```
sail artisan key:generate
```
## Route is available by the url:
http://localhost/api/users
It can accept limit parameter
http://localhost/api/users?limit=10
## To start unit test:
```
sail artisan test
```
