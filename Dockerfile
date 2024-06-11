FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    php-cli \
    php-xml \
    php-mbstring \
    php-mysql \
    unzip \
    git \
    curl \
    wget \
    gnupg \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget -q "https://storage.googleapis.com/chrome-for-testing-public/125.0.6422.141/linux64/chrome-linux64.zip" -O /tmp/chrome-linux64.zip && \
    unzip /tmp/chrome-linux64.zip -d /tmp/ && \
    mv /tmp/chrome-linux64 /opt/chrome && \
    ln -s /opt/chrome/chrome /usr/bin/google-chrome

RUN wget -q "https://storage.googleapis.com/chrome-for-testing-public/125.0.6422.141/linux64/chromedriver-linux64.zip" -O /tmp/chromedriver-linux64.zip && \
    unzip /tmp/chromedriver-linux64.zip -d /usr/local/bin/ && \
    chmod +x /usr/local/bin/chromedriver

RUN wget -q "https://selenium-release.storage.googleapis.com/3.141/selenium-server-standalone-3.141.59.jar" -O /usr/local/bin/selenium-server-standalone.jar

WORKDIR /app

COPY . /app

RUN composer install

RUN composer require "codeception/codeception" --dev

EXPOSE 4444

CMD ["sh", "-c", "java -jar /usr/local/bin/selenium-server-standalone.jar & vendor/bin/codecept run"]
