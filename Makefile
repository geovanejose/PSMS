conf:
	sudo apt-get install php7.2 php7.2-mbstring php7.2-mysql php7.2-intl php7.2-xml composer # isso só serve pra sistemas que usam o apt
	composer install --no-scripts
	# npm install
	# npm run dev
	cp .env.example .env # copia o example
	php artisan key:generate # gera a chave
	sudo apt-get install mysql-server-5.7 # instala o bd
	$(MAKE) bd-conf # roda a regra do bd-conf

bd-conf:
	mysql -u root -p --execute="drop database if exists PSMS; create database PSMS; drop user if exists 'pro_seletivo'; create user 'pro_seletivo' identified by 'pro_123'; grant all privileges on PSMS.* to 'pro_seletivo';"
	cd PSMS && sed -i 's/DB_DATABASE.*/DB_DATABASE=PSMS/' .env # ajusta o nome do banco no .env
	cd PSMS && sed -i 's/DB_USERNAME.*/DB_USERNAME=pro_seletivo/' .env # ajusta o nome de usuário no .env
	cd PSMS && sed -i 's/DB_PASSWORD.*/DB_PASSWORD=pro_123/' .env # ajusta a senha no .env
	cd PSMS && php artisan migrate:refresh --seed
	cd PSMS && php artisan serve
