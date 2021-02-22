## 🔗ShortURL

## 💬 Sobre o projeto
Encurtador de URL em PHP sem banco de dados com URL personalizada e aleatória.

![Author - Julimar Junior](https://img.shields.io/badge/Author-Julimar%20Junior-blue?logo=github&url=https://github.com/JulimarJunior)

## 🚀 Atualizações
Acompanhe as atualizações que ocorreram anteriormente no **shortURL**.
| Data | Versão | Descrição |
|--|--|--|
|20/02/2021 | 1.0 | Base do projeto
| 22/02/2021 | 1.1 | Ajustes de retornos

## 👨‍💻 Instalação
1. Baixe todos os arquivos do repositório **shortURL** em uma pasta do servidor vazia (exclusiva para o **shortURL**:
```html
www/s/<!-- Arquivos shortURL -->
```
2. Inclua o ```functions.php``` do **shortURL** ao sistema que desejar:
```php
include 's/functions.php';
```

## 🖐️ Funções
### shortUrl
A função **shortUrl** gera a URL encurtada e armazena suas informações no arquivo *.json*.
```php
shortUrl($url, $custom);
```
| Parâmetro | Descrição | Exemplo | Tipo | Obrigatório |
|--|--|--|--|--|
| $url | URL que será encurtada. | https://github.com/JulimarJunior/ShortURL | string | Sim
| $custom | URL encurtada personalizada. | shortUrl | string | Não

Caso o parâmetro ```$custom``` seja enviado, a função irá gerar a URL encurtada utilizando-o após verificar duplicidade de URL encurtada customizada.

#### Exemplos de URL encurtadas:
```php
shortURL('https://github.com');
// URL encurtada: https://example.com/s/2yu3gf;

shortURL('https://github.com', 'gitHub');
// URL encurtada: https://example.com/s/gitHub;
```

### clearShortUrl
A função **clearShortUrl** remove as "impurezas" da URL enviada, mantendo apenas a a identificação da URL encurtada (que deve obrigatoriamente está presente após a última **/** da URL).
```php
clearShortUrl($url);
```
| Parâmetro | Descrição | Exemplo | Tipo | Obrigatório |
|--|--|--|--|--|
| $url | URL que deve ser limpa. | ShortURL | string | Sim

Deve ser utilizada para obter os dados da URL encurtadas.

#### Exemplos de limpeza da URL:
```php
clearShortUrl('https://example.com/2yu3gf');
// URL limpa: 2yu3gf;

clearShortUrl('https://example.com/shortUrl');
// URL limpa: shortUrl;
```

### openShortUrl
A função **openShortUrl** abre a URL original a partir da identificação da URL encurtada, contabiliza a quantidade de acessos (armazenando no arquivo *.json*) e redireciona o usuário para a URL original.
```php
openShortUrl($short);
```
| Parâmetro | Descrição | Exemplo | Tipo | Obrigatório |
|--|--|--|--|--|
| $short | URL encurtada já sem a URL do servidor. | ShortURL | String | Sim

O envio da URL para o **openShortUrl** pode ser feito já utilizando o **clearShortUrl** e também a URL atual caso esteja sendo executado diretamente no index do diretório.

#### Exemplo:
```php
openShortUrl(clearShortUrl($_SERVER["REQUEST_URI"]));
```
| Item | Descrição |
|--|--|
| openShortUrl() | Abre a URL original a partir da identificação encurtada. |
| clearShortUrl() | Obtém a identificação da URL encurtada. |
| $_SERVER["REQUEST_URI"] | Obtém a URL atual no navegador. |

## 👋 Por fim (mas não menos importante)
O projeto **shortURL** é um repositório de código livre, qualquer um pode (caso deseje) fazer atualizações para seus respectivos sistemas e utiliza-lo.
