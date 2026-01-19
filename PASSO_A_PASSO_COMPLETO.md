# 📥 GUIA COMPLETO: DO PC ATÉ O AR NO HOSTINGER

## Passo a Passo Detalhado - Não pule nenhuma etapa!

---

## 🖥️ PARTE 1: BAIXAR O PROJETO NO SEU PC

### Opção A: Se você tem Git instalado

1. Abra o **terminal** (CMD, PowerShell ou Git Bash no Windows)

2. Navegue até a pasta onde quer salvar:
```bash
cd C:\Users\SeuUsuario\Desktop
```

3. Clone o repositório:
```bash
git clone https://github.com/thyagohmo420/cassinochines.git
cd cassinochines
```

4. Baixe a branch com as configurações:
```bash
git checkout claude/explain-codebase-mkktfzyviuhspbsk-IbQk2
git pull
```

### Opção B: Sem Git (Download direto)

1. Acesse: https://github.com/thyagohmo420/cassinochines

2. Clique no botão **"Code"** (verde)

3. Clique em **"Download ZIP"**

4. Extraia o arquivo `.zip` em uma pasta no seu PC
   - Exemplo: `C:\Users\SeuUsuario\Desktop\cassinochines\`

---

## 📦 PARTE 2: PREPARAR O PROJETO PARA UPLOAD

### Passo 1: Instalar Dependências (IMPORTANTE!)

Se você não tem as pastas `vendor/` e `node_modules/`, precisa instalar:

**A. Instalar Composer (PHP)**

1. Baixe: https://getcomposer.org/download/
2. Instale no Windows
3. Abra o terminal na pasta do projeto
4. Execute:
```bash
composer install --no-dev --optimize-autoloader
```

**B. Instalar Node/NPM e compilar assets**

1. Baixe Node.js: https://nodejs.org/
2. Instale (versão LTS)
3. No terminal, execute:
```bash
npm install
npm run build
```

⚠️ **IMPORTANTE**: A pasta `public/build/` precisa existir com os arquivos JS/CSS compilados!

### Passo 2: Verificar se tem tudo

Na pasta do projeto, confirme que existem:

```
cassinochines/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   ├── build/          ← IMPORTANTE! (CSS e JS compilados)
│   └── index.php
├── resources/
├── routes/
├── storage/
├── vendor/             ← IMPORTANTE! (dependências PHP)
├── .htaccess
├── .env.example        ← Novo arquivo criado
├── artisan
├── composer.json
├── GUIA_DEPLOY_HOSTINGER.md    ← Novos guias
├── CONFIGURACAO_GATEWAYS.md
├── EXPORT_DATABASE.md
└── README.md
```

### Passo 3: Compactar o Projeto

**ATENÇÃO**: Compacte APENAS o conteúdo da pasta, não a pasta inteira!

**No Windows:**

1. Entre na pasta `cassinochines/`
2. Selecione **TODOS os arquivos e pastas** (Ctrl+A)
3. Clique com botão direito → **Enviar para** → **Pasta compactada (zip)**
4. Renomeie para: `viperpro.zip`

**Ou use WinRAR/7-Zip:**
- Selecione tudo dentro da pasta
- Compacte como `viperpro.zip`

⚠️ **MUITO IMPORTANTE**:
- A estrutura dentro do ZIP deve ser: `viperpro.zip` → `app/`, `public/`, `.htaccess`, etc.
- E NÃO: `viperpro.zip` → `cassinochines/` → `app/`, `public/`, etc.

---

## 🗄️ PARTE 3: EXPORTAR O BANCO DE DADOS

### Se você tem o banco rodando localmente:

#### Método 1: Via phpMyAdmin (MAIS FÁCIL)

1. Abra seu **phpMyAdmin local**
   - Geralmente: http://localhost/phpmyadmin

2. No menu lateral esquerdo, clique no **nome do banco de dados** do projeto

3. Clique na aba **"Exportar"** no topo

4. Escolha **"Método: Personalizado"**

5. Configure assim:
   - ✅ **Formato**: SQL
   - ✅ **Tabelas**: Selecionar todas
   - ✅ **Estrutura**: Marcar tudo
   - ✅ **Adicionar DROP TABLE**: ✅
   - ✅ **Adicionar IF NOT EXISTS**: ✅
   - ✅ **Dados**: Marcar "INSERT"
   - ✅ **Criar banco de dados**: ✅ (se quiser)

6. Clique em **"Executar"**

7. Salve o arquivo como: `viperpro_database.sql`
   - Salve na mesma pasta onde está o `viperpro.zip`

#### Método 2: Via Terminal (mysqldump)

```bash
# Exportar tudo (estrutura + dados)
mysqldump -u root -p nome_do_banco > viperpro_database.sql

