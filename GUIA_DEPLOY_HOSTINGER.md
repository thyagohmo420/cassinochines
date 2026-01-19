# 🚀 GUIA COMPLETO DE DEPLOY - HOSTINGER
## Plataforma VIPERPRO - Casino Online

---

## 📋 PRÉ-REQUISITOS

Antes de começar, você precisa ter:

- ✅ Conta ativa no Hostinger
- ✅ Domínio configurado
- ✅ Acesso ao **File Manager** (Gerenciador de Arquivos)
- ✅ Acesso ao **phpMyAdmin**
- ✅ PHP 8.1 ou superior habilitado
- ✅ Extensões PHP necessárias (geralmente já vem habilitadas no Hostinger):
  - `php-curl`
  - `php-intl`
  - `php-mbstring`
  - `php-xml`
  - `php-zip`
  - `php-mysql`
  - `php-bcmath`

---

## 🗂️ PASSO 1: PREPARAR OS ARQUIVOS

### 1.1. Compactar o Projeto

No seu computador local, compacte **TODO o projeto** em um arquivo `.zip`:

```bash
# Certifique-se de incluir:
- app/
- bootstrap/
- config/
- database/
- public/
- resources/
- routes/
- storage/
- vendor/
- .htaccess (raiz)
- artisan
- composer.json
- composer.lock
- package.json
```

**⚠️ IMPORTANTE**:
- Inclua a pasta `vendor/` (dependências do Composer)
- Inclua a pasta `storage/` com suas subpastas
- Inclua a pasta `public/build/` (assets compilados)
- **NÃO inclua** o arquivo `.env` (você vai criar no servidor)

### 1.2. Dividir o Arquivo (se necessário)

Se o arquivo `.zip` for muito grande (> 500MB), você pode:

1. **Opção A**: Fazer upload via FTP usando FileZilla
2. **Opção B**: Dividir em partes e fazer upload pelo File Manager

---

## 🌐 PASSO 2: UPLOAD PARA O HOSTINGER

### 2.1. Acessar o File Manager

