### Setup steps

* docker network create pspmediatesttask
* docker run -d --network=pspmediatesttask --name=pspmediatesttaskdb -e MYSQL_ROOT_PASSWORD=root -e MYSQL_USER=user -e MYSQL_PASSWORD=password -e MYSQL_DATABASE=testtask mariadb:10.5.1-bionic
* docker build -t pspmediatesttaskphp --network=pspmediatesttask --build-arg DATABASE_URL=mysql://user:password@pspmediatesttaskdb:3306/testtask --build-arg APP_ENV=production --build-arg APP_DEBUG=false .
* docker run -d --network=pspmediatesttask --name=pspmediatesttaskphp -p 8000:80 pspmediatesttaskphp