# Ou com usuário específico
mysqldump -u seu_usuario -p nome_do_banco > viperpro_database.sql
```

### Se você NÃO tem o banco localmente:

Sem problema! Você vai criar as tabelas usando as **migrations do Laravel** direto no Hostinger.

Pule para a **PARTE 4**.

---

## 🌐 PARTE 4: CONFIGURAR NO HOSTINGER

### Passo 1: Acessar o hPanel

1. Acesse: https://hpanel.hostinger.com
2. Faça login com sua conta

### Passo 2: Criar o Banco de Dados MySQL

1. No hPanel, localize **"Banco de Dados"** no menu lateral
2. Clique em **"Banco de Dados MySQL"**
3. Clique em **"Criar Novo Banco de Dados"**

4. Preencha:
   ```
   Nome do Banco: u123456789_viperpro
   Nome de Usuário: u123456789_viperpro (ou crie novo)
   Senha: [crie uma senha FORTE]
   ```

5. Clique em **"Criar"**

6. ⚠️ **ANOTE EM UM BLOCO DE NOTAS**:
   ```
   DB_HOST=localhost
   DB_DATABASE=u123456789_viperpro
   DB_USERNAME=u123456789_viperpro
   DB_PASSWORD=sua_senha_aqui
   ```

### Passo 3: Importar o SQL (se você exportou)

1. No hPanel, ainda em **"Banco de Dados MySQL"**

2. Localize o banco que você criou

3. Clique em **"Gerenciar"** ou no ícone do phpMyAdmin

4. No phpMyAdmin do Hostinger:
   - Selecione o banco `u123456789_viperpro` no menu esquerdo
   - Clique na aba **"Importar"**
   - Clique em **"Escolher arquivo"**
   - Selecione o arquivo `viperpro_database.sql`
   - Role até o final e clique em **"Executar"**

5. Aguarde a importação (pode demorar alguns minutos)

6. ✅ Você deve ver a mensagem: **"Importação finalizada com sucesso"**

---

## 📁 PARTE 5: FAZER UPLOAD DOS ARQUIVOS

### Passo 1: Acessar o Gerenciador de Arquivos

1. No hPanel, clique em **"Arquivos"** no menu lateral

2. Clique em **"Gerenciador de Arquivos"**

3. Você verá uma lista de pastas. Procure por:
   - `public_html/` (se é a conta principal)
   - OU `/domains/seudominio.com/public_html/` (se é um domínio adicional)

4. Entre na pasta `public_html/`

### Passo 2: Limpar a Pasta (se necessário)

Se já existe algum arquivo (como um index.html padrão):

1. Selecione todos os arquivos dentro de `public_html/`
2. Clique no ícone da **lixeira** para deletar
3. Confirme

### Passo 3: Fazer Upload do ZIP

1. Dentro de `public_html/`, clique no botão **"Upload de Arquivos"** (ícone de nuvem com seta)

2. Arraste o arquivo `viperpro.zip` ou clique para selecionar

3. Aguarde o upload completar
   - O tempo depende do tamanho (pode levar 10-30 minutos)
   - Uma barra de progresso aparecerá

4. Quando terminar, clique em **"Voltar ao Gerenciador de Arquivos"**

### Passo 4: Extrair os Arquivos

1. No Gerenciador de Arquivos, você verá o arquivo `viperpro.zip`

2. Clique com botão direito no arquivo `viperpro.zip`

3. Selecione **"Extrair"**

4. Na janela que abrir:
   - **Caminho de destino**: `/public_html/` (ou o caminho atual)
   - Clique em **"Extrair"**

5. Aguarde a extração (pode demorar)

6. ✅ Após extrair, você verá todas as pastas: `app/`, `public/`, `routes/`, etc.

7. **Delete o arquivo `viperpro.zip`** para economizar espaço:
   - Selecione `viperpro.zip`
   - Clique no ícone da lixeira

### Passo 5: Verificar a Estrutura

Dentro de `public_html/`, você deve ver:

```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .htaccess
├── artisan
├── composer.json
├── GUIA_DEPLOY_HOSTINGER.md
└── (outros arquivos...)
```

✅ **Perfeito!** Arquivos no lugar!

---

## ⚙️ PARTE 6: CONFIGURAR O DOCUMENT ROOT

**MUITO IMPORTANTE**: O Laravel precisa que o navegador acesse a pasta `/public/`, não a raiz.

### Opção A: Configurar via hPanel (RECOMENDADO)

1. No hPanel, vá em **"Domínios"** no menu lateral

2. Localize seu domínio e clique nele

3. Role até a seção **"Configurações Avançadas"**

4. Procure por **"Document Root"** ou **"Raiz do Documento"**

5. Mude o caminho para:
   ```
   /public_html/public
   ```

   OU (se for domínio adicional):
   ```
   /domains/seudominio.com/public_html/public
   ```

6. Clique em **"Salvar"**

7. Aguarde 2-5 minutos para propagar

### Opção B: Usar o .htaccess (Fallback)

Se não conseguir mudar o Document Root, o projeto já tem um `.htaccess` na raiz que redireciona automaticamente para `/public/`.

Basta garantir que o arquivo `/.htaccess` existe (você já fez upload dele).

---

## 🔐 PARTE 7: CONFIGURAR O ARQUIVO .env

### Passo 1: Criar o arquivo .env

1. No **Gerenciador de Arquivos**, navegue até: `/public_html/`

2. Localize o arquivo `.env.example`

3. Clique com **botão direito** em `.env.example`

4. Selecione **"Copiar"**

5. Cole na mesma pasta

6. Renomeie a cópia para: `.env`

### Passo 2: Editar o .env

1. Clique com **botão direito** no arquivo `.env`

2. Selecione **"Editar"**

3. Um editor de texto abrirá. Edite as seguintes linhas:

```env
# ==============================================================================
# CONFIGURAÇÃO BÁSICA
# ==============================================================================
APP_NAME="VIPERPRO"
APP_ENV=production
APP_KEY=                                    ← DEIXE VAZIO POR ENQUANTO
APP_DEBUG=false                             ← SEMPRE false em produção!
APP_URL=https://seudominio.com              ← COLOQUE SEU DOMÍNIO REAL
APP_DEMO=false

