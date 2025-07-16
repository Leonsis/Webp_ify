# WebPify

## O que é?

WebPify é uma aplicação web simples que permite baixar todas as imagens de um site a partir de uma URL fornecida. As imagens são salvas automaticamente na pasta `src/php/imagens` do projeto.

## Estrutura do Projeto

```
WebPify/
  ├── assets/
  │   └── img/
  │       └── background.jpg
  ├── imagens/                # (pasta vazia, não utilizada pelo sistema)
  ├── images/                 # (pasta vazia, não utilizada pelo sistema)
  ├── index.html              # Página principal com o formulário
  ├── src/
  │   ├── css/
  │   │   └── style.css       # Estilos da página
  │   ├── js/
  │   │   └── barra.js        # Script JS para barra de progresso (opcional)
  │   └── php/
  │       ├── copia_img.php   # Script PHP que baixa as imagens
  │       └── imagens/        # Pasta onde as imagens baixadas são salvas
  └── README.md
```

## Como usar

1. Abra o arquivo `index.html` no navegador.
2. Insira a URL do site do qual deseja baixar as imagens no campo indicado.
3. Clique em "Submit".
4. As imagens encontradas serão salvas automaticamente na pasta `src/php/imagens`.

## Observações
- O script PHP (`src/php/copia_img.php`) cria a pasta `src/php/imagens` automaticamente, se ela não existir.
- As pastas `imagens/` e `images/` na raiz do projeto não são utilizadas pelo sistema, apenas a pasta `src/php/imagens`.
- O CSS está em `src/css/style.css`.
- O JavaScript para barra de progresso está em `src/js/barra.js` (opcional, pode ser expandido).

---

> Projeto simples para facilitar o download em massa de imagens de qualquer site público.