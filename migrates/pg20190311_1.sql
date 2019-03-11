--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.3
-- Dumped by pg_dump version 9.5.3

-- Started on 2019-03-11 20:14:53

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 9 (class 2615 OID 2536311)
-- Name: security; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA security;


ALTER SCHEMA security OWNER TO postgres;

--
-- TOC entry 8 (class 2615 OID 2535635)
-- Name: shm1; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA shm1;


ALTER SCHEMA shm1 OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2247 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = security, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 200 (class 1259 OID 2544557)
-- Name: roleapp; Type: TABLE; Schema: security; Owner: postgres
--

CREATE TABLE roleapp (
    name character varying(254) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE roleapp OWNER TO postgres;

--
-- TOC entry 2248 (class 0 OID 0)
-- Dependencies: 200
-- Name: TABLE roleapp; Type: COMMENT; Schema: security; Owner: postgres
--

COMMENT ON TABLE roleapp IS 'User role';


--
-- TOC entry 2249 (class 0 OID 0)
-- Dependencies: 200
-- Name: COLUMN roleapp.name; Type: COMMENT; Schema: security; Owner: postgres
--

COMMENT ON COLUMN roleapp.name IS 'Role name';


--
-- TOC entry 199 (class 1259 OID 2544555)
-- Name: roleapp_id_seq; Type: SEQUENCE; Schema: security; Owner: postgres
--

CREATE SEQUENCE roleapp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE roleapp_id_seq OWNER TO postgres;

--
-- TOC entry 2250 (class 0 OID 0)
-- Dependencies: 199
-- Name: roleapp_id_seq; Type: SEQUENCE OWNED BY; Schema: security; Owner: postgres
--

ALTER SEQUENCE roleapp_id_seq OWNED BY roleapp.id;


--
-- TOC entry 198 (class 1259 OID 2536327)
-- Name: userapp; Type: TABLE; Schema: security; Owner: postgres
--

CREATE TABLE userapp (
    email character varying(254) NOT NULL,
    pw character varying(300) NOT NULL,
    id integer NOT NULL,
    roleapp integer NOT NULL
);


ALTER TABLE userapp OWNER TO postgres;

--
-- TOC entry 2251 (class 0 OID 0)
-- Dependencies: 198
-- Name: TABLE userapp; Type: COMMENT; Schema: security; Owner: postgres
--

COMMENT ON TABLE userapp IS 'User';


--
-- TOC entry 2252 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN userapp.email; Type: COMMENT; Schema: security; Owner: postgres
--

COMMENT ON COLUMN userapp.email IS 'User email';


--
-- TOC entry 2253 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN userapp.pw; Type: COMMENT; Schema: security; Owner: postgres
--

COMMENT ON COLUMN userapp.pw IS 'Hashed user password';


--
-- TOC entry 2254 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN userapp.roleapp; Type: COMMENT; Schema: security; Owner: postgres
--

COMMENT ON COLUMN userapp.roleapp IS 'User role';


--
-- TOC entry 197 (class 1259 OID 2536325)
-- Name: userapp_id_seq; Type: SEQUENCE; Schema: security; Owner: postgres
--

CREATE SEQUENCE userapp_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE userapp_id_seq OWNER TO postgres;

--
-- TOC entry 2255 (class 0 OID 0)
-- Dependencies: 197
-- Name: userapp_id_seq; Type: SEQUENCE OWNED BY; Schema: security; Owner: postgres
--

ALTER SEQUENCE userapp_id_seq OWNED BY userapp.id;


SET search_path = shm1, pg_catalog;

--
-- TOC entry 184 (class 1259 OID 2535638)
-- Name: film; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE film (
    category integer NOT NULL,
    description character varying(300),
    length integer NOT NULL,
    playingnow boolean DEFAULT true NOT NULL,
    rating character varying(5),
    ticketssold integer DEFAULT 0 NOT NULL,
    title character varying(100) NOT NULL,
    id integer NOT NULL
);


ALTER TABLE film OWNER TO postgres;

--
-- TOC entry 2256 (class 0 OID 0)
-- Dependencies: 184
-- Name: TABLE film; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE film IS 'Информация о фильмах';


--
-- TOC entry 2257 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN film.category; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN film.category IS 'Категория (id -> shm1.filmcategory)';


--
-- TOC entry 2258 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN film.length; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN film.length IS 'Длина фильма, мин.';


--
-- TOC entry 2259 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN film.playingnow; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN film.playingnow IS 'Идёт ли сейчас';


--
-- TOC entry 2260 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN film.rating; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN film.rating IS 'Рейтинг';


--
-- TOC entry 2261 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN film.ticketssold; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN film.ticketssold IS 'Продано билетов';


--
-- TOC entry 2262 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN film.title; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN film.title IS 'Название фильма';


--
-- TOC entry 183 (class 1259 OID 2535636)
-- Name: film_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE film_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE film_id_seq OWNER TO postgres;

--
-- TOC entry 2263 (class 0 OID 0)
-- Dependencies: 183
-- Name: film_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE film_id_seq OWNED BY film.id;


--
-- TOC entry 186 (class 1259 OID 2535651)
-- Name: filmcategory; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE filmcategory (
    categoryname character varying(100),
    id integer NOT NULL
);


ALTER TABLE filmcategory OWNER TO postgres;

--
-- TOC entry 2264 (class 0 OID 0)
-- Dependencies: 186
-- Name: TABLE filmcategory; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE filmcategory IS 'Категории фильмов';


--
-- TOC entry 2265 (class 0 OID 0)
-- Dependencies: 186
-- Name: COLUMN filmcategory.categoryname; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN filmcategory.categoryname IS 'Название категории';


--
-- TOC entry 185 (class 1259 OID 2535649)
-- Name: filmcategory_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE filmcategory_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE filmcategory_id_seq OWNER TO postgres;

--
-- TOC entry 2266 (class 0 OID 0)
-- Dependencies: 185
-- Name: filmcategory_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE filmcategory_id_seq OWNED BY filmcategory.id;


--
-- TOC entry 188 (class 1259 OID 2535766)
-- Name: review; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE review (
    film integer NOT NULL,
    reviewscore integer,
    reviewtext character varying(20000),
    id integer NOT NULL,
    CONSTRAINT review_reviewscore_check CHECK (((reviewscore >= 0) AND (reviewscore <= 10)))
);


ALTER TABLE review OWNER TO postgres;

--
-- TOC entry 2267 (class 0 OID 0)
-- Dependencies: 188
-- Name: TABLE review; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE review IS 'Отзывы о фильмах';


--
-- TOC entry 2268 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN review.film; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN review.film IS 'Фильм (id->shm1.film)';


--
-- TOC entry 2269 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN review.reviewscore; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN review.reviewscore IS 'Кол-во баллов от 0 до 10';


--
-- TOC entry 2270 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN review.reviewtext; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN review.reviewtext IS 'Текст отзыва о фильме';


--
-- TOC entry 187 (class 1259 OID 2535764)
-- Name: review_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE review_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE review_id_seq OWNER TO postgres;

--
-- TOC entry 2271 (class 0 OID 0)
-- Dependencies: 187
-- Name: review_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE review_id_seq OWNED BY review.id;


--
-- TOC entry 192 (class 1259 OID 2535792)
-- Name: show; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE show (
    film integer NOT NULL,
    starttime time without time zone NOT NULL,
    id integer NOT NULL,
    dateshow date DEFAULT ('now'::text)::date,
    adultprice numeric(10,2) DEFAULT 0,
    childprice numeric(10,2) DEFAULT 0,
    theaterhall integer NOT NULL
);


ALTER TABLE show OWNER TO postgres;

--
-- TOC entry 2272 (class 0 OID 0)
-- Dependencies: 192
-- Name: TABLE show; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE show IS 'Where and at what time films will be shown';


--
-- TOC entry 2273 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN show.film; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN show.film IS 'Film (id -> shm1.film)';


--
-- TOC entry 2274 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN show.starttime; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN show.starttime IS 'Film start time';


--
-- TOC entry 2275 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN show.dateshow; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN show.dateshow IS 'Date show';


--
-- TOC entry 2276 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN show.adultprice; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN show.adultprice IS 'Ticket price for an adult';


--
-- TOC entry 2277 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN show.childprice; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN show.childprice IS 'Ticket price for a child';


--
-- TOC entry 2278 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN show.theaterhall; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN show.theaterhall IS 'Theater hall';


--
-- TOC entry 191 (class 1259 OID 2535790)
-- Name: show_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE show_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE show_id_seq OWNER TO postgres;

--
-- TOC entry 2279 (class 0 OID 0)
-- Dependencies: 191
-- Name: show_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE show_id_seq OWNED BY show.id;


--
-- TOC entry 190 (class 1259 OID 2535781)
-- Name: theater; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE theater (
    adultprice numeric(10,2) DEFAULT 0,
    childprice numeric(10,2) DEFAULT 0,
    theatername character varying(100),
    id integer NOT NULL
);


ALTER TABLE theater OWNER TO postgres;

--
-- TOC entry 2280 (class 0 OID 0)
-- Dependencies: 190
-- Name: TABLE theater; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE theater IS 'Информация о театрах и ценах билетов';


--
-- TOC entry 2281 (class 0 OID 0)
-- Dependencies: 190
-- Name: COLUMN theater.adultprice; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN theater.adultprice IS 'Цена билета для взрослого';


--
-- TOC entry 2282 (class 0 OID 0)
-- Dependencies: 190
-- Name: COLUMN theater.childprice; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN theater.childprice IS 'Цена билета для ребенка';


--
-- TOC entry 2283 (class 0 OID 0)
-- Dependencies: 190
-- Name: COLUMN theater.theatername; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN theater.theatername IS 'Название театра';


--
-- TOC entry 189 (class 1259 OID 2535779)
-- Name: theater_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE theater_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE theater_id_seq OWNER TO postgres;

--
-- TOC entry 2284 (class 0 OID 0)
-- Dependencies: 189
-- Name: theater_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE theater_id_seq OWNED BY theater.id;


--
-- TOC entry 202 (class 1259 OID 2544601)
-- Name: theaterhall; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE theaterhall (
    theater integer NOT NULL,
    seats_number integer NOT NULL,
    id integer NOT NULL,
    hall_name character varying
);


ALTER TABLE theaterhall OWNER TO postgres;

--
-- TOC entry 2285 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE theaterhall; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE theaterhall IS 'Theater hall';


--
-- TOC entry 2286 (class 0 OID 0)
-- Dependencies: 202
-- Name: COLUMN theaterhall.theater; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN theaterhall.theater IS 'Theater';


--
-- TOC entry 2287 (class 0 OID 0)
-- Dependencies: 202
-- Name: COLUMN theaterhall.seats_number; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN theaterhall.seats_number IS 'Seats number';


--
-- TOC entry 2288 (class 0 OID 0)
-- Dependencies: 202
-- Name: COLUMN theaterhall.hall_name; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN theaterhall.hall_name IS 'Hall name';


--
-- TOC entry 201 (class 1259 OID 2544599)
-- Name: theaterhall_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE theaterhall_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE theaterhall_id_seq OWNER TO postgres;

--
-- TOC entry 2289 (class 0 OID 0)
-- Dependencies: 201
-- Name: theaterhall_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE theaterhall_id_seq OWNED BY theaterhall.id;


--
-- TOC entry 196 (class 1259 OID 2535831)
-- Name: ticketitem; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE ticketitem (
    adulttickets integer DEFAULT 2,
    childtickets integer DEFAULT 0,
    show integer,
    ticketorder integer,
    id integer NOT NULL
);


ALTER TABLE ticketitem OWNER TO postgres;

--
-- TOC entry 2290 (class 0 OID 0)
-- Dependencies: 196
-- Name: TABLE ticketitem; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE ticketitem IS 'Строки заказа';


--
-- TOC entry 2291 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN ticketitem.adulttickets; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketitem.adulttickets IS 'Кол-во взрослых билетов';


--
-- TOC entry 2292 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN ticketitem.childtickets; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketitem.childtickets IS 'Кол-во детских билетов';


--
-- TOC entry 2293 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN ticketitem.show; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketitem.show IS 'Показ фильма (id -> shm1.show)';


--
-- TOC entry 2294 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN ticketitem.ticketorder; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketitem.ticketorder IS 'Заказ (id -> shm1.ticketitem)';


--
-- TOC entry 195 (class 1259 OID 2535829)
-- Name: ticketitem_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE ticketitem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ticketitem_id_seq OWNER TO postgres;

--
-- TOC entry 2295 (class 0 OID 0)
-- Dependencies: 195
-- Name: ticketitem_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE ticketitem_id_seq OWNED BY ticketitem.id;


--
-- TOC entry 194 (class 1259 OID 2535820)
-- Name: ticketorder; Type: TABLE; Schema: shm1; Owner: postgres
--

CREATE TABLE ticketorder (
    total numeric(10,2) DEFAULT 0,
    complete boolean DEFAULT false,
    id integer NOT NULL,
    userapp integer NOT NULL,
    order_date date DEFAULT (now())::date
);


ALTER TABLE ticketorder OWNER TO postgres;

--
-- TOC entry 2296 (class 0 OID 0)
-- Dependencies: 194
-- Name: TABLE ticketorder; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON TABLE ticketorder IS 'Заказы на билеты';


--
-- TOC entry 2297 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN ticketorder.total; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketorder.total IS 'Сумма, всего';


--
-- TOC entry 2298 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN ticketorder.complete; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketorder.complete IS '0 - заказ не оформлен, 1 - оформлен';


--
-- TOC entry 2299 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN ticketorder.userapp; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketorder.userapp IS 'Пользователь, которому принадлежит заказ (id->security.userapp)';


--
-- TOC entry 2300 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN ticketorder.order_date; Type: COMMENT; Schema: shm1; Owner: postgres
--

COMMENT ON COLUMN ticketorder.order_date IS 'Дата заказа';


--
-- TOC entry 193 (class 1259 OID 2535818)
-- Name: ticketorder_id_seq; Type: SEQUENCE; Schema: shm1; Owner: postgres
--

CREATE SEQUENCE ticketorder_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ticketorder_id_seq OWNER TO postgres;

--
-- TOC entry 2301 (class 0 OID 0)
-- Dependencies: 193
-- Name: ticketorder_id_seq; Type: SEQUENCE OWNED BY; Schema: shm1; Owner: postgres
--

ALTER SEQUENCE ticketorder_id_seq OWNED BY ticketorder.id;


SET search_path = security, pg_catalog;

--
-- TOC entry 2061 (class 2604 OID 2544560)
-- Name: id; Type: DEFAULT; Schema: security; Owner: postgres
--

ALTER TABLE ONLY roleapp ALTER COLUMN id SET DEFAULT nextval('roleapp_id_seq'::regclass);


--
-- TOC entry 2060 (class 2604 OID 2536330)
-- Name: id; Type: DEFAULT; Schema: security; Owner: postgres
--

ALTER TABLE ONLY userapp ALTER COLUMN id SET DEFAULT nextval('userapp_id_seq'::regclass);


SET search_path = shm1, pg_catalog;

--
-- TOC entry 2042 (class 2604 OID 2535643)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY film ALTER COLUMN id SET DEFAULT nextval('film_id_seq'::regclass);


--
-- TOC entry 2043 (class 2604 OID 2535654)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY filmcategory ALTER COLUMN id SET DEFAULT nextval('filmcategory_id_seq'::regclass);


--
-- TOC entry 2044 (class 2604 OID 2535769)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY review ALTER COLUMN id SET DEFAULT nextval('review_id_seq'::regclass);


--
-- TOC entry 2049 (class 2604 OID 2535795)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY show ALTER COLUMN id SET DEFAULT nextval('show_id_seq'::regclass);


--
-- TOC entry 2048 (class 2604 OID 2535786)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY theater ALTER COLUMN id SET DEFAULT nextval('theater_id_seq'::regclass);


--
-- TOC entry 2062 (class 2604 OID 2544604)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY theaterhall ALTER COLUMN id SET DEFAULT nextval('theaterhall_id_seq'::regclass);


--
-- TOC entry 2059 (class 2604 OID 2535836)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY ticketitem ALTER COLUMN id SET DEFAULT nextval('ticketitem_id_seq'::regclass);


--
-- TOC entry 2055 (class 2604 OID 2535825)
-- Name: id; Type: DEFAULT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY ticketorder ALTER COLUMN id SET DEFAULT nextval('ticketorder_id_seq'::regclass);


SET search_path = security, pg_catalog;

--
-- TOC entry 2237 (class 0 OID 2544557)
-- Dependencies: 200
-- Data for Name: roleapp; Type: TABLE DATA; Schema: security; Owner: postgres
--

COPY roleapp (name, id) FROM stdin;
admin	1
user	2
\.


--
-- TOC entry 2302 (class 0 OID 0)
-- Dependencies: 199
-- Name: roleapp_id_seq; Type: SEQUENCE SET; Schema: security; Owner: postgres
--

SELECT pg_catalog.setval('roleapp_id_seq', 2, true);


--
-- TOC entry 2235 (class 0 OID 2536327)
-- Dependencies: 198
-- Data for Name: userapp; Type: TABLE DATA; Schema: security; Owner: postgres
--

COPY userapp (email, pw, id, roleapp) FROM stdin;
evgkrukov@gmail.com	$2y$10$.8Wa6izIX..PjFkwPXtLpeqzmZQ1lZFCk/W52d3sY0.n/1gHKWZ02	3	2
cinema.teatr.kz@gmail.com	$2y$10$sB.kwaIKQ.F4i1PD2zA4iuWHoehRauhhLiyGE1S4.DJPs6ZrNi6Hm	18	1
\.


--
-- TOC entry 2303 (class 0 OID 0)
-- Dependencies: 197
-- Name: userapp_id_seq; Type: SEQUENCE SET; Schema: security; Owner: postgres
--

SELECT pg_catalog.setval('userapp_id_seq', 18, true);


SET search_path = shm1, pg_catalog;

--
-- TOC entry 2221 (class 0 OID 2535638)
-- Dependencies: 184
-- Data for Name: film; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY film (category, description, length, playingnow, rating, ticketssold, title, id) FROM stdin;
1	A gripping true story of honor and discovery	121	t	R	50017	Einstein's Geisha	2
4	A fast-paced fantasy about redemption at the OJ Simpson trial	115	t	R	44036	A Hollow Way of Life	13
4	A humerous farce of scandal amid the search for self identity	105	t	PG-13	8003	An Invisible Attitude	15
3	A mesmerizing adventure of twenty first century urban life	100	t	PG	17004	The New York Robot	11
1	A post-modern excursion into family dynamics and Thai cuisine.	130	t	PG-13	47020	Her Spicy Brothers	1
2	An exciting diorama of struggle in Silicon Valley	100	t	PG	48011	The Low Calorie Guide to the Internet	5
2	A colorful trip through the world of nursery school art	206	t	PG-13	15018	Mysterious Mind	7
4	An angst-ridden yarn of the quest for glory on the high seas	262	t	G	716	On English Time	16
4	A whirlwind tale of one man's search for truth	120	t	PG	43030	The Santa Fe Conspiracy	14
5	A complex history of struggle and redemption	117	t	R	5038	Cooking with Jane Austen	17
5	One family's triumphant adventure	121	t	PG	5009	The Amusing Boy	19
1	A Jungian analysis of pirates and honor	102	t	PG	5000	A Kung Fu Hangman	3
3	An illuminating fantasy of one man's search for the truth and one woman's search for self identity.	115	t	PG-13	49014	Invisible House	10
5	A humerous look at UFOs and their impact on the stock market	122	t	PG-13	13025	The Art of Time	18
5	A humerous look at cross-species friendship	103	t	G	16033	The Holistic Lizard	20
4	test description	100	t	PG-13	0	test title	21
3	test description3	120	t	PG	0	test title3	23
4	test description4	120	t	G	0	test title4	24
5	test description2	120	t	G	0	test title2	22
2	A heart-warming tale of friendship	91	t	G	7538	New York Dog	6
2	A warming tour-de-force of extinction and UFOs	121	t	R	25017	The French Brothers	8
1	A charming diorama about sibling rivalry	124	t	G	7000	Holy Cooking	4
3	A can't-turn-away tale of pathos and lust	121	t	R	5000	The Joy Diet	9
3	An other worldy examination of Internet romance	125	t	G	19002	Blue Connection	12
4	test description5 ыфвжа  яяяяя	123	t	R	0	test title5	57
\.


--
-- TOC entry 2304 (class 0 OID 0)
-- Dependencies: 183
-- Name: film_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('film_id_seq', 57, true);


--
-- TOC entry 2223 (class 0 OID 2535651)
-- Dependencies: 186
-- Data for Name: filmcategory; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY filmcategory (categoryname, id) FROM stdin;
Drama	1
Animation	2
Thriller	3
Action	4
Comedy	5
\.


--
-- TOC entry 2305 (class 0 OID 0)
-- Dependencies: 185
-- Name: filmcategory_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('filmcategory_id_seq', 5, true);


--
-- TOC entry 2225 (class 0 OID 2535766)
-- Dependencies: 188
-- Data for Name: review; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY review (film, reviewscore, reviewtext, id) FROM stdin;
1	5	Director Francis Drake breaks with tradition and casts its first ever Asian-American princess in this enchanting reworking of the Grimm brothers' fairytale, set in Shanghai around the time of the First World War. Tiana (voiced by Emma Carlton) is turned into a frog after kissing a smooth-talking amphibian, and her ever-squabbling brothers (John Gascogne and Tim Wanders) have to embark on a perilous quest to get her turned back into a human.	1
2	4	The grass certainly seems to be greener on the other side for a doting father in this tender romance directed by Kim Kash, adapted from the novel by Philippe Dutrez. Stock trader Jean (Ed Kowalsky) is devoted to his wife Anne-Marie (Mary Po) and young son, enjoying a simple yet happy life. When Jean meets his son's new teacher, Catherine Marly (Sophie Laquelle), something stirs within the broker and he begins to question whether his marriage is everything he hoped it would be. As Jean slowly falls for Mademoiselle Catherine's charm and vulnerability, he risks his marriage to edge closer to the object of his unexpected yet powerful affections.	2
4	3	Love blossoms when a father least expects in Alex Anderson's modern day fairytale. Italian fisherman Giovanni (Luca DeMoroni) is struggling to raise his young daughter Annie (Shania Regal), who requires kidney dialysis. Casting out his nets one day, Giovanni captures a mysterious woman called Adrienne (Cindy Ford), and the pair begin to fall in love. Adrienne signals its intentions early on, but it takes its time to state the obvious.	3
9	4	Written and directed by Kenneth Yngish, this film is this year's The Wrestler, following a self-destructive has-been on the slow and painful road to redemption. Ivan Paricz's portrayal of drunkard Ted Spencer doesn't earn our sympathy with ease, yet through an unlikely romance with reporter Jeanine Alden (Conny Johnson), we are able to glimpse the tenderness and sadness in this pitiful man. Ivan delivers a compelling performance, and he is matched by this emotionally raw portrayal of a lonely woman who is heading for heartache.	4
14	4	Keanu Ulmenson (Patrick Rooney) is an outspoken taxi driver who takes a very dim view of anything to do with the government - so much so that he spends his days making up complicated scenarios of conspiracies. When one of his theories happens to be true, he finds himself chased by the person hiding behind it. Helen Wayne is the love interest of the film with only one problem - she works for the government Patrick so devotedly mistrusts. Any film containing such a heavyweight cast is of course going to be nothing short of mesmerising. The plotline reaches out to a platter of genres and the fact that it can't be pigeonholed, only makes it better viewing. Anecdote: Keanu Ulmenson went that extra mile to get to know his co-star Helen, by dispatching a gift-wrapped freeze-dried rat to her, before filming started!	5
15	4	Scandinavian director Johann Johannson introduces a memorably unconventional heroine in his superb adaptation of the best-selling novel by James Craydon. Part one of a trilogy, this is a gripping and suspenseful yarn full of intrigue and deception that pulls no punches with the violence meted out to the morally flawed characters. The violence is graphic and shocking, yet these scenes are never gratuitous and the director ensures that every bone-crunching punch is vital to the serpentine narrative.	6
20	2	Hollywood has enjoyed a long love affair with man's best friend, with the canine star often outshining the human actors. This is certainly true in this yarn, which pits Ben Castor and Ann-Sue Pollux against the cutest of fluffy Akita puppies and an impeccably trained full-grown version. While many dog movies can be little more than a schmaltz-fest, director Medley Scott reins it in, keeping his meditation on love and everyday life just the right side of sentimental.	7
\.


--
-- TOC entry 2306 (class 0 OID 0)
-- Dependencies: 187
-- Name: review_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('review_id_seq', 7, true);


--
-- TOC entry 2229 (class 0 OID 2535792)
-- Dependencies: 192
-- Data for Name: show; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY show (film, starttime, id, dateshow, adultprice, childprice, theaterhall) FROM stdin;
\.


--
-- TOC entry 2307 (class 0 OID 0)
-- Dependencies: 191
-- Name: show_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('show_id_seq', 1147, true);


--
-- TOC entry 2227 (class 0 OID 2535781)
-- Dependencies: 190
-- Data for Name: theater; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY theater (adultprice, childprice, theatername, id) FROM stdin;
7.00	5.50	General Cinema Cambridge	1
7.75	6.25	Boston Multiplex	2
7.00	5.50	Loews Downtown	3
7.50	6.00	General Cinema Boston	4
7.75	6.25	Downtown Multiplex	5
7.50	6.00	Loews Cambridge	6
6.00	4.50	General Cinema Downtown	7
6.50	5.00	Cambridge Multiplex	8
6.25	4.75	Loews Boston	9
\.


--
-- TOC entry 2308 (class 0 OID 0)
-- Dependencies: 189
-- Name: theater_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('theater_id_seq', 9, true);


--
-- TOC entry 2239 (class 0 OID 2544601)
-- Dependencies: 202
-- Data for Name: theaterhall; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY theaterhall (theater, seats_number, id, hall_name) FROM stdin;
1	100	1	hall # 1
2	100	2	hall # 2
3	100	3	hall # 3
4	100	4	hall # 4
5	100	5	hall # 5
6	100	6	hall # 6
7	100	7	hall # 7
8	100	8	hall # 8
9	100	9	hall # 9
\.


--
-- TOC entry 2309 (class 0 OID 0)
-- Dependencies: 201
-- Name: theaterhall_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('theaterhall_id_seq', 9, true);


--
-- TOC entry 2233 (class 0 OID 2535831)
-- Dependencies: 196
-- Data for Name: ticketitem; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY ticketitem (adulttickets, childtickets, show, ticketorder, id) FROM stdin;
\.


--
-- TOC entry 2310 (class 0 OID 0)
-- Dependencies: 195
-- Name: ticketitem_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('ticketitem_id_seq', 226, true);


--
-- TOC entry 2231 (class 0 OID 2535820)
-- Dependencies: 194
-- Data for Name: ticketorder; Type: TABLE DATA; Schema: shm1; Owner: postgres
--

COPY ticketorder (total, complete, id, userapp, order_date) FROM stdin;
\.


--
-- TOC entry 2311 (class 0 OID 0)
-- Dependencies: 193
-- Name: ticketorder_id_seq; Type: SEQUENCE SET; Schema: shm1; Owner: postgres
--

SELECT pg_catalog.setval('ticketorder_id_seq', 147, true);


SET search_path = security, pg_catalog;

--
-- TOC entry 2094 (class 2606 OID 2544562)
-- Name: roleapp_pkey; Type: CONSTRAINT; Schema: security; Owner: postgres
--

ALTER TABLE ONLY roleapp
    ADD CONSTRAINT roleapp_pkey PRIMARY KEY (id);


--
-- TOC entry 2090 (class 2606 OID 2536335)
-- Name: userapp_pkey; Type: CONSTRAINT; Schema: security; Owner: postgres
--

ALTER TABLE ONLY userapp
    ADD CONSTRAINT userapp_pkey PRIMARY KEY (id);


SET search_path = shm1, pg_catalog;

--
-- TOC entry 2065 (class 2606 OID 2535850)
-- Name: film_id_pkey_; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY film
    ADD CONSTRAINT film_id_pkey_ PRIMARY KEY (id);


--
-- TOC entry 2071 (class 2606 OID 2535848)
-- Name: filmcategory_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY filmcategory
    ADD CONSTRAINT filmcategory_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2074 (class 2606 OID 2535852)
-- Name: review_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY review
    ADD CONSTRAINT review_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2080 (class 2606 OID 2535854)
-- Name: show_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY show
    ADD CONSTRAINT show_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2077 (class 2606 OID 2535856)
-- Name: theater_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY theater
    ADD CONSTRAINT theater_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2097 (class 2606 OID 2544606)
-- Name: theaterhall_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY theaterhall
    ADD CONSTRAINT theaterhall_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2086 (class 2606 OID 2535838)
-- Name: ticketitem_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY ticketitem
    ADD CONSTRAINT ticketitem_id_pkey PRIMARY KEY (id);


--
-- TOC entry 2083 (class 2606 OID 2535827)
-- Name: ticketorder_id_pkey; Type: CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY ticketorder
    ADD CONSTRAINT ticketorder_id_pkey PRIMARY KEY (id);


SET search_path = security, pg_catalog;

--
-- TOC entry 2091 (class 1259 OID 2544563)
-- Name: roleapp_id; Type: INDEX; Schema: security; Owner: postgres
--

CREATE UNIQUE INDEX roleapp_id ON roleapp USING btree (id);


--
-- TOC entry 2092 (class 1259 OID 2544564)
-- Name: roleapp_name; Type: INDEX; Schema: security; Owner: postgres
--

CREATE UNIQUE INDEX roleapp_name ON roleapp USING btree (name);


--
-- TOC entry 2087 (class 1259 OID 2536357)
-- Name: userapp_email; Type: INDEX; Schema: security; Owner: postgres
--

CREATE UNIQUE INDEX userapp_email ON userapp USING btree (email);


--
-- TOC entry 2088 (class 1259 OID 2536336)
-- Name: userapp_id; Type: INDEX; Schema: security; Owner: postgres
--

CREATE UNIQUE INDEX userapp_id ON userapp USING btree (id);


SET search_path = shm1, pg_catalog;

--
-- TOC entry 2063 (class 1259 OID 2535646)
-- Name: film_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX film_id ON film USING btree (id);


--
-- TOC entry 2066 (class 1259 OID 2535647)
-- Name: film_ticketsold; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE INDEX film_ticketsold ON film USING btree (ticketssold);


--
-- TOC entry 2067 (class 1259 OID 2535648)
-- Name: film_title; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE INDEX film_title ON film USING btree (title);


--
-- TOC entry 2068 (class 1259 OID 2535658)
-- Name: filmcategory_cname; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE INDEX filmcategory_cname ON filmcategory USING btree (categoryname);


--
-- TOC entry 2069 (class 1259 OID 2535657)
-- Name: filmcategory_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX filmcategory_id ON filmcategory USING btree (id);


--
-- TOC entry 2072 (class 1259 OID 2535776)
-- Name: review_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX review_id ON review USING btree (id);


--
-- TOC entry 2078 (class 1259 OID 2535798)
-- Name: show_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX show_id ON show USING btree (id);


--
-- TOC entry 2075 (class 1259 OID 2535789)
-- Name: theater_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX theater_id ON theater USING btree (id);


--
-- TOC entry 2095 (class 1259 OID 2544607)
-- Name: theaterhall_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX theaterhall_id ON theaterhall USING btree (id);


--
-- TOC entry 2084 (class 1259 OID 2535844)
-- Name: ticketitem_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX ticketitem_id ON ticketitem USING btree (id);


--
-- TOC entry 2081 (class 1259 OID 2535828)
-- Name: ticketorder_id; Type: INDEX; Schema: shm1; Owner: postgres
--

CREATE UNIQUE INDEX ticketorder_id ON ticketorder USING btree (id);


SET search_path = security, pg_catalog;

--
-- TOC entry 2104 (class 2606 OID 2544570)
-- Name: userapp_roleapp_fkey; Type: FK CONSTRAINT; Schema: security; Owner: postgres
--

ALTER TABLE ONLY userapp
    ADD CONSTRAINT userapp_roleapp_fkey FOREIGN KEY (roleapp) REFERENCES roleapp(id) ON DELETE RESTRICT;


SET search_path = shm1, pg_catalog;

--
-- TOC entry 2098 (class 2606 OID 2535857)
-- Name: film_category_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY film
    ADD CONSTRAINT film_category_fkey FOREIGN KEY (category) REFERENCES filmcategory(id) ON DELETE RESTRICT;


--
-- TOC entry 2099 (class 2606 OID 2535862)
-- Name: review_film_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY review
    ADD CONSTRAINT review_film_fkey FOREIGN KEY (film) REFERENCES film(id) ON DELETE RESTRICT;


--
-- TOC entry 2100 (class 2606 OID 2535867)
-- Name: show_film_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY show
    ADD CONSTRAINT show_film_fkey FOREIGN KEY (film) REFERENCES film(id) ON DELETE RESTRICT;


--
-- TOC entry 2101 (class 2606 OID 2544621)
-- Name: show_theaterhall_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY show
    ADD CONSTRAINT show_theaterhall_fkey FOREIGN KEY (theaterhall) REFERENCES theaterhall(id) ON DELETE RESTRICT;


--
-- TOC entry 2105 (class 2606 OID 2544616)
-- Name: theaterhall_theater_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY theaterhall
    ADD CONSTRAINT theaterhall_theater_fkey FOREIGN KEY (theater) REFERENCES theater(id) ON DELETE RESTRICT;


--
-- TOC entry 2103 (class 2606 OID 2536276)
-- Name: ticketitem_ticketorder_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY ticketitem
    ADD CONSTRAINT ticketitem_ticketorder_fkey FOREIGN KEY (ticketorder) REFERENCES ticketorder(id) ON DELETE CASCADE;


--
-- TOC entry 2102 (class 2606 OID 2536352)
-- Name: ticketorder_userapp_fkey; Type: FK CONSTRAINT; Schema: shm1; Owner: postgres
--

ALTER TABLE ONLY ticketorder
    ADD CONSTRAINT ticketorder_userapp_fkey FOREIGN KEY (userapp) REFERENCES security.userapp(id) ON DELETE RESTRICT;


--
-- TOC entry 2246 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2019-03-11 20:14:53

--
-- PostgreSQL database dump complete
--

