# 🐛 **Problema: DBeaver não conecta ao MySQL no Docker**

## 💻 **Sintomas**
- Erros ao tentar conectar:


Mesmo com configurações corretas de:
- Host: `127.0.0.1`
- Porta: `3306`
- Usuário/senha corretos
- Opções avançadas:
  - `allowPublicKeyRetrieval=true`
  - `useSSL=false`

O banco MySQL no container estava funcionando (teste via `docker exec` funcionava).

## 🔍 Causa
A porta 3306 no seu sistema já estava sendo usada por outro serviço, como:
- Um MySQL instalado localmente no Windows ou WSL
- Outro container ativo

Isso impedia o Docker de mapear corretamente a porta 3306 do container para a 3306 da máquina host.

**Resultado**: O DBeaver tentava se conectar, mas o Docker não estava escutando nessa porta, e a conexão falhava com timeout ou erro de chave pública.

## ✅ Solução
Você alterou o mapeamento da porta no Docker para evitar conflito:

```yaml
# Em docker-compose.yml ou no comando `docker run`
ports:
  - "3307:3306"