# ==============================================================================
# BANCO DE DADOS
# ==============================================================================
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_viperpro             ← COLE O NOME DO SEU BANCO
DB_USERNAME=u123456789_viperpro             ← COLE SEU USUÁRIO
DB_PASSWORD=sua_senha_forte_aqui            ← COLE SUA SENHA

# ==============================================================================
# EMAIL (Configure depois se quiser)
# ==============================================================================
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=                              ← Deixe vazio por enquanto
MAIL_PASSWORD=                              ← Deixe vazio por enquanto
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

# ==============================================================================
# JWT
# ==============================================================================
JWT_SECRET=                                 ← DEIXE VAZIO POR ENQUANTO
JWT_ALGO=HS256

# ==============================================================================
# PUSHER (Configure depois se quiser)
# ==============================================================================
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

# ==============================================================================
# GATEWAY DE PAGAMENTO - ESCOLHA UM
# ==============================================================================
# Deixe TUDO comentado por enquanto
# Você vai configurar depois seguindo o guia CONFIGURACAO_GATEWAYS.md
```

4. Clique em **"Salvar e Fechar"**

---

## 🔧 PARTE 8: EXECUTAR COMANDOS (SETUP FINAL)

Agora você precisa executar alguns comandos do Laravel.

### Opção A: Via SSH (Se você tem acesso)

1. No hPanel, vá em **"Avançado"** → **"SSH Access"**

2. Copie o comando de conexão SSH

3. No seu terminal (PC), conecte:
```bash
ssh u123456789@seudominio.com
```

4. Digite a senha quando solicitado

5. Navegue até a pasta:
```bash
cd public_html/
ls -la
```

6. Execute os comandos na ordem:

```bash
# 1. Gerar APP_KEY
php artisan key:generate

# 2. Gerar JWT_SECRET
php artisan jwt:secret

