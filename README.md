git clone https://github.com/Serji-adm/zoho-crm-deal-account-service.git
cd zoho-crm-deal-account-service

docker compose down -v
docker-compose up -d --build
docker ps
docker ps -a

docker exec -it container-zoho-crm-app php artisan migrate

npm run dev


sudo chmod -R 777 storage/logs/
sudo chmod -R 777 storage/framework/

docker exec -it container-zoho-crm-app php artisan route:clear
docker exec -it container-zoho-crm-app php artisan config:clear
docker exec -it container-zoho-crm-app php artisan cache:clear
docker exec -it container-zoho-crm-app php artisan view:clear

docker exec -it container-zoho-crm-app php artisan route:list