1. Faça login no [hPanel do Hostinger](https://hpanel.hostinger.com)
2. Vá em **Arquivos** → **Gerenciador de Arquivos**
3. Navegue até a pasta `public_html/` (ou a pasta do seu domínio)

### 2.2. Fazer Upload

1. Clique em **Upload**
2. Selecione o arquivo `.zip` do projeto
3. Aguarde o upload completar (pode demorar)

### 2.3. Extrair Arquivos

1. Clique com botão direito no arquivo `.zip`
2. Selecione **Extrair**
3. Extraia para: `public_html/` ou `/domains/seudominio.com/public_html/`
4. Aguarde a extração
5. **Delete o arquivo .zip** após extrair para economizar espaço

---

## ⚙️ PASSO 3: CONFIGURAR O DOCUMENT ROOT

**MUITO IMPORTANTE**: O Laravel precisa que o document root aponte para a pasta `/public/`

### Método 1: Configurar via hPanel (Recomendado)

1. No hPanel, vá em **Domínios**
2. Clique no domínio que você quer configurar
3. Role até **Configurações Avançadas**
4. Em **Document Root**, mude para:
   ```
   /public_html/public
   ```
   OU
   ```
   /domains/seudominio.com/public_html/public
   ```
5. Salve as alterações
6. Aguarde alguns minutos para propagar

### Método 2: Usar o .htaccess (Fallback)

Se não conseguir configurar o document root, o projeto já tem um `.htaccess` na raiz que redireciona automaticamente para `/public/`.

---

## 🗃️ PASSO 4: CRIAR O BANCO DE DADOS

### 4.1. Criar Database

1. No hPanel, vá em **Banco de Dados MySQL**
2. Clique em **Criar Novo Banco de Dados**
3. Preencha:
   - **Nome do Banco**: `viperpro_db` (ou o que preferir)
   - **Usuário**: Crie um novo ou use existente
   - **Senha**: Use uma senha forte
4. Anote essas informações (você vai precisar!)

### 4.2. Importar as Tabelas

**Opção A: Usar Migrations (Recomendado)**

Você vai fazer isso no PASSO 6, após configurar o `.env`.

**Opção B: Importar SQL via phpMyAdmin**

1. Acesse o **phpMyAdmin** no hPanel
2. Selecione o banco de dados criado
3. Clique em **Importar**
4. Escolha o arquivo `.sql` (se você exportou)
5. Clique em **Executar**

---

## 🔐 PASSO 5: CONFIGURAR O ARQUIVO .env

### 5.1. Copiar o Template

1. No File Manager, navegue até a raiz do projeto
2. Localize o arquivo `.env.example`
3. **Duplique** o arquivo
4. Renomeie a cópia para `.env`

### 5.2. Editar o .env

Clique com botão direito em `.env` → **Editar**

Configure as seguintes variáveis:

```env
# ==============================================================================
# CONFIGURAÇÃO BÁSICA
# ==============================================================================
APP_NAME="VIPERPRO"
APP_ENV=production
APP_KEY=                           # Deixe vazio por enquanto
APP_DEBUG=false                    # SEMPRE false em produção!
APP_URL=https://seudominio.com     # Seu domínio real
APP_DEMO=false

# ==============================================================================
# BANCO DE DADOS
# ==============================================================================
DB_CONNECTION=mysql
DB_HOST=localhost                  # Ou o host fornecido pelo Hostinger
DB_PORT=3306
DB_DATABASE=viperpro_db           # Nome do seu banco
DB_USERNAME=seu_usuario_mysql      # Usuário do banco
DB_PASSWORD=sua_senha_mysql        # Senha do banco

# ==============================================================================
# EMAIL (Configurar depois)
# ==============================================================================
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_app_gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# ==============================================================================
# JWT (Deixe vazio por enquanto)
# ==============================================================================
JWT_SECRET=
JWT_ALGO=HS256

# ==============================================================================
# PUSHER - WebSockets (Configure se for usar)
# ==============================================================================
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

# ==============================================================================
# GATEWAY DE PAGAMENTO - ESCOLHA UM E CONFIGURE
# ==============================================================================

# STRIPE (Descomente se for usar)
# STRIPE_ENABLED=true
# STRIPE_KEY=pk_live_xxxxxxxxxxxx
# STRIPE_SECRET=sk_live_xxxxxxxxxxxx
# STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxx

# SUITPAY (Descomente se for usar)
# SUITPAY_URI=https://api.suitpay.app
# SUITPAY_CLIENT_ID=seu_client_id
# SUITPAY_CLIENT_SECRET=seu_client_secret

# DIGITOPAY (Descomente se for usar)
# DIGITOPAY_URI=https://api.digitopay.com.br
# DIGITOPAY_CLIENT_ID=seu_client_id
# DIGITOPAY_CLIENT_SECRET=seu_client_secret

# EZZEBANK (Descomente se for usar)
# EZZEBANK_URI=https://api.ezzebank.com
# EZZEBANK_CLIENT_ID=seu_client_id
# EZZEBANK_CLIENT_SECRET=seu_client_secret

# BSPAY (Descomente se for usar)
# BSPAY_URI=https://api.bspay.com.br
# BSPAY_CLIENT_ID=seu_client_id
# BSPAY_CLIENT_SECRET=seu_client_secret

# SHARKPAY (Descomente se for usar)
# SHARKPAY_PUBLIC_KEY=seu_public_key
# SHARKPAY_PRIVATE_KEY=seu_private_key

# MERCADOPAGO (Descomente se for usar)
# MERCADOPAGO_PUBLIC_KEY=seu_public_key
# MERCADOPAGO_ACCESS_TOKEN=seu_access_token
```

**Salve o arquivo** após editar.

---

## 🔧 PASSO 6: CONFIGURAR O PROJETO VIA TERMINAL

O Hostinger Premium e Business geralmente têm acesso SSH. Se você tem acesso:

### 6.1. Conectar via SSH

```bash
ssh usuario@seudominio.com
cd public_html/  # ou /domains/seudominio.com/public_html/
```

### 6.2. Gerar APP_KEY

```bash
php artisan key:generate
```

Isso vai gerar e salvar automaticamente a `APP_KEY` no `.env`.

### 6.3. Gerar JWT_SECRET

```bash
php artisan jwt:secret
```

Isso vai gerar e salvar automaticamente a `JWT_SECRET` no `.env`.

### 6.4. Executar Migrations

```bash
php artisan migrate --force
```

Isso criará todas as 71 tabelas do banco de dados automaticamente!

### 6.5. Criar Link Simbólico do Storage

```bash
php artisan storage:link
```

### 6.6. Limpar e Cachear Configurações

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6.7. Definir Permissões

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 🔑 PASSO 7: CONFIGURAR PERMISSÕES (Sem SSH)

Se você **NÃO tem acesso SSH**, faça via File Manager:

### 7.1. APP_KEY Manual

1. Acesse: https://generate-random.org/laravel-key-generator
2. Copie a chave gerada (ex: `base64:xxxxx....`)
3. No `.env`, cole em `APP_KEY=base64:xxxxx....`

### 7.2. JWT_SECRET Manual

1. Acesse: https://www.grc.com/passwords.htm
2. Copie a "63 random hexadecimal characters"
3. No `.env`, cole em `JWT_SECRET=xxxxx....`

### 7.3. Executar Migrations via Browser

Crie um arquivo temporário `setup.php` na pasta `public/`:

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

echo "<h1>Setup</h1>";

// Executar migrations
echo "<h2>Running Migrations...</h2>";
\Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";

// Storage link
echo "<h2>Creating Storage Link...</h2>";
\Illuminate\Support\Facades\Artisan::call('storage:link');
echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";

// Clear cache
echo "<h2>Clearing Cache...</h2>";
\Illuminate\Support\Facades\Artisan::call('cache:clear');
\Illuminate\Support\Facades\Artisan::call('config:clear');
\Illuminate\Support\Facades\Artisan::call('view:clear');
echo "<p>Cache cleared!</p>";

echo "<h2>✅ Setup Complete!</h2>";
echo "<p><strong>IMPORTANT: DELETE THIS FILE NOW!</strong></p>";
```

Acesse: `https://seudominio.com/setup.php`

**⚠️ IMPORTANTE**: Delete o arquivo `setup.php` imediatamente após usar!

### 7.4. Permissões via File Manager

1. Selecione a pasta `storage/`
2. Clique com botão direito → **Permissões**
3. Marque: `775` ou `Ler, Escrever, Executar` para Owner e Group
4. Marque **Aplicar recursivamente**
5. Confirme

Repita para `bootstrap/cache/`

---

## 🎮 PASSO 8: CONFIGURAR O GATEWAY DE PAGAMENTO

### 8.1. Acessar o Admin Panel

1. Primeiro, crie um usuário admin via SSH ou database:

**Via SSH:**
```bash
php artisan tinker
```

```php
$user = new App\Models\User;
$user->name = 'Admin';
$user->email = 'admin@seudominio.com';
$user->password = bcrypt('senha_forte_123');
$user->email_verified_at = now();
$user->save();

// Atribuir role de admin
$user->assignRole('admin');
```

**Via phpMyAdmin:**
```sql
INSERT INTO users (name, email, password, email_verified_at, created_at, updated_at)
VALUES ('Admin', 'admin@seudominio.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW(), NOW());
```
(Senha: `password`)

2. Acesse: `https://seudominio.com/admin`
3. Faça login com as credenciais criadas

### 8.2. Configurar Gateway

1. No painel admin, vá em **Settings** ou **Gateways**
2. Localize a seção de configuração de pagamentos
3. Preencha as credenciais do gateway escolhido:
   - **Client ID**
   - **Client Secret**
   - **API Key** (se aplicável)
   - **URLs de Webhook**

### 8.3. Testar Pagamentos

1. Crie uma conta de usuário teste
2. Tente fazer um depósito
3. Verifique se o webhook está funcionando
4. Confirme que a transação aparece no admin

---

## 🔒 PASSO 9: SEGURANÇA ADICIONAL

### 9.1. Forçar HTTPS

No arquivo `public/.htaccess`, descomente as linhas:

```apache
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 9.2. Proteger Arquivos Sensíveis

Certifique-se que estes arquivos/pastas estão protegidos:
- ✅ `.env` (não deve ser acessível via web)
- ✅ `.git/` (não deve existir em produção)
- ✅ `storage/` (não deve ser acessível diretamente)
- ✅ `vendor/` (não deve ser acessível diretamente)

### 9.3. Backup Automático

Configure backups automáticos no Hostinger:
1. hPanel → **Backups**
2. Configure backup diário/semanal
3. Guarde uma cópia local também

---

## ✅ PASSO 10: VERIFICAÇÕES FINAIS

### Checklist:

- [ ] Site abre sem erros (https://seudominio.com)
- [ ] Páginas carregam corretamente
- [ ] Login funciona
- [ ] Registro de usuário funciona
- [ ] Upload de imagens funciona (testar avatar)
- [ ] Jogos carregam
- [ ] Pagamento de teste funciona
- [ ] Admin panel acessível (/admin)
- [ ] Emails sendo enviados (testar recuperação de senha)
- [ ] SSL/HTTPS funcionando
- [ ] Sem erros no console do navegador (F12)

---

## 🐛 SOLUÇÃO DE PROBLEMAS

### Erro: "500 Internal Server Error"

**Solução:**
1. Habilite debug temporariamente: `APP_DEBUG=true` no `.env`
2. Acesse o site para ver o erro detalhado
3. Corrija o problema
4. **Desabilite debug**: `APP_DEBUG=false`

### Erro: "No application encryption key"

**Solução:**
```bash
php artisan key:generate
```

### Erro: "SQLSTATE[HY000] [1045] Access denied"

**Solução:**
- Verifique as credenciais do banco no `.env`
- Confirme que o usuário tem permissões no banco
- Teste a conexão via phpMyAdmin

### Erro: "Class not found"

**Solução:**
```bash
composer dump-autoload
php artisan config:clear
```

### Erro: "Storage not found"

**Solução:**
```bash
php artisan storage:link
```

### Site carrega sem CSS/JS

**Solução:**
1. Verifique se a pasta `public/build/` existe
2. Limpe o cache:
```bash
php artisan cache:clear
php artisan view:clear
```
3. Se necessário, recompile os assets localmente:
```bash
npm run build
```
E faça upload da pasta `public/build/` novamente

### Erro de Permissão (Storage)

**Solução via SSH:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R seu_usuario:seu_usuario storage
chown -R seu_usuario:seu_usuario bootstrap/cache
```

**Solução via File Manager:**
- Permissões 775 em `storage/` e subpastas
- Permissões 775 em `bootstrap/cache/`

---

## 📞 SUPORTE

Se encontrar problemas:

1. **Logs do Laravel**: Verifique `storage/logs/laravel.log`
2. **Logs do Servidor**: hPanel → **Logs de Erro**
3. **Documentação Laravel**: https://laravel.com/docs
4. **Hostinger Suporte**: https://www.hostinger.com.br/tutoriais/

---

## 🎉 PARABÉNS!

Se você chegou até aqui e tudo está funcionando, seu **VIPERPRO Casino** está no ar! 🎰

### Próximos Passos:

1. Configure os provedores de jogos
2. Adicione mais gateways de pagamento
3. Customize as cores e branding
4. Configure o sistema de afiliados
5. Adicione conteúdo e jogos
6. Faça marketing e divulgue!

**Bom trabalho e bons lucros! 💰**

---

## 📝 NOTAS IMPORTANTES

- **NUNCA** compartilhe seu arquivo `.env`
- **SEMPRE** mantenha backups regulares
- **MONITORE** os logs de erro regularmente
- **ATUALIZE** as dependências periodicamente (com cuidado)
- **TESTE** tudo antes de divulgar o site
- **CUMPRA** as leis de jogos online do seu país

---

**Versão do Guia:** 1.0
**Última Atualização:** Janeiro 2026
**Plataforma:** VIPERPRO - Laravel 10 + Vue 3