# 3. Se você NÃO importou o SQL, execute as migrations
php artisan migrate --force

# 4. Criar link do storage
php artisan storage:link

# 5. Limpar e cachear configurações
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache

# 6. Configurar permissões
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

✅ **Pronto!** Pule para a **PARTE 9**.

### Opção B: Sem SSH (Via script temporário)

1. No **Gerenciador de Arquivos**, navegue até: `/public_html/public/`

2. Clique em **"Novo Arquivo"**

3. Nomeie: `setup.php`

4. Clique em **"Editar"**

5. Cole este código:

```php
<?php
// ⚠️ DELETE ESTE ARQUIVO APÓS USAR!

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<html><head><title>Setup VIPERPRO</title></head><body>";
echo "<h1>🎰 Setup VIPERPRO</h1>";
echo "<pre>";

// 1. Gerar APP_KEY
echo "\n=== Gerando APP_KEY ===\n";
$kernel->call('key:generate', ['--force' => true]);

// 2. Gerar JWT_SECRET
echo "\n=== Gerando JWT_SECRET ===\n";
$kernel->call('jwt:secret', ['--force' => true]);

// 3. Executar migrations (APENAS se você NÃO importou o SQL)
// Descomente as linhas abaixo se você NÃO importou o SQL via phpMyAdmin:
// echo "\n=== Executando Migrations ===\n";
// $kernel->call('migrate', ['--force' => true]);

// 4. Criar link do storage
echo "\n=== Criando Storage Link ===\n";
$kernel->call('storage:link', ['--force' => true]);

// 5. Limpar cache
echo "\n=== Limpando Cache ===\n";
$kernel->call('config:clear');
$kernel->call('cache:clear');
$kernel->call('view:clear');
$kernel->call('route:clear');

// 6. Cachear configurações
echo "\n=== Cacheando Configurações ===\n";
$kernel->call('config:cache');
$kernel->call('route:cache');

echo "\n\n✅ ✅ ✅ SETUP COMPLETO! ✅ ✅ ✅\n";
echo "\n⚠️ IMPORTANTE: DELETE ESTE ARQUIVO AGORA!\n";
echo "\n⚠️ Acesse o Gerenciador de Arquivos e delete: public/setup.php\n";
echo "</pre></body></html>";
?>
```

6. Clique em **"Salvar e Fechar"**

7. No navegador, acesse: `https://seudominio.com/setup.php`

8. Aguarde a página carregar e executar os comandos

9. Você verá mensagens de sucesso

10. ⚠️ **IMEDIATAMENTE** volte ao Gerenciador de Arquivos e **DELETE** o arquivo `public/setup.php`

---

## 👤 PARTE 9: CRIAR USUÁRIO ADMIN

### Via SQL (phpMyAdmin) - MAIS FÁCIL

1. Acesse o **phpMyAdmin** do Hostinger

2. Selecione seu banco `u123456789_viperpro`

3. Clique na aba **"SQL"** no topo

4. Cole este código e **MUDE** o email e senha:

```sql
-- Inserir usuário admin
INSERT INTO users (name, email, password, email_verified_at, created_at, updated_at)
VALUES (
    'Administrador',
    'admin@seudominio.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    NOW(),
    NOW(),
    NOW()
);

-- Pegar o ID do usuário criado
SET @user_id = LAST_INSERT_ID();

-- Verificar se o role 'admin' existe, se não, criar
INSERT IGNORE INTO roles (name, guard_name, created_at, updated_at)
VALUES ('admin', 'web', NOW(), NOW());

-- Pegar o ID do role admin
SET @role_id = (SELECT id FROM roles WHERE name = 'admin' LIMIT 1);

-- Atribuir role admin ao usuário
INSERT INTO model_has_roles (role_id, model_type, model_id)
VALUES (@role_id, 'App\\\\Models\\\\User', @user_id);
```

5. Clique em **"Executar"**

6. ✅ Usuário criado!
   - **Email**: admin@seudominio.com
   - **Senha**: password

⚠️ **IMPORTANTE**: Mude a senha depois de fazer login!

---

## ✅ PARTE 10: TESTAR O SITE

### Passo 1: Acessar o Site

1. Abra o navegador

2. Acesse: `https://seudominio.com`

3. O site deve carregar! 🎉

### Passo 2: Fazer Login no Admin

