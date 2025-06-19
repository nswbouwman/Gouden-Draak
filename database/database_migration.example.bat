set "MYSQL_BIN=C:\Program Files\MySQL\MySQL Server 8.0\bin"
set MYSQL_PORT=25566

set MYSQL_DB_OLD=gouden_draak
set MYSQL_DB_NEW=gouden_draak_development
:: set MYSQL_DB_NEW=gouden_draak_test
:: set MYSQL_DB_NEW=gouden_draak_acceptance
:: set MYSQL_DB_NEW=gouden_draak_deployment

"%MYSQL_BIN%\mysqldump.exe" -u root --password="123" -P %MYSQL_PORT% --no-data %MYSQL_DB_OLD% > %MYSQL_DB_NEW%.sql
"%MYSQL_BIN%\mysql.exe" -u root --password="123" -P %MYSQL_PORT% -e "CREATE DATABASE  IF NOT EXISTS `%MYSQL_DB_NEW%` /*!40100 DEFAULT CHARACTER SET latin1 */;"
"%MYSQL_BIN%\mysql.exe" -u root --password="123" -P %MYSQL_PORT% %MYSQL_DB_NEW% < %MYSQL_DB_NEW%.sql
PAUSE