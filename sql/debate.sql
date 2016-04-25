
-- Estructura de tabla para la tabla pregunta
--
CREATE TABLE pregunta (
    id serial PRIMARY KEY,
    uid integer NOT NULL,
    likes integer NOT NULL,
    author varchar(50) NOT NULL,
    category varchar(10) NOT NULL,
    text text NOT NULL,
    date timestamp NOT NULL
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla like
--
CREATE TABLE "like" (
    id serial PRIMARY KEY,
    id_pregunta integer NOT NULL,
    uid integer NOT NULL,
    author varchar(50) NOT NULL,
    date timestamp NOT NULL,
    FOREIGN KEY (id_pregunta) REFERENCES pregunta (id) ON DELETE CASCADE
);
