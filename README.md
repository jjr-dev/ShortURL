# ShortURL

## 👨‍💻 Sobre o projeto
Encurtador de URL feito em PHP sem uso de Banco de Dados com gerador de URL personalizada ou aleatória.

### Como gerar URL
É realmente simples, basta executar as funções para criação da URL encurtada, abertura ou limpeza.
> Lembre-se de utilizar o include do arquivo ```functions.php```.
```php
include 'functions.php';
```
### Criar URL encurtada
```php
shortUrl($url, $custom);
```
| Parâmetro | Descrição | Exemplo | Tipo | Obrigatório |
|--|--|--|--|--|
| $url | URL que será encurtada | https://github.com/JulimarJunior/ShortURL | String | Sim
| $custom | URL encurtada personalizada | shortUrl | string | Não

A função irá gerar um URL personalizado ou aleatório encurtando a URL origem e armazenando no arquivo ```shorts.json```.

### Limpar URL encurtada
```php
clearShortUrl($url);
```
| Parâmetro | Descrição | Exemplo | Tipo | Obrigatório |
|--|--|--|--|--|
| $url | URL que deve ser limpa | ShortURL | String | Sim

A função irá retornar o valor limpo da URL, retirando a base do servidor e obtendo apenas o código para identificar a origem.
**Por exemplo:**
```php
echo clearShortUrl('https://example.com/shortUrl');
// Irá escrever "shortURL";
```

### Abrir URL encurtada
```php
openShortUrl($short);
```
| Parâmetro | Descrição | Exemplo | Tipo | Obrigatório |
|--|--|--|--|--|
| $short | URL encurtada já sem a URL do servidor | ShortURL | String | Sim

### Limpar e abrir URL encurtada
É possível já enviar para o ```openShortUrl()``` já a URL atual da página e realizar o redirecionamento diretamente.
```php
openShortUrl(clearShortUrl($_SERVER["REQUEST_URI"]));
```
O código obtêm o URL atual da página que está aberta, separando o código da URL encurtada e redirecionando para a URL original.
> É obrigatório o uso do HTACCESS para que essa função funcione corretamente.

## Utilização
Utilize o **shortURL** adicionando todos os arquivos em uma pasta única para ele no servidor e no index.php da mesma mantenha apenas o exemplo de **Limpar e abrir URL encurtada**.

Assim, ao acessar o diretório com a URL encurtada o usuário será automaticamente redirecionado.

Por exemplo, ao acessar https://example.com/s/shortURL ele será redirecionado para https://github.com/JulimarJunior/ShortURL.

Veja o exemplo no arquivo ```index.php``` do repositório.
