FROM ubuntu:latest

ENV DEBIAN_FRONTEND=noninteractive
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update -y && \
    apt-get install -y adduser sudo && \
    adduser --disabled-password --gecos "" newuser && \
    echo "newuser:1" | chpasswd && \
    usermod -aG sudo newuser

RUN apt-get update -y && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update -y && \
    apt-get install -y php8.3 \
                       php8.3-cli \
                       php8.3-common \
                       php8.3-mysql \
                       php8.3-zip \
                       php8.3-gd \
                       php8.3-mbstring \
                       php8.3-curl \
                       php8.3-xml \
                       php8.3-bcmath \
                       unzip \
                       git \
                       wget \
                       curl \
                       sudo

USER newuser
WORKDIR /home/newuser

RUN sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    sudo php -r "if (hash_file('sha384', 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    sudo php composer-setup.php && \
    sudo php -r "unlink('composer-setup.php');" && \
    sudo mv composer.phar /usr/local/bin/composer

RUN sudo composer require "codeception/codeception" --dev

RUN git clone https://github.com/tomislavilievqa/1ForFitTask.git && cd 1ForFitTask && git checkout master

WORKDIR /home/newuser/1ForFitTask

EXPOSE 8080

CMD ["bash"]


#docker run -it ubuntu
#apt-get update && apt-get install adduser && adduser newuser && usermod -aG sudo newuser && apt-get install sudo && apt-get install php 
# installing composer:
# sudo php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# sudo php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrusu newuserpt'; unlink('composer-setup.php'); } echo PHP_EOL;"
# sudo php composer-setup.php
# mv composer.phar /usr/local/bin/composer
# sudo php -r "unlink('composer-setup.php');"
# sudo mv composer.phar /usr/local/bin/composer
# sudo apt-get install -y php8.3-cli php8.3-common php8.3-mysql php8.3-zip php8.3-gd php8.3-mbstring php8.3-curl php8.3-xml php8.3-bcmath unzip
# sudo composer require "codeception/codeception" --dev
# php vendor/bin/codecept bootstrap

# sudo git clone https://github.com/tomislavilievqa/1ForFitTask.git
# sudo cd ~/oneforfitproject/1ForFitTask or ~/1ForFitTask