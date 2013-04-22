API PagSeguro
=============

API de integração com o PagSeguro para PHP 5.3+, deve ser utilizado um Autoloader compatível com a PSR-0.

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
// Consideramos que já existe um autoloader compatível com a PSR-0 registrado

use \PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest;
use \PHPSC\PagSeguro\ValueObject\Credentials;
use \PHPSC\PagSeguro\ValueObject\Item;
use \PHPSC\PagSeguro\PaymentService;

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO',
    'TOKEN DE ACESSO À API'
);

$service = new PaymentService($credentials); // cria instância do serviço de pagamentos

try {
    $response = $service->send( // Envia a solicitação de pagamento
        new PaymentRequest(
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

Este serviço é responsável por buscar o status de uma transação, ele deve ser utilizado para acompanhar a alteração do status de pagamento de uma venda. Seu fluxo básico é:

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
// Consideramos que já existe um autoloader compatível com a PSR-0 registrado

use \PHPSC\PagSeguro\ValueObject\Payment\PaymentRequest;
use \PHPSC\PagSeguro\ValueObject\Credentials;
use \PHPSC\PagSeguro\ValueObject\Item;
use \PHPSC\PagSeguro\NotificationService;

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO',
    'TOKEN DE ACESSO À API'
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

### Licença de uso

Esta biblioteca segue os termos de uso da [Creative Commons Attribution-ShareAlike 2.5](http://creativecommons.org/licenses/by-sa/2.5)
