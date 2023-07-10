-- Database: ECF

-- DROP DATABASE IF EXISTS "ECF";

CREATE DATABASE "ECF"
    WITH
    OWNER = laulaugenial
    ENCODING = 'UTF8'
    LC_COLLATE = 'en_US.UTF-8'
    LC_CTYPE = 'en_US.UTF-8'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;
	
-- création table témoignages --
CREATE TABLE testimony (
	id SERIAL PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	email VARCHAR(128) NOT NULL,
	grade INTEGER NOT NULL,
	message TEXT NOT NULL
);
SELECT * FROM testimony;

INSERT INTO testimony
VALUES (1, 'Jean Charles', 'coucou@gmail.com', 4, 'Génial je vous adore vous êtes les meilleurs');

SELECT * FROM testimony;

UPDATE testimony
SET id = DEFAULT
WHERE id = 1;

SELECT * FROM testimony;

INSERT INTO testimony
VALUES (DEFAULT, 'Jean Charles', 'coucou@gmail.com', 4, 'Génial je vous adore vous êtes les meilleurs');

SELECT * FROM testimony;