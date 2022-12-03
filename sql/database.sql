SET search_path TO public;

-- ##################################################################################################################
-- PRODUCTS (EXAMPLE TABLE)
-- ##################################################################################################################
CREATE TABLE product
(
    product_id SERIAL PRIMARY KEY,
    provider VARCHAR(2048) NOT NULL,
    brand VARCHAR(1024) NOT NULL,
    name VARCHAR(1024) NOT NULL,
    price DECIMAL(20, 8) NOT NULL,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP DEFAULT NULL
);


CREATE TABLE "user"
(
    id SERIAL PRIMARY KEY,
    username VARCHAR(40) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE session
(
    id SERIAL PRIMARY KEY,
    id_user INTEGER NOT NULL ,
    duration INTEGER NOT NULL,
    highest_altitude DECIMAL NOT NULL,
    lowest_altitude DECIMAL NOT NULL,
    date INTEGER NOT NULL,
    CONSTRAINT fk_session_id_user FOREIGN KEY (id_user) REFERENCES "user"(id)
);

CREATE TABLE region
(
    id_session INTEGER NOT NULL,
    center_lat DECIMAL NOT NULL,
    center_long DECIMAL NOT NULL,
    CONSTRAINT pk_region_id_session PRIMARY KEY (id_session),
    CONSTRAINT Fk_region_id_session FOREIGN KEY (id_session) REFERENCES session(id)
);

CREATE TABLE descent
(
    id SERIAL PRIMARY KEY,
    id_session INTEGER NOT NULL,
    descent_number INTEGER NOT NULL,
    duration INTEGER NOT NULL,
    highest_altitude DECIMAL NOT NULL,
    lowest_altitude DECIMAL NOT NULL
);