### DDEV Symfony Feature Testing
This is just a super small test to add a docker container for a test postgresql database. 

1. I added a new docker-compose.postgresql-test.yaml

2. check with 'ddev describe' if the container is running and can be accessed from within the docker container and from the outside

3. adding .env.test with the DB Url: DATABASE_URL="postgresql://db-test:db-test@test-database:5432/db-test?serverVersion=14.1&charset=utf8"

4. creating WebTestCaseWithDatabase which takes care of adding fixtures and creates the schema

5. Check out the MartketplaceControllerTest which extends WebTestCaseWithDatabase

6. running test from within the ddev shell container -> ddev ssh -> cd public -> vendor/bin/phpunit tests