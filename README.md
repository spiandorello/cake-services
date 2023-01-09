# Cake services api

Esta é uma api desenvolvida com php, usando [laravel](https://laravel.com/).
O objetivo dessa api é notificar os usuários quando um bolo, o qual ele está inscrito, está disponível para compra. 

## Modelo do banco de dados

Na imagem abaixo podemos ver como foi modelado o banco de dados.

![Modelo do banco de dados](https://github.com/spiandorello/cake-services/blob/main/database-model.png?raw=true)

## Features

- [x] Crud para cadastro de bolos
- [x] Crud para cadastro de usuários
- [x] Enpoint para inscrições no bolo  
- [x] Disparo de e-mail assíncrono. 
- [x] Testes de integração
- [x] Testes unitários
- [x] Ambiente utilizado docker (Nginx, Mysql, PHP 8.2)

## Pontos de melhoria
- [ ] Criação da documentação da api
- [ ] Alterar o transporte das mensagens por um dos brokers (Rabbitmq|Redis|Kafka)
- [ ] Alterar o provider de e-mail (MailTrap) 
- [ ] Criação do template para envio do e-mail

## Como subir a aplicação localmente

Pré requisitos:
  * Ter o [docker](https://www.docker.com/) instalado.

Entra na pasta do projeto e execute o seguinte comando:
```
docker-compose up -d
```

Após subir o ambiente rode as migrations:
```
docker exec -it cake-services /bin/ash -c "php artisan migrate"
```

Agora já está pronto para desenvolvimento.

### Ports dos serviços em rede

| Service       | Name          | Host        | Host port | Container Port | 
|---------------|---------------|-------------|-----------|----------------|
| Cake services | cake-services | 127.0.0.1   | 8080      | 8080           |
| Nginx         | cake-nginx    | 127.0.0.1   | 9000      | 9000           | 
| Mysql         | cake-mysql    | 127.0.0.1   | 3306      | 3306           | 



## Comandos utéis

Executar o job para envio das notificações
```
docker exec -it cake-services /bin/ash -c "php artisan  queue:work"
```

Executar os testes
```
docker exec -it cake-services /bin/ash -c "php artisan test"
```

Executar commando para arrumar o code standard
```
docker exec -it cake-services /bin/ash -c "./vendor/bin/pint"
```
    
