# gCloud Pub/Sub Demo

## Push訊息

- TOPIC-NAME: 主題名稱
- SERVICE-ACCOUNT-KEY-PATH: Service Account金鑰絕對路徑

```bash
php artisan push-message [TOPIC-NAME] --path=[SERVICE-ACCOUNT-KEY-PATH]
```

## Pull訊息

- SUBSCRIPTION-NAME: 訂閱項目名稱
- SERVICE-ACCOUNT-KEY-PATH: Service Account金鑰絕對路徑

```bash
php artisan pull-messages [SUBSCRIPTION-NAME] --path=[SERVICE-ACCOUNT-KEY-PATH]
```
