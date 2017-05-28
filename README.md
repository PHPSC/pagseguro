# API PagSeguro

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/PHPSC/pagseguro?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://secure.travis-ci.org/PHPSC/pagseguro.png?branch=master)](http://travis-ci.org/#!/PHPSC/pagseguro)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/PHPSC/pagseguro/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/PHPSC/pagseguro/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/PHPSC/pagseguro/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/PHPSC/pagseguro/?branch=master)

[![Total Downloads](https://poser.pugx.org/PHPSC/pagseguro/downloads.png)](https://packagist.org/packages/PHPSC/pagseguro)
[![Latest Stable Version](https://poser.pugx.org/PHPSC/pagseguro/v/stable.png)](https://packagist.org/packages/PHPSC/pagseguro)

API de integração com o PagSeguro para PHP 5.6+, deve ser utilizado um Autoloader compatível com a PSR-4.

## Instalação

A instalação desta biblioteca pode ser feita utilizando o [Composer](https://packagist.org/packages/phpsc/pagseguro).

## Exemplos básicos

Nesta versão é possível gerenciar:

* Solicitações (pagamentos e assinaturas);
* Notificações
* Busca por código (pagamentos e assinaturas);
* Cancelamento e cobrança de assinaturas.

### Credenciais de acesso

Para poder realizar requisições ao PagSeguro você deve configurar as credenciais de acesso, podendo ser para ambiente de produção ou sandbox:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Production;
use PHPSC\PagSeguro\Environments\Sandbox;

/* Ambiente de produção: */

$credentials = new Credentials('EMAIL CADASTRADO NO PAGSEGURO', 'TOKEN DE ACESSO À API');

// ou 

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO', 
    'TOKEN DE ACESSO À API',
    new Production()
);

/* Ambiente de testes: */

$credentials = new Credentials(
    'EMAIL CADASTRADO NO PAGSEGURO', 
    'TOKEN DE ACESSO À API',
    new Sandbox()
);
```

### Solicitações

Conjunto de serviços para solicitação da autorização do cliente para o pagamento ou assinatura.

#### Pagamentos

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

Após o cliente ser redirecionado pela loja para o PagSeguro (D) e autorizar o pagamento,
ele poderá ser redirecionado de volta à loja com o código da transação criada (dependendo da configuração)

O seguinte código pode ser utilizado como exemplo básico para solicitação de pagamentos:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

try {
    $service = new CheckoutService($credentials); // cria instância do serviço de pagamentos
    
    $checkout = $service->createCheckoutBuilder()
                        ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
                        ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
                        ->getCheckout();
    
    $response = $service->checkout($checkout);
    
    //Se você quer usar uma url de retorno
    $checkout->setRedirectTo( "http://seu_dominio/uri/retorno" );
    
    //Se você quer usar uma url de notificação
    $checkout->setNotificationURL( "http:://seu_dominio/admin/transacao/notificacao" );

    header('Location: ' . $response->getRedirectionUrl()); // Redireciona o usuário
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

#### Assinaturas

Este serviço é responsável por solicitar a autorização de assinaturas (pagamentos pré autorizados), seu fluxo básico é:

    Loja                                      PagSeguro
     |                                            |
     |----- (A) solicitação de assinatura ------->|
     |                                            | (B) realiza processamento
     |<---- (C) envia resposta -------------------|
     |                                            |
     |----- (D) redireciona o cliente ----------->|
     
* (A) A loja cria uma solicitação de assinatura (com cobrança manual ou automática) e envia para o serviço
* (B) PagSeguro processa a requisição
* (C) PagSeguro envia resposta da requisição (informando erros caso houverem)
* (D) Caso o processamento de (C) ocorreu com sucesso um código será retornado e a loja deverá redirecionar o cliente para o PagSeguro para efetuar o pagamento

Após o cliente ser redirecionado pela loja para o PagSeguro (D) e autorizar a assinatura,
ele poderá ser redirecionado de volta à loja com o código da assinatura criada (dependendo da configuração)

O seguinte código pode ser utilizado como exemplo básico para solicitação de assinaturas manuais,
onde a loja fica responsável por enviar as cobranças:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use DateTime;
use PHPSC\PagSeguro\Requests\PreApprovals\Period;
use PHPSC\PagSeguro\Requests\PreApprovals\PreApprovalService;

try {
    $service = new PreApprovalService($credentials); // cria instância do serviço de pagamentos
    
    $request = $service->createRequestBuilder()
                   ->setName('Nome da assinatura')
                   ->setPeriod(Period::MONTHLY)
                   ->setFinalDate(new DateTime('2014-12-31 23:59:59'))
                   ->setMaxTotalAmount(50)
                   ->setMaxPaymentsPerPeriod(1)
                   ->setMaxAmountPerPeriod(10)
                   ->getRequest();
    
    $response = $service->approve($request);

    header('Location: ' . $response->getRedirectionUrl()); // Redireciona o usuário
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

O seguinte código pode ser utilizado como exemplo básico para solicitação de assinaturas automáticas,
onde as cobranças serão controladas pelo PagSeguro:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use DateTime;
use PHPSC\PagSeguro\Requests\PreApprovals\Period;
use PHPSC\PagSeguro\Requests\PreApprovals\PreApprovalService;

try {
    $service = new PreApprovalService($credentials); // cria instância do serviço de pagamentos
    
    $request = $service->createRequestBuilder(false)
                   ->setName('Nome da assinatura')
                   ->setPeriod(Period::MONTHLY)
                   ->setFinalDate(new DateTime('2014-12-31 23:59:59'))
                   ->setAmountPerPayment(10)
                   ->setMaxTotalAmount(50)
                   ->getRequest();
    
    $response = $service->approve($request);

    header('Location: ' . $response->getRedirectionUrl()); // Redireciona o usuário
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

### Notificações

Este serviço é responsável por buscar uma transação ou assinatura a partir do código da notificação, ele 
deve ser utilizado para acompanhar a alteração do status de pagamento de um pagamento ou assinatura. Seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |<---- (A) notifica alteração -----------|
     |                                        |
     |----- (B) solicita dados -------------->|
     |                                        |
     |<---- (C) envia resposta ---------------|
     
* (A) O PagSeguro envia uma requisição à uma página (configurada na conta do pagseguro) notificando uma mudança de status 
* (B) A loja busca a transação ou assinatura a partir do código da notificação
* (C) PagSeguro envia resposta da requisição com os detalhes da transação

O uso básico é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

// Caso estiver testando, a linha abaixo deve estar descomentada (assim o pagseguro conseguirá enviar requisições locais via JavaScript)
// header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

use PHPSC\PagSeguro\Purchases\Subscriptions\Locator as SubscriptionLocator;
use PHPSC\PagSeguro\Purchases\Transactions\Locator as TransactionLocator;

try {
    $service = $_POST['notificationType'] == 'preApproval'
               ? new SubscriptionLocator($credentials)
               : new TransactionLocator($credentials); // Cria instância do serviço de acordo com o tipo da notificação
               
    $purchase = $service->getByNotification($_POST['notificationCode']);

    var_dump($purchase); // Exibe na tela a transação ou assinatura atualizada
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

### Busca por código

Este serviço é responsável por buscar uma transação ou assinatura a partir de seu código, ele 
deve ser utilizado para buscar os dados completos de uma transação/aassinatura. Seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |----- (A) solicita dados -------------->|
     |                                        |
     |<---- (B) envia resposta ---------------|
     
* (A) A loja busca a transação a partir do código da transação/assinatura (recebido na solicitação de pagamento)
* (B) PagSeguro envia resposta da requisição com os detalhes da transação/assinatura

O uso para busca de transações é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use PHPSC\PagSeguro\Purchases\Transactions\Locator;

try {
    $service = new Locator($credentials); // Cria instância do serviço de localização de transações
    
    $transaction = $service->getByCode('CÓDIGO');

    var_dump($transaction); // Exibe na tela a transação
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

Para assinaturas é muito similar:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use PHPSC\PagSeguro\Purchases\Subscriptions\Locator;

try {
    $service = new Locator($credentials); // Cria instância do serviço de localização de assinaturas
    
    $subscription = $service->getByCode('CÓDIGO');

    var_dump($subscription); // Exibe na tela a assinatura
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

### Gerenciamento da assinatura

O serviço de assinaturas possibilita duas ações a partir do código da assinatura: cobrança (apenas quando a assinatura é de cobrança manual) e cancelamento.

#### Cobrança

Este método é responsável por realizar uma nova cobrança para uma assinatura de cobrança manual. Seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |----- (A) solicita dados -------------->|
     |                                        |
     |<---- (B) envia resposta ---------------|
     
* (A) A loja busca envia uma nova cobrança com o código da assinatura e o detalhe dos itens
* (B) PagSeguro envia resposta da requisição com o código da transação de cobrança

O uso básico é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use PHPSC\PagSeguro\Purchases\Subscriptions\SubscriptionService;

try {
    $service = new SubscriptionService($credentials); // Cria instância do serviço de gerenciamento de assinaturas
    
    $charge = $service->createChargeBuilder('CÓDIGO DA ASSINATURA')
                      ->addItem(new Item(1, 'Pagamento assinatura 1/4', 10))
                      ->getCharge();

    var_dump($service->charge($charge)); // Exibe na tela a resposta da cobrança
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

#### Cancelamento

Este método é responsável por realizar o cancelamento de uma assinatura pela loja. Seu fluxo básico é:

    Loja                                  PagSeguro
     |                                        |
     |----- (A) solicita dados -------------->|
     |                                        |
     |<---- (B) envia resposta ---------------|
     
* (A) A loja busca envia a solicitação de cancelamento com o código da assinatura
* (B) PagSeguro envia resposta da requisição

O uso básico é:

```php
<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado e as credenciais foram configuradas em $credentials

use PHPSC\PagSeguro\Purchases\Subscriptions\SubscriptionService;

try {
    $service = new SubscriptionService($credentials); // Cria instância do serviço de gerenciamento de assinaturas
    
    var_dump($service->cancel('CÓDIGO DA ASSINATURA')); // Exibe na tela a resposta do cancelamento
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}
```

### Licença de uso

Esta biblioteca segue os termos de uso da [Creative Commons Attribution-ShareAlike 2.5](http://creativecommons.org/licenses/by-sa/2.5)


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/PHPSC/pagseguro/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

