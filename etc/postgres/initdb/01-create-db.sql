CREATE DATABASE ${DB_DATABASE:-jwt-auth-api};
CREATE USER ${DB_USERNAME:-jwt-auth-api-user} WITH PASSWORD '${DB_PASSWORD:-jwt-auth-api-password}';
GRANT ALL PRIVILEGES ON DATABASE ${DB_DATABASE:-jwt-auth-api} TO ${DB_USERNAME:-jwt-auth-api-user};
