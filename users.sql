-- Database: ECF

-- DROP DATABASE IF EXISTS "ECF";
	
--- authentification espace pro ---
	CREATE TABLE users (
		user_id SERIAL PRIMARY KEY,
		email VARCHAR(128) NOT NULL,
		password VARCHAR(64) NOT NULL	
	);
	
	INSERT INTO users VALUES (DEFAULT, 'v.parrot@gmail.com', 'BonjourVous4893');
	ALTER TABLE users OWNER TO laulaugenial;
	