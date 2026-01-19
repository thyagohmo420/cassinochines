# 💳 GUIA DE CONFIGURAÇÃO - GATEWAYS DE PAGAMENTO

Este guia detalha como configurar cada gateway de pagamento disponível na plataforma VIPERPRO.

---

## 📋 GATEWAYS DISPONÍVEIS

1. [Stripe](#1-stripe) ⭐ Internacional
2. [SuitPay](#2-suitpay) 🇧🇷 Brasil
3. [DigitoPay](#3-digitopay) 🇧🇷 Brasil
4. [EzzeBank](#4-ezzebank) 🇧🇷 Brasil
5. [BSPay](#5-bspay) 🇧🇷 Brasil
6. [SharkPay](#6-sharkpay) 🇧🇷 Brasil
7. [MercadoPago](#7-mercadopago) 🇧🇷 América Latina

---

## 1. STRIPE

### Sobre
- **País**: Global
- **Moedas**: USD, EUR, BRL, e mais de 135 moedas
- **Tipos**: Cartão de Crédito, Débito, PIX (Brasil)
- **Site**: https://stripe.com

### Passo a Passo

#### 1.1. Criar Conta
1. Acesse: https://dashboard.stripe.com/register
2. Preencha os dados da sua empresa
3. Ative sua conta (pode precisar de verificação)

#### 1.2. Obter Credenciais
1. Acesse: https://dashboard.stripe.com/apikeys
2. Copie as chaves:
   - **Publishable key** (pk_live_xxxxx ou pk_test_xxxxx)
   - **Secret key** (sk_live_xxxxx ou sk_test_xxxxx)

#### 1.3. Configurar Webhook
1. Vá em: https://dashboard.stripe.com/webhooks
2. Clique em **+ Add endpoint**
3. URL do endpoint: `https://seudominio.com/payment/stripe/webhook`
4. Selecione eventos:
   - `payment_intent.succeeded`
   - `payment_intent.payment_failed`
   - `charge.succeeded`
   - `charge.failed`
5. Copie o **Signing secret** (whsec_xxxxx)

#### 1.4. Configurar no .env
```env
STRIPE_ENABLED=true
STRIPE_SUBSCRIPTION_ENABLED=false
STRIPE_BASE_URI=https://api.stripe.com
STRIPE_WEBHOOK_URI=https://seudominio.com/payment/stripe/webhook
STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxxxxxxxxxxx
STRIPE_KEY=pk_live_xxxxxxxxxxxxxxxxxxxxx
STRIPE_SECRET=sk_live_xxxxxxxxxxxxxxxxxxxxx
```

#### 1.5. Configurar no Banco de Dados
Via phpMyAdmin, execute:
```sql
UPDATE gateways SET
    stripe_production = 1,
    stripe_public_key = 'pk_live_xxxxxxxxxxxxxxxxxxxxx',
    stripe_secret_key = 'sk_live_xxxxxxxxxxxxxxxxxxxxx',
    stripe_webhook_key = 'whsec_xxxxxxxxxxxxxxxxxxxxx'
WHERE id = 1;
```

### Modo Teste (Sandbox)
Para testar, use as chaves de teste:
```env
STRIPE_KEY=pk_test_xxxxxxxxxxxxxxxxxxxxx
STRIPE_SECRET=sk_test_xxxxxxxxxxxxxxxxxxxxx
```

Cartões de teste: https://stripe.com/docs/testing

---

## 2. SUITPAY

### Sobre
- **País**: Brasil 🇧🇷
- **Moedas**: BRL (Real)
- **Tipos**: PIX, Boleto, Cartão
- **Site**: https://suitpay.app

### Passo a Passo

#### 2.1. Criar Conta
1. Acesse: https://suitpay.app
2. Crie sua conta
3. Complete o processo de verificação (KYC)

#### 2.2. Obter Credenciais
1. Acesse o painel: https://dashboard.suitpay.app
2. Vá em **Configurações** → **API**
3. Copie:
   - **Client ID**
   - **Client Secret**

#### 2.3. Configurar Webhook
1. No painel, vá em **Webhooks**
2. Adicione: `https://seudominio.com/payment/suitpay/webhook`
3. Salve a configuração

#### 2.4. Configurar no .env
```env
SUITPAY_URI=https://api.suitpay.app
SUITPAY_CLIENT_ID=seu_client_id_aqui
SUITPAY_CLIENT_SECRET=seu_client_secret_aqui
```

#### 2.5. Configurar no Banco de Dados
```sql
UPDATE gateways SET
    suitpay_uri = 'https://api.suitpay.app',
    suitpay_cliente_id = 'seu_client_id_aqui',
    suitpay_cliente_secret = 'seu_client_secret_aqui'
WHERE id = 1;
```

### Ambiente de Teste
```env
SUITPAY_URI=https://sandbox.suitpay.app
```

---

## 3. DIGITOPAY

### Sobre
- **País**: Brasil 🇧🇷
- **Moedas**: BRL (Real)
- **Tipos**: PIX
- **Site**: https://digitopay.com.br

### Passo a Passo

#### 3.1. Obter Credenciais
1. Entre em contato com: contato@digitopay.com.br
2. Solicite acesso à API
3. Receba suas credenciais

#### 3.2. Configurar no .env
```env
DIGITOPAY_URI=https://api.digitopay.com.br
DIGITOPAY_CLIENT_ID=seu_client_id
DIGITOPAY_CLIENT_SECRET=seu_client_secret
```

#### 3.3. Configurar no Banco de Dados
```sql
UPDATE gateways SET
    digitopay_uri = 'https://api.digitopay.com.br',
    digitopay_cliente_id = 'seu_client_id',
    digitopay_cliente_secret = 'seu_client_secret'
WHERE id = 1;
```

#### 3.4. Configurar Webhook
URL: `https://seudominio.com/payment/digitopay/webhook`

---

## 4. EZZEBANK

### Sobre
- **País**: Brasil 🇧🇷
- **Moedas**: BRL (Real)
- **Tipos**: PIX, TED, DOC
- **Site**: https://ezzebank.com

### Passo a Passo

#### 4.1. Configurar no .env
```env
EZZEBANK_URI=https://api.ezzebank.com
EZZEBANK_CLIENT_ID=seu_client_id
EZZEBANK_CLIENT_SECRET=seu_client_secret
```

#### 4.2. Configurar no Banco de Dados
```sql
UPDATE gateways SET
    ezzebank_uri = 'https://api.ezzebank.com',
    ezzebank_cliente_id = 'seu_client_id',
    ezzebank_cliente_secret = 'seu_client_secret'
WHERE id = 1;
```

#### 4.3. Webhook
URL: `https://seudominio.com/payment/ezzebank/webhook`

---

## 5. BSPAY

### Sobre
- **País**: Brasil 🇧🇷
- **Moedas**: BRL (Real)
- **Tipos**: PIX
- **Site**: https://bspay.com.br

### Passo a Passo

#### 5.1. Configurar no .env
```env
BSPAY_URI=https://api.bspay.com.br
BSPAY_CLIENT_ID=seu_client_id
BSPAY_CLIENT_SECRET=seu_client_secret
```

#### 5.2. Configurar no Banco de Dados
```sql
UPDATE gateways SET
    bspay_uri = 'https://api.bspay.com.br',
    bspay_cliente_id = 'seu_client_id',
    bspay_cliente_secret = 'seu_client_secret'
WHERE id = 1;
```

#### 5.3. Webhook
URL: `https://seudominio.com/payment/bspay/webhook`

---

## 6. SHARKPAY

### Sobre
- **País**: Brasil 🇧🇷
- **Moedas**: BRL (Real)
- **Tipos**: PIX
- **Diferencial**: Usa Public/Private Key

### Passo a Passo

#### 6.1. Obter Chaves
1. Cadastre-se no SharkPay
2. Acesse o painel
3. Gere suas chaves:
   - **Public Key**
   - **Private Key**

#### 6.2. Configurar no .env
```env
SHARKPAY_PUBLIC_KEY=sua_public_key
SHARKPAY_PRIVATE_KEY=sua_private_key
```

#### 6.3. Configurar no Banco de Dados
```sql
UPDATE gateways SET
    public_key = 'sua_public_key',
    private_key = 'sua_private_key'
WHERE id = 1;
```

#### 6.4. Webhook
URL: `https://seudominio.com/payment/sharkpay/webhook`

---

## 7. MERCADO PAGO

### Sobre
- **País**: América Latina 🌎
- **Moedas**: BRL, ARS, MXN, CLP, COP, PEN, UYU
- **Tipos**: Cartão, PIX (Brasil), Boleto
- **Site**: https://mercadopago.com.br

### Passo a Passo

#### 7.1. Criar Conta
1. Acesse: https://www.mercadopago.com.br
2. Crie sua conta empresarial
3. Complete a verificação

#### 7.2. Obter Credenciais
1. Vá em: https://www.mercadopago.com.br/developers/panel/credentials
2. Copie:
   - **Public Key** (APP_USR-xxxxx-xxxxxx-xxxxx)
   - **Access Token** (APP_USR-xxxxx-xxxxxx-xxxxx)

#### 7.3. Configurar no .env
```env
MERCADOPAGO_PUBLIC_KEY=APP_USR-xxxxx-xxxxxx-xxxxx
MERCADOPAGO_ACCESS_TOKEN=APP_USR-xxxxx-xxxxxx-xxxxx
```

#### 7.4. Configurar Webhook
1. Vá em: https://www.mercadopago.com.br/developers/panel/webhooks
2. Adicione: `https://seudominio.com/payment/mercadopago/webhook`
3. Eventos: `payment`, `merchant_order`

### Modo Teste
Para teste, use as credenciais de teste:
- Acesse: https://www.mercadopago.com.br/developers/panel/credentials
- Use as credenciais "Teste"

Cartões de teste: https://www.mercadopago.com.br/developers/pt/docs/checkout-api/testing

---

## 🔧 CONFIGURAÇÃO GERAL

### Habilitar Gateway no Admin

1. Acesse: `https://seudominio.com/admin`
2. Vá em **Settings** → **Payment Gateways**
3. Ative o gateway desejado
4. Teste com uma transação pequena

### Testar Webhooks

Use ferramentas como:
- **Webhook.site**: https://webhook.site
- **RequestBin**: https://requestbin.com

Configure temporariamente a URL do webhook para uma dessas ferramentas e veja se está recebendo os dados corretamente.

### Logs de Transação

Monitore os logs em:
- `storage/logs/laravel.log`
- Admin Panel → **Transactions** → **Deposits**

---

## ⚠️ IMPORTANTE

### Segurança

1. **NUNCA** exponha suas chaves secretas publicamente
2. Use **HTTPS** obrigatoriamente em produção
3. Valide **todas** as requisições de webhook
4. Armazene chaves no `.env`, não no código
5. Use **modo teste** antes de produção

### Conformidade Legal

⚠️ **ATENÇÃO**:
- Verifique a legislação local sobre jogos de azar
- Alguns países proíbem cassinos online
- Você é responsável por cumprir as leis
- Consulte um advogado especializado

### Taxas

Cada gateway cobra taxas diferentes:
- **Stripe**: ~2.9% + $0.30 por transação
- **MercadoPago**: ~3.99% + taxa fixa
- **PIX Gateways**: Varia entre 1% a 5%

Verifique com cada provedor.

---

## 🆘 SUPORTE

### Problemas Comuns

**"Webhook não está funcionando"**
- Verifique se a URL está correta
- Teste com webhook.site
- Verifique os logs do Laravel
- Confirme que o gateway está enviando para o endereço certo

**"Transação não aparece no sistema"**
- Verifique os logs: `storage/logs/laravel.log`
- Confirme que o webhook foi recebido
- Verifique a tabela `deposits` no banco
- Teste com uma transação de teste

**"Erro de autenticação"**
- Confirme que as credenciais estão corretas
- Verifique se não há espaços extras no .env
- Limpe o cache: `php artisan config:clear`
- Verifique se a conta do gateway está ativa

### Contatos de Suporte

- **Stripe**: https://support.stripe.com
- **MercadoPago**: https://www.mercadopago.com.br/ajuda
- **Outros**: Consulte o site de cada gateway

---

## ✅ CHECKLIST DE CONFIGURAÇÃO

Antes de ativar pagamentos reais:

- [ ] Credenciais configuradas no `.env`
- [ ] Credenciais configuradas no banco de dados
- [ ] Webhook URL configurada no gateway
- [ ] Gateway habilitado no admin panel
- [ ] Transação de teste realizada com sucesso
- [ ] Webhook recebido e processado
- [ ] Depósito apareceu na carteira do usuário
- [ ] Log de transação criado
- [ ] Email de confirmação enviado (se configurado)
- [ ] Modo teste desabilitado (se aplicável)
- [ ] HTTPS ativo no site
- [ ] Backup do banco de dados feito

---

**Boa sorte com os pagamentos! 💰**

---

**Versão:** 1.0
**Atualizado:** Janeiro 2026