1. Acesse: `https://seudominio.com/admin`

2. Faça login com:
   - **Email**: admin@seudominio.com
   - **Senha**: password

3. Você deve ver o painel admin (Filament)

### Passo 3: Checklist de Funcionamento

Teste se tudo está funcionando:

- [ ] Site abre sem erros
- [ ] CSS e JS carregando (site com aparência correta)
- [ ] Consegue acessar `/admin`
- [ ] Consegue fazer login
- [ ] Dashboard do admin aparece
- [ ] Páginas internas carregam
- [ ] Console do navegador sem erros (F12 → Console)

### Se algo não funcionar:

#### Site não abre / Erro 500:

1. Ative o debug temporariamente
2. Edite o `.env`:
   ```env
   APP_DEBUG=true
   ```
3. Recarregue o site para ver o erro detalhado
4. Corrija o problema
5. **Desative o debug**:
   ```env
   APP_DEBUG=false
   ```

#### CSS/JS não carregando:

- Verifique se a pasta `public/build/` existe e tem arquivos
- Se não tiver, você precisa compilar localmente (`npm run build`) e fazer upload novamente

#### Erro de banco de dados:

- Verifique as credenciais no `.env`
- Teste a conexão no phpMyAdmin

---

## 💳 PARTE 11: CONFIGURAR GATEWAY DE PAGAMENTO

Agora que o site está funcionando, configure um gateway.

### Abra o guia:
📖 **CONFIGURACAO_GATEWAYS.md**

### Gateways Recomendados:

**Para Brasil (PIX):**
- SuitPay
- DigitoPay
- MercadoPago

**Internacional:**
- Stripe

### Passo Rápido (Exemplo com SuitPay):

1. Crie conta em: https://suitpay.app

2. Pegue suas credenciais:
   - Client ID
   - Client Secret

3. Edite o `.env`:
```env
SUITPAY_URI=https://api.suitpay.app
SUITPAY_CLIENT_ID=seu_client_id_aqui
SUITPAY_CLIENT_SECRET=seu_client_secret_aqui
```

4. Limpe o cache:
   - Via SSH: `php artisan config:clear`
   - Ou acesse: `https://seudominio.com/setup.php` (se ainda não deletou)

5. Configure no painel admin:
   - `/admin` → **Settings** → **Gateways**

6. Teste um depósito pequeno!

---

## 🎉 PARABÉNS! ESTÁ NO AR!

Se você chegou até aqui, seu **VIPERPRO Casino** está rodando! 🎰

### Próximos passos:

1. ✅ Mude a senha do admin
2. ✅ Configure o gateway de pagamento
3. ✅ Adicione jogos e configure provedores
4. ✅ Customize cores e branding
5. ✅ Configure emails (SMTP)
6. ✅ Ative HTTPS (força SSL no .htaccess)
7. ✅ Configure backups automáticos
8. ✅ Teste tudo antes de divulgar!

---

## 📝 RESUMO RÁPIDO

1. ✅ Baixei o projeto do GitHub
2. ✅ Instalei dependências (composer + npm)
3. ✅ Compilei assets (npm run build)
4. ✅ Compactei em viperpro.zip
5. ✅ Criei banco de dados no Hostinger
6. ✅ Importei SQL (ou vou usar migrations)
7. ✅ Fiz upload do ZIP via Gerenciador de Arquivos
8. ✅ Extraí os arquivos
9. ✅ Configurei Document Root para /public/
10. ✅ Criei arquivo .env com credenciais do banco
11. ✅ Executei comandos (key:generate, migrate, etc)
12. ✅ Criei usuário admin
13. ✅ Testei o site - FUNCIONOU!
14. ✅ Configurei gateway de pagamento
15. 🚀 SITE NO AR!

---

## 🆘 PRECISA DE AJUDA?

- 📖 Releia as seções específicas deste guia
- 💳 Veja CONFIGURACAO_GATEWAYS.md para gateways
- 🐛 Veja "Solução de Problemas" no GUIA_DEPLOY_HOSTINGER.md
- ❓ Verifique os logs: `storage/logs/laravel.log`

---

**Versão:** 1.0
**Criado:** Janeiro 2026
**Tempo estimado:** 1-2 horas (primeira vez)

🚀 **BOA SORTE!**
