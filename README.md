# Laravel RTB Docker Project
## setup instruction
1. Clone the repository:

   git clone https://github.com/chellasiva/rtb-docker.git
   cd rtb-docker

2.cp .env.example .env
3.docker-compose up --build -d
4.docker exec -it rtb-app bash
5.php artisan migrate --seed
6.It will be accessible at:
http://localhost:8000
7.To run queue worker & scheduler
docker exec -it rtb-app bash
php artisan queue:work
php artisan schedule:run

