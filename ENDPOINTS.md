# API endpoints
### Public
- GET /ping - tests connection to the binance API server
    - response: {"success": true}

### Secure(with signature generated from api secret)
- GET /balances - retrieves the binance account's balances of all crypto assets
    - response: 
    ```json
    [
        {
            "asset": "BCPT",
            "balance": "3.000000"
        },
        {
            "asset": "BNB",
            "balance": "10.181530"
        },
        {
            "asset": "ETH",
            "balance": "1000.000000"
        },
        {
            "asset": "IOTA",
            "balance": "47.000000"
        },
        {
            "asset": "JEX",
            "balance": "21.956638"
        },
        {
            "asset": "SXP",
            "balance": "0.147153"
        }
    ]
    ```
- GET /balances/{asset} - retrieves the binance account's balance for a particular crypto asset, where {asset} is the crypto symbol(ETH, BTC,DOGE).
    - response: 
    ```json
    {
        "asset": "ETH",
        "balance": "1000.000000"
    }
    ```
- GET /asset-stats?asset={assetBoughtSymbol}&assetSold={assetSoldSymbol} - retrieves trading statistics of an asset pair for the  binance account. 
  Where {assetBoughtSymbol} is the asset being bought while {assetSoldSymbol} is the asset being sold.
  
  For now average buy and sell price are only the stats provided for this endpoint.
  
  - i.e: GET /asset-stats?asset=XRP&assetSold=BTC
    sample reponse:
     
    ```json
    {
        "average_buy": 0.019980,
        "average_sell": 0.022350
    }
    ```
    