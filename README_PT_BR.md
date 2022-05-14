# Inject-Mocks

[![Tests](https://github.com/silasyudi/inject-mocks/actions/workflows/tests.yml/badge.svg)](https://github.com/silasyudi/inject-mocks/actions/workflows/tests.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/b89bc606334c7edec92e/maintainability)](https://codeclimate.com/github/silasyudi/inject-mocks/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/b89bc606334c7edec92e/test_coverage)](https://codeclimate.com/github/silasyudi/inject-mocks/test_coverage)

Injeção automática de mocks nos sujeitos de testes através das annotations @InjectMocks e @Mock, para agilizar e
facilitar a manutenção de testes unitários com PHPUnit.

## Sumário

- [Idioma / Language](#idioma--language)
- [Instalação](#instalao)
- [Pré-requisitos](#pr-requisitos)
- [Funcionalidades](#funcionalidades)
- [Uso](#uso)

## Idioma / Language

Read the English :us: version [here](README.md).

## Instalação

Para instalar no ambiente de desenvolvimento:

```sh
composer require --dev silasyudi/inject-mocks
```

## Pré-requisitos

- PHP 7.4+
- Composer

## Funcionalidades

Através das anotações @InjectMocks e @Mock nas classes de teste você consegue injetar automaticamente os mocks nos
sujeitos de teste.

Em um cenário comum, faríamos dessa forma:

### Exemplo sem @InjectMocks/@Mock:

```php
class SomeTest extends \PHPUnit\Framework\TestCase
{
    public void testSomething() 
    {
        $someDependency = $this->createMock(Dependency::class);    
        $anotherDependency = $this->createMock(AnotherDependency::class);
        ...
        $subject = new Service($someDependency, $anotherDependency, ...);
        ...    
    }
    
    ...
```

Essa abordagem dificulta a manutenção, pois caso o sujeito de teste seja alterado, seja acrescentando, diminuindo ou
substituindo as dependências, você deverá alterá-lo em cada teste.

Com as anotações @InjectMocks/@Mock, abstraímos essas alterações do sujeito de teste. Exemplo:

### Exemplo com @InjectMocks/@Mock:

```php
use SilasYudi\InjectMocks\InjectMocks;
use SilasYudi\InjectMocks\Mock;
use SilasYudi\InjectMocks\MockInjector;

class SomeTest extends \PHPUnit\Framework\TestCase
{
    /** @Mock */
    private Dependency $someDependency;
    /** @Mock */
    private AnotherDependency $anotherDependency;
    
    ...
    
    /** @InjectMocks */
    private Service $subject;
    
    public function setUp() : void 
    {
        MockInjector::inject($this);
    }
    
    public void testSomething()
    {
        // $this->subject e as dependências já estão instanciadas.
    }
    
    ...
```

## Uso

Conforme o exemplo no tópico anterior, a anotação @InjectMocks deve ser colocada sobre a propriedade do sujeito de teste
que se deseja testar, e a anotação @Mock deve ser colocada sobre as propriedades correspondentes às dependências que se
deseja dublar (_mockar_) ou injetar.

Após isso, deve-se executar o serviço injetor com a sentença `MockInjector::inject($this)`. Essa execução pode ser
declarada em cada teste ou no `setUp`.

Após executar o injetor, o `service` anotado com @InjectMocks será uma instância real disponível no escopo da classe de
teste, e cada dependência anotada com @Mock será uma instância de MockObject, injetadas no sujeito de teste através do
construtor, e também estarão disponíveis no escopo da classe de teste.

### Detalhes

#### 1. Escopo das Anotações

- Tanto @InjectMocks quanto @Mock DEVEM ser colocadas sobre uma propriedade TIPADA em uma classe TestCase;
- As propriedades que recebem as anotações @InjectMocks e @Mock DEVEM ser um objeto;
- Você DEVE utilizar apenas uma anotação @InjectMocks por TestCase. Ao utilizar mais de uma no mesmo escopo, esta
  biblioteca utilizará apenas a primeira, e ignorará as demais;
- Você DEVE utilizar uma anotação @Mock para cada dependência do sujeito do teste que você deseja dublar;
- Usar as anotações sobre propriedades não-tipadas ou sobre tipos primitivos causará uma exceção `MockInjectException`.

#### 2. Comportamento das anotações

@InjectMocks e @Mock funcionam independentemente e isoladamente, ou conjuntamente. Detalhes sobre cada uma:

##### 2.1. @InjectMocks

Criará uma instância real através do construtor, e caso hajam parâmetros no construtor, utilizará como valor para cada
parâmetro, nesta ordem:

- Um `mock` criado a partir da anotação @Mock, se houver;
- O valor `default`, caso seja um parâmetro opcional;
- `null`, caso seja tipado como `null`;
- Criará um `mock`, caso não seja tipo primitivo. Neste caso, este `mock` não será injetado no escopo do TestCase;
- Por fim, esgotadas as opções acima, lançará exceção `MockInjectException`.

Obs.: você pode utilizar conjuntamente a anotação @Mock sobre todas, algumas ou nenhuma dependência do sujeito do teste.

##### 2.2. @Mock

Criará um `mock` injetado no escopo do TestCase, sem utilizar o construtor. O comportamento desta criação é idêntico ao
`TestCase::createMock()`.
