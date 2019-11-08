conf:
	cd PSMS && sudo apt-get install php7.3 php7.3-mbstring php7.3-mysql php7.3-intl php7.3-xml composer # isso só serve pra sistemas que usam o apt
	cd PSMS && composer install --no-scripts
	# npm install
	# npm run dev
	cd PSMS && cp .env.example .env # copia o example
	cd PSMS && php artisan key:generate # gera a chave
	cd PSMS && sudo apt-get install mysql-server-5.7 # instala o bd
	$(MAKE) bd-conf # roda a regra do bd-conf

bd-conf:
	mysql -u root -p --execute="drop database if exists PSMS; create database PSMS; drop user if exists 'seletivo'; create user 'seletivo' identified by '123'; grant all privileges on PSMS.* to 'seletivo';"
	cd PSMS && sed -i 's/DB_DATABASE.*/DB_DATABASE=PSMS/' .env # ajusta o nome do banco no .env
	cd PSMS && sed -i 's/DB_USERNAME.*/DB_USERNAME=seletivo/' .env # ajusta o nome de usuário no .env
	cd PSMS && sed -i 's/DB_PASSWORD.*/DB_PASSWORD=123/' .env # ajusta a senha no .env
	cd PSMS && php artisan migrate:refresh --seed
	cd PSMS && php artisan serve
