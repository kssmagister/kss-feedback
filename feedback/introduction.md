- The students enter their data in "input.html", the teacher first calls "login.html". Then the data can be processed.
- sql code to create the table

``` sql
CREATE TABLE memoranda (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    auswahl VARCHAR(255) NOT NULL,
    texteingabe TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
