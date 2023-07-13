# Swoole
![image](https://github.com/vinelouzada/swoole-php/assets/56182156/7e82482b-8488-4375-94a5-3185f4f5749c)

## O que é o Swoole?
O Swoole é uma extensão de alto desempenho para PHP e que permite o uso de programação assíncrona para criar servidores performáticos.

## Como instalar o Swoole?

Adicione o PPA ´ondrej/php/´ pois fornece pacotes atualizados do PHP:

```
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
```

Instale o Swoole:

```
sudo apt-get install php-swoole
```

Após a conclusão da instalação, você pode verificar se o Swoole foi instalado corretamente executando o seguinte comando:

```
php -m | grep swoole
```

Se o comando retornar "swoole", significa que o Swoole foi instalado com sucesso.
