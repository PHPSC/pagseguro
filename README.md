API PagSeguro
=============

API de integração com o PagSeguro para PHP 5.3+, deve ser utilizado um Autoloader compatível com a PSR-4.

Instalação
----------

A instalação desta biblioteca pode ser feita utilizando o [Composer](https://packagist.org/packages/phpsc/pagseguro).

Uso básico
----------

Criamos apenas classes para a utilização de dois serviços: pagamentos e notificações

### Pagamentos

Este serviço é responsável por solicitar pagamentos, seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |----- (A) solicitação de compra ------->|
     |                                        | (B) realiza processamento
     |<---- (C) envia resposta ---------------|
     |                                        |
     |----- (D) redireciona o cliente ------->|
     
* (A) A loja cria uma solicitação de compra e envia para o serviço
* (B) PagSeguro processa a requisição
* (C) PagSeguro envia resposta da requisição (informando erros caso houverem)
* (D) Caso o processamento de (C) ocorreu com sucesso um código será retornado e a loja deverá redirecionar o cliente para o PagSeguro para efetuar o pagamento

O uso básico é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use PHPSC\PagSeguro\Checkout\Checkout;
use PHPSC\PagSeguro\Checkout\CheckoutService;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Item;

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO',
    'TOKEN DE ACESSO À API',
    false // este é o valor padrão e não precisa ser informado, ele define se será utilizado o modo SANDBOX ou não.
);

$service = new CheckoutService($credentials); // cria instância do serviço de pagamentos

try {
    $response = $service->checkout( // Envia a solicitação de pagamento
        new Checkout(
            array( // Coleção de itens a serem pagos (O limite de itens é definido pelo webservice da Pagseguro)
                new Item(
                	'1', // ID do item
                	'Televisão LED 500 polegadas', // Descrição do item
                	8999.99 // Valor do item
            	),
            	new Item(
                	'2', // ID do item
                	'Video-game mega ultra blaster', // Descrição do item
                	799.99 // Valor do item
            	)
            )
        )
    );

    header('Location: ' . $response->getRedirectionUrl()); // Redireciona o usuário
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```
### Notificações

Este serviço é responsável por buscar uma transação a partir do código da notificação, ele 
deve ser utilizado para acompanhar a alteração do status de pagamento de uma venda. Seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |<---- (A) notifica alteração -----------|
     |                                        |
     |----- (B) solicita dados -------------->|
     |                                        |
     |<---- (C) envia resposta ---------------|
     
* (A) O PagSeguro envia uma requisição à uma página (configurada na conta do pagseguro) notificando uma mudança de status 
* (B) A loja busca a transação a partir do código da notificação
* (C) PagSeguro envia resposta da requisição com os detalhes da transação

O uso básico é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Transaction\NotificationService;

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO',
    'TOKEN DE ACESSO À API',
    false // este é o valor padrão e não precisa ser informado, ele define se será utilizado o modo SANDBOX ou não.
);

$service = new NotificationService($credentials); // Cria instância do serviço

try {
    $transaction = $service->getByCode( // Solicita os detalhes da transação
    	'CODIGO DA NOTIFICAÇÃO ENVIADO PELO PAGSEGURO'
	);

    var_dump($transaction); // Exibe na tela a transação atualizada
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```
### Consultas

Este serviço é responsável por buscar uma transação a partir do código da transação, ele 
deve ser utilizado para buscar os dados de pagamento de uma venda. Seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |----- (A) solicita dados -------------->|
     |                                        |
     |<---- (B) envia resposta ---------------|
     
* (A) A loja busca a transação a partir do código da transação (recebido na solicitação de pagamento)
* (B) PagSeguro envia resposta da requisição com os detalhes da transação

O uso básico é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Transaction\ConsultationService;

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO',
    'TOKEN DE ACESSO À API',
    false // este é o valor padrão e não precisa ser informado, ele define se será utilizado o modo SANDBOX ou não.
);

$service = new ConsultationService($credentials); // Cria instância do serviço

try {
    $transaction = $service->getByCode( // Solicita os detalhes da transação
        'CODIGO DA TRANSAÇÃO'
    );

    var_dump($transaction); // Exibe na tela a transação atualizada
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

### Licença de uso

Esta biblioteca segue os termos de uso da [Creative Commons Attribution-ShareAlike 2.5](http://creativecommons.org/licenses/by-sa/2.5)
