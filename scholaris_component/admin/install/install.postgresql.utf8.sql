CREATE TABLE IF NOT EXISTS scholaris
(
  id serial NOT NULL,
  setting character varying(50) NOT NULL,
  value character varying(100) NOT NULL,
  CONSTRAINT scholaris_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);