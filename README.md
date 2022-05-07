Requirements
- PHP 8.1
- PostgreSQL 12


Setup:

0. Create .env file with DATABASE_URL="postgresql://roadsurfe:roadsurfe@127.0.0.1:5434/roadsurfe?serverVersion=12&charset=utf8""
1. php composer install
2. php bin/console php bin/console doctrine:migration:migrate
3. php bin/console doctrine:fixtures:load
4. Configure typical nginx/apache config and open http://your-domain/api

To use forecast for particular date run command 'php bin/console order-forecast 2022-09-01'. Command will calculate data
and save it to database, table order_forecast - than front end will be able to pick up this data by rest api.

DB schema:

<img src="campervans.jpg">


Notes:

I tried to implement the historical forecasting method, with the simple formula - pick up all available rentals
on a particular day for all periods in the past, for example, 1 of September 2021, 2020, 2019, 2018 etc. 
Then I calculate on average how many campers we rent on this particular day and save it to order_forecast.

It's a quick and dirty way to predict how much you'll need campers in a day, month,
quarter or year is to look at the matching time period and assume your results will be equal
to or greater than those results.

There are a few issues with this method. First, it doesn't take into account seasonality.
Second, it assumes that buyer demand is constant. Also, I do not catch anomaly data here which ideally 
should be caught and excluded. But if anything outside the ordinary happens, my model won't hold up.

Ultimately, historical demand should be used as a benchmark rather than the foundation of your sales forecast
but for the testing task, I assume it will be easy and quickly implement to show SQL skills, API building skills
and database architecture skills.




